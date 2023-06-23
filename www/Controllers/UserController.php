<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;
use App\Core\Security;
use App\Forms\ModifyProfile;
use App\Forms\DeleteProfile;
use App\Forms\LoginUser;

class UserController {
    
    // protected int $id = 0;
    // protected string $firstname;
    // protected string $surname;
    // protected string $email;
    // protected string $phone;
    // protected string $country;
    // protected string $birth_date;
    // protected string $thumbnail;
    // protected string $pwd;
    // protected bool $vip = false;

    public function deconnexion()
    {
        if (isset($_SESSION['userData'])) {
            session_unset();
            session_destroy();
            $message = "Déconnexion réussie !";
            header('Location: /?message=' . urlencode($message));     
        }
    }

    public function userDeleteProfile()
    {
            $form = new DeleteProfile();
            $view = new View("Forms/form", "front");
            $view->assign('form', $form->getConfig()); 
        
            if ($form->isSubmit()) {
                $errors = Security::form($form->getConfig(), $_POST);
                if (empty($errors)) {
                    if (isset($_POST['deleteThisProfile']) && $_POST['deleteThisProfile'] === 'deleteThisProfile') {
                        $user = new User();
                        var_dump($_SESSION['userData']['id']);
                        $user->delete($_SESSION['userData']['id']);
                        echo "Votre profil a été supprimé";
                    } else {
                        echo "Veuillez confirmer la suppression en saisissant 'deleteThisProfile'";
                    }
                } else {
                    $view->assign('errors', $errors);
                }
            }
        }

        public function userModifyProfile()
        {
            if (isset($_SESSION['userData'])) {
                $userData = $_SESSION['userData'];
                $form = new ModifyProfile;
                $view = new View("Forms/form", "front");
                $view->assign('form', $form->getConfig());
        
                if ($form->isSubmit()) {
                    $errors = Security::form($form->getConfig(), $_POST);
                    if (empty($errors)) {
                        $user = new User();
        
                        $newCompleteToken = Security::generateCompleteToken();
                        $newTruncatedToken = Security::staticgenerateTruncatedToken($newCompleteToken);
        
                        $thumbnail = $_FILES['thumbnail'] ?? null;
                        $thumbnailPath = $thumbnail ? './assets/UserProfile/' . $thumbnail['name'] : $_SESSION['userData']['thumbnail'];
        
                        if ($thumbnail && $thumbnail['error'] === UPLOAD_ERR_OK) {
                            move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                        } elseif (!$thumbnail || $thumbnail['error'] === UPLOAD_ERR_NO_FILE) {
                            $oldThumbnail = $_SESSION['userData']['thumbnail'];
                            $thumbnailPath = !empty($oldThumbnail) ? $oldThumbnail : null;
                        }
        
                        $userData['firstname'] = Security::securiser($_POST['firstname']);
                        $userData['lastname'] = Security::securiser($_POST['lastname']);
                        $userData['pseudo'] = Security::securiser($_POST['pseudo']);
                        $userData['email'] = Security::securiser($_POST['email']);
                        $userData['phone'] = Security::securiser($_POST['phone']);
                        $userData['birth_date'] = Security::securiser($_POST['birth_date']);
                        $userData['address'] = Security::securiser($_POST['address']);
                        $userData['zip_code'] = Security::securiser($_POST['zip_code']);
                        $userData['country'] = Security::securiser($_POST['country']);
                        $userData['thumbnail'] = $thumbnailPath;
                        $userData['is_verified'] = $_POST['country'];
        
                        $user->hydrate(
                            $userData['id'],
                            $userData['id_role'],
                            $userData['firstname'],
                            $userData['lastname'],
                            $userData['pseudo'],
                            $userData['email'],
                            $userData['phone'],
                            $userData['birth_date'],
                            $userData['address'],
                            $userData['zip_code'],
                            $userData['country'],
                            Security::hashPassword($_POST['pwd']),
                            $thumbnailPath,
                            $newTruncatedToken,
                            $userData['is_verified']
                        );
        
                        $userData['token_hash'] = $newTruncatedToken;
                        $_SESSION['userData'] = $userData;
        
                        setcookie('user_token', $newTruncatedToken, time() + (86400 * 30), '/');
        
                        $user->save();
                        echo "Mise à jour réussie";

                    } else {
                        $view->assign('errors', $errors);
                    }
                }
            } else {

                $message = "Veuillez vous connecter afin de pouvoir modifier votre profil !";
                header('Location: /?message=' . urlencode($message));
            }
        }
        
    public function showLoginForm() {
        
        $form = new LoginUser;
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $email = Security::securiser($_POST['email']); 
                $password = Security::securiser($_POST['pwd']); 
                $userConnected = new User();
    
                $isLoggedIn = $userConnected->login($email, $password);
    
                if ($isLoggedIn) {
                    $newCompleteToken = Security::generateCompleteToken();
                    $newTruncatedToken = Security::staticgenerateTruncatedToken($newCompleteToken);
    
                    $_SESSION['userData']['token_hash'] = $newTruncatedToken;
    
                    setcookie('user_token', $newTruncatedToken, time() + (86400 * 30), '/'); // Expire dans 30 jours
    
                    echo "Connecté avec succès";
                    header('Location: /userinterface');
                } else {
                    echo "Échec de la connexion";
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function userCreateProfile(): void {
        $form = new AddUser();
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                if ($_POST['pwd'] !== $_POST['pwdConfirm']) {
                    $errors['pwdConfirm'] = "Les mots de passe ne sont pas identiques";
                } else {
                    $id_role = 1;
                    $id = null;
                    $hashedPassword = Security::hashPassword($_POST['pwd']);
                    $completeToken = Security::generateCompleteToken(); 
                    $truncatedToken = Security::staticgenerateTruncatedToken($completeToken); 
                    $is_verified = false;
    
                    $thumbnail = $_FILES['thumbnail'] ?? null;
                    if ($thumbnail && $thumbnail['error'] === UPLOAD_ERR_OK) {
                        $thumbnailPath = './assets/userProfile/' . $thumbnail['name'];
                        var_dump($thumbnailPath); 
                        move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                    } else {
                        $thumbnailPath = null; 
                        echo('error');
                    }

                    var_dump($thumbnail); 
    
                    $user = new User();
                    $user->hydrate(
                        $id,
                        $id_role,
                        Security::securiser($_POST['firstname']),
                        Security::securiser($_POST['lastname']),
                        Security::securiser($_POST['pseudo']),
                        Security::securiser($_POST['email']),
                        Security::securiser($_POST['phone']),
                        Security::securiser($_POST['birth_date']),
                        Security::securiser($_POST['address']),
                        Security::securiser($_POST['zip_code']),
                        Security::securiser($_POST['country']),
                        $hashedPassword,
                        $thumbnailPath,
                        $truncatedToken,
                        $is_verified 
                    );
    
                    $user->save();
                    echo "Insertion en BDD";
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function userInterface()
    {
        if ($_SESSION['userData']['id_role'] == 1) {
            $userId = $_SESSION['userData']['id'];
            $user = new User();
            $products = $user->getProductsByUserId($userId);
            $view = new View("User/userInterface", "front");
            $view->assign('products', $products);
        } else {
            $message = "Veuillez vous connecter afin de pouvoir accéder à votre interface.";
            header('Location: /?message=' . urlencode($message));
        }
    }
    

    public function contact() {
        $view = new View("User/contact", "front");
    }
}

