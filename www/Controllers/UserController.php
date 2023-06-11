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
    
    protected int $id = 0;
    protected string $firstname;
    protected string $surname;
    protected string $email;
    protected string $phone;
    protected string $country;
    protected string $birth_date;
    protected string $thumbnail;
    protected string $pwd;
    protected bool $vip = false;

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
                    // Vérifier si la confirmation de suppression a été renseignée
                    if (isset($_POST['deleteThisProfile']) && $_POST['deleteThisProfile'] === 'deleteThisProfile') {
                        $user = new User();
                        var_dump($_SESSION['userData']['id']);
                        $user->delete($_SESSION['userData']['id']);
                        echo "Votre profil a été supprimé";
                        // Effectuer une redirection ou afficher un message de succès
                    } else {
                        echo "Veuillez confirmer la suppression en saisissant 'deleteThisProfile'";
                        // Afficher un message d'erreur ou rediriger vers la page de suppression du profil
                    }
                } else {
                    $view->assign('errors', $errors);
                }
            }
        }

        public function userModifyProfile() {

            if (isset($_SESSION['userData'])) {

                $userData = $_SESSION['userData'];
                $form = new ModifyProfile;
                $view = new View("Forms/form", "front");
                $view->assign('form', $form->getConfig());
                $isModifyForm = true;
                $view->assign('isModifyForm', $isModifyForm);
            
                if ($form->isSubmit()) {
                    $errors = Security::form($form->getConfig(), $_POST);
                    if (empty($errors)) {
                        $user = new User();
            
                        // Génération d'un nouveau token tronqué
                        $newCompleteToken = Security::generateCompleteToken();
                        $newTruncatedToken = Security::staticgenerateTruncatedToken($newCompleteToken);
            
                        $user->hydrate(
                            $userData['id'],
                            $userData['id_role'],
                            Security::securiser($_POST['firstname']),
                            Security::securiser($_POST['lastname']),
                            Security::securiser($_POST['pseudo']),
                            Security::securiser($_POST['email']),
                            Security::securiser($_POST['phone']),
                            Security::securiser($_POST['birth_date']),
                            Security::securiser($_POST['address']),
                            Security::securiser($_POST['zip_code']),
                            Security::securiser($_POST['country']),
                            Security::hashPassword($_POST['pwd']),
                            Security::securiser($_POST['thumbnail']),
                            $newTruncatedToken // Assignez le nouveau token tronqué à la propriété correspondante dans la classe User
                        );
            
                        // Stockage du nouveau token tronqué dans la session de l'utilisateur
                        $_SESSION['userData']['token_hash'] = $newTruncatedToken;

                        // Stockage du nouveau token tronqué dans un cookie côté client
                        setcookie('user_token', $newTruncatedToken, time() + (86400 * 30), '/'); // Expire dans 30 jours
            
                        $user->save();
                        echo "Mise à jour réussie";
                        // Redirection
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
        $isModifyForm = false; 
        $view->assign('isModifyForm', $isModifyForm);
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $email = Security::securiser($_POST['email']); 
                $password = Security::securiser($_POST['pwd']); 
                $userConnected = new User();
    
                $isLoggedIn = $userConnected->login($email, $password);
    
                if ($isLoggedIn) {
                    // Génération d'un nouveau token tronqué
                    $newCompleteToken = Security::generateCompleteToken();
                    $newTruncatedToken = Security::staticgenerateTruncatedToken($newCompleteToken);
    
                    // Stockage du nouveau token tronqué dans la session de l'utilisateur
                    $_SESSION['userData']['token_hash'] = $newTruncatedToken;
    
                    // Stockage du nouveau token tronqué dans un cookie côté client
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
        $isModifyForm = false;
        $view->assign('isModifyForm', $isModifyForm);
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $id_role = 1;
                $id = null;
                $hashedPassword = Security::hashPassword($_POST['pwd']);
                $completeToken = Security::generateCompleteToken(); // Génère le jeton complet
                $truncatedToken = Security::staticgenerateTruncatedToken($completeToken); // Génère le jeton tronqué
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
                    Security::securiser($_POST['thumbnail']),
                    $truncatedToken 
                );
    
                $user->save();
                echo "Insertion en BDD";
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
    

    public function userInterface() {

        if ($_SESSION['userData']['id_role'] == 1) {
        $view = new View("User/userInterface", "front");
        } else {
            $message = "Veuillez vous connecter afin de pouvoir accèder à votre interface.";
            header('Location: /?message=' . urlencode($message));
        }
    }

    public function contact() {
        $view = new View("User/contact", "front");
    }
}

