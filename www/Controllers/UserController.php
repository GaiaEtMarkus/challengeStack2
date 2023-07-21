<?php
namespace App\Controllers;

require_once('./Core/Functions.php');

use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;
use App\Core\Security;
use App\Forms\ChangePassword;
use App\Forms\ModifyProfile;
use App\Forms\DeleteProfile;
use App\Forms\ForgotPassword;
use App\Forms\Contact;
use App\Forms\LoginUser;

class UserController {

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
        if (isset($_SESSION['userData'])) {
            $form = new DeleteProfile();
            $view = new View("Forms/form", "front");
            $view->assign('form', $form->getConfig()); 
        
            if ($form->isSubmit()) {
                $errors = Security::form($form->getConfig(), $_POST);
                if (empty($errors)) {
                    if (isset($_POST['deleteThisProfile']) && $_POST['deleteThisProfile'] === 'deleteThisProfile') {

                        $userId = $_SESSION['userData']['id'];
                        $user = new User();
                        $user->delete($userId);

                        // $userData = $user->getUserById($userId);
                        $userMail = $_SESSION['userData']['email'];
                        $userPseudo = $_SESSION['userData']['pseudo'];
                        session_unset();
                        session_destroy();

                        $subject = "Suppression de compte";
                        $message = "Bonjour {$userPseudo} ! Ceci est un message pour te signaler que ton compte a bien été supprimé !
                                    N'hésite pas à nous rendre visite à nouveau sur Trokos";
            
                        mailFormContact($subject, $userMail, $subject, $message);
                        mailFormContact($subject, "trokos.contact@gmail.com", $subject, "Un utilisateur a supprimé son profil sur Trokos : {$userMail}!");

                        $message = "Votre compte a bien été supprimé !";
                        header('Location: /?message=' . urlencode($message));    
                    } else {
                        echo "Veuillez confirmer la suppression en saisissant 'deleteThisProfile'";
                    }
                } else {
                    $view->assign('errors', $errors);
                }
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
                    $userData['is_verified'] = Security::securiser($_POST['country']);
                    $pwd = Security::securiser($_POST['pwd']);
                    $confirmPwd = Security::securiser($_POST['confirmPwd']);

                    if ($pwd !== $confirmPwd) {

                        $message = "Les mots de passes ne correspondent pas !";
                        header('Location: /userModifyProfile?message=' . urlencode($message));    

                    }else {
    
                        $user->hydrate(
                            $userData['id'],
                            $userData['id_role'],
                            $userData['is_verified'],
                            $userData['firstname'],
                            $userData['lastname'],
                            $userData['pseudo'],
                            $userData['birth_date'],
                            $userData['email'],
                            $userData['phone'],
                            $userData['country'],
                            $thumbnailPath,
                            $userData['zip_code'],
                            $userData['address'],
                            Security::hashPassword($pwd),
                            $newTruncatedToken,
                        );
                    }

                    $userData['token_hash'] = $newTruncatedToken;
                    $_SESSION['userData'] = $userData;
    
                    setcookie('user_token', $newTruncatedToken, time() + (86400 * 30), '/');
    
                    $user->save();

                    $subject = "Modification de compte";
                    $message = "Bonjour {$userData['pseudo']} ! Ceci est un message pour te signaler que ton compte a bien été modifié.
                    si tu n'es pas à l'origine de cette modification, contacte nous au plus vite !";
        
                    mailFormContact($subject, $userData['email'], $subject, $message);
                    mailFormContact($subject, "trokos.contact@gmail.com", $subject, "Un utilisateur a modifié son profil sur Trokos : {$userData['email']},!");

                    $message = "La mise à jour a bien été effectué !";
                    header('Location: /userInterface?message=' . urlencode($message));
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
    
                    setcookie('user_token', $newTruncatedToken, time() + (86400 * 30), '/'); 
                    // dd($_SESSION);
                    $message = "Connexion réussie !";
                    if($_SESSION['userData']['id_role'] == 3 )
                    {
                        header('Location: /userinterface?message=' . urlencode($message));;
                    }
                    else if ($_SESSION['userData']['id_role'] == 2 )
                    {
                        header('Location: /moderatorinterface?message=' . urlencode($message));;
                    }
                    else if ($_SESSION['userData']['id_role'] == 1 )
                    {
                        header('Location: /admininterface?message=' . urlencode($message));;
                    }

                } else {

                    echo "Échec de la connexion";
                }
            } else {

                $view->assign('errors', $errors);
            }
        }
    }

    public function userCreateProfile(): void 
    {
        $form = new AddUser();
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                if ( Security::securiser($_POST['pwd']) !==  Security::securiser($_POST['pwdConfirm'])) {
                    $message = "Les mots de passes ne sont pas identiques. Veuillez rééessayer !";
                    header('Location: /userCreateProfile?message=' . urlencode($message));;                
                } else {
                    $id_role = 3;
                    $id = null;
                    $userPseudo = Security::securiser($_POST['pseudo']); 
                    $userMail = Security::securiser($_POST['email']);
                    $hashedPassword = Security::hashPassword($_POST['pwd']);
                    $completeToken = Security::generateCompleteToken(); 
                    $truncatedToken = Security::staticgenerateTruncatedToken($completeToken); 
                    $is_verified = false;
                    $thumbnail = $_FILES['thumbnail'] ?? null;
                    if ($thumbnail && $thumbnail['error'] === UPLOAD_ERR_OK) {
                        $thumbnailPath = './assets/userProfile/' . $thumbnail['name'];
                        move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                    } else {
                        $thumbnailPath = null; 
                        echo('error');
                    }

                    $user = new User();
                    $user->hydrate(
                        $id,
                        $id_role,
                        $is_verified,
                        Security::securiser($_POST['firstname']),
                        Security::securiser($_POST['lastname']),
                        $userPseudo,
                        Security::securiser($_POST['birth_date']),
                        $userMail,
                        Security::securiser($_POST['phone']),
                        Security::securiser($_POST['country']),
                        $thumbnailPath,
                        Security::securiser($_POST['zip_code']),
                        Security::securiser($_POST['address']),
                        $hashedPassword,
                        $truncatedToken
                    );
                    
                    $user->save();

                    $subject = "Nouvelle création de compte";
                    $message = "Bonjour $userPseudo ! Nous te remercions pour ton inscription et te souhaite de faire plein de bonnes affaires sur Trokos !";

                    mailFormContact($subject, $userMail, $subject, $message);
                    mailFormContact($subject, "trokos.contact@gmail.com", "D'inscription'", "Un nouvel utilisateur s'est inscrit sur Trokos : $userMail !");

                    $message = "Votre compte a été créé !";
                    header('Location: /?message=' . urlencode($message));;
                }
            } else {
                $message = "Il y a eu une erreur. Veuillez rééessayer !";
                header('Location: /userCreateProfile?message=' . urlencode($message));;
            }
        }
    }

    public function userInterface()
    {
        if ($_SESSION['userData']['id_role'] == 3) {
            $pseudo = $_SESSION['userData']['pseudo'];
            $thumbnail = $_SESSION['userData']['thumbnail'];
            $userId = $_SESSION['userData']['id'];
            $user = new User();
            $userData = $user->getUserById($userId);
            $countProducts = $user->getProductCountByUserId($userId);
            $countTransactions = $user->getTransactionCountByUserId($userId);
            $comments = $user->getCommentsByUserId($userId);
            $productsUser = $user->getProductsByUserId($userId);
            $products = $user->getAllFromTable('Product');
            $allTransactions = $user->getAllFromTable("Transaction");
            $userProducts = [];
            $otherProducts = [];
            
            foreach ($allTransactions as $transaction) {
                if ($transaction['id_seller'] == $userId) {
                    $otherProduct = $user->getProductById($transaction['id_item_receiver']);
                    if ($otherProduct) {
                        
                        $otherProducts[$transaction['id']] = $otherProduct;
                    }
                    $userProduct = $user->getProductById($transaction['id_item_seller']);
                    if ($userProduct) {
                        $userProducts[$transaction['id']] = $userProduct;
                    }
                } elseif ($transaction['id_receiver'] == $userId) {
                    $otherProduct = $user->getProductById($transaction['id_item_seller']);
                    if ($otherProduct) {
                        $otherProducts[$transaction['id']] = $otherProduct;
                    }
                    $userProduct = $user->getProductById($transaction['id_item_receiver']);
                    if ($userProduct) {
                        $userProduct['isReceiver'] = true;
                        $userProduct['transactionId'] = $transaction['id']; 
                        $userProducts[$transaction['id']] = $userProduct;
                    }
                }
            }
            
            $view = new View("User/userInterface", "front");
            $view->assign('userProducts', $userProducts);
            $view->assign('otherProducts', $otherProducts);
            $view->assign('productsUser', $productsUser);
            $view->assign('products', $products);
            $view->assign('allTransactions', $allTransactions);
            $view->assign('pseudo', $pseudo);
            $view->assign('thumbnail', $thumbnail);
            $view->assign('userData', $userData);
            $view->assign('countProducts', $countProducts);
            $view->assign('countTransactions', $countTransactions);
            $view->assign('comments', $comments);
        } else {
            $message = "Veuillez vous connecter afin de pouvoir accéder à votre interface.";
            header('Location: /?message=' . urlencode($message));
        }
    }
    
    public function contact() 
    {
        $form = new Contact;
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
          
                $userMail =  Security::securiser($_POST['email']);
                $userSubject =  Security::securiser($_POST['subject']);
                $userMessage =  Security::securiser($_POST['message']);
        
                mailFormContact("Accusé de réception", $userMail, $userSubject, "Nous avons bien reçu votre message et nous vous répondrons dans les plus brefs délais.");
                mailFormContact("Demande d'information", "trokos.contact@gmail.com", $userSubject, "Vous avez reçu le message suivant {$userMessage} de la part de {$userMail}.");
        
                $message = "Votre message a bien été envoyé !";
                header('Location: /?message=' . urlencode($message));

                }
                else {
                    $errors['Echec'] = "Oups .... Veuillez réessayer !";
                }

            } else {
            }
        }

    public function forgotPassword()
    {
        require_once('./Core/Functions.php');
    
        $form = new ForgotPassword;
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
    
            if (empty($errors)) {
                $userMail = Security::securiser($_POST['email']);
                $user = new User();
                $userData = $user->getUserByMail($userMail);
                $userPseudo = $userData['pseudo'];
                $subject = $_POST['subject'];
    
                if ($userData) {
                    $userId = $userData['id'];
                    $token = Security::generateResetToken(); 
                    $expiration = time() + 24 * 60 * 60; 
    
                    $user->setResetToken($userId, $token, $expiration); 
    
                    $resetLink = "localhost/changePassword?token=$token"; 
                    $message = "Bonjour $userPseudo ! Voici le lien pour réinitialiser votre mot de passe : $resetLink. "
                             . "Ce lien est valable pendant 24 heures. Si vous n'avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer ce message.";
    
                    mailFormContact($subject, $userMail, "Réinitialisation du mot de passe", $message);
                    mailFormContact($subject, "trokos.contact@gmail.com", "Demande de réinitialisation de mot de passe", "Un user vient d'effectuer 
                                    une demande de réinintialisation sur le mail $userMail");
    
                    $message = "Un lien de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.";
                    header('Location: /=' . urlencode($message));
                } else {
                    $message = "Un lien de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.";
                    header('Location: /=' . urlencode($message));
                } 
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
    
    public function changePassword() {

        $token = Security::securiser($_GET['token']);
        $user = new User;
        $tokenData = $user->getUserByToken($token);
        $userId = $tokenData['user_id'];
        $userData = $user->getUserById($userId);
        $userData = $userData[0];
        $expiration = $tokenData['expiration'];
        $expirationTimestamp = strtotime($expiration);
    
        $form = new ChangePassword;
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
    
        if ($form->isSubmit() && time() < $expirationTimestamp) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $password = Security::securiser($_POST['password']);
                $confirmPassword = Security::securiser($_POST['confirmPassword']);
                
    
                if($password == $confirmPassword) {
                    $hashedPassword = Security::hashPassword($password);
                    $user->updatePassword($userId, $hashedPassword);
                    echo "Mot de passe mis à jour avec succès.";
                }
                else {
                    $errors['confirmPassword'] = "Les mots de passe ne correspondent pas";
                    $view->assign('errors', $errors);
                }
    
            } else {
                $view->assign('errors', $errors);
                echo'error';
            }
        }
    }

    public function displayUserStats()
    {   
        $userId = $_GET['userId'];
        $user = new User;
        $userData = $user->getUserById($userId);
        $products = $user->getProductsByUserId($userId);
        $countProducts = $user->getProductCountByUserId($userId);
        $countTransactions = $user->getTransactionCountByUserId($userId);
        $comments = $user->getCommentsByUserId($userId);
        $view = new View("User/displayStats", "front");
        $view->assign('userData', $userData);
        $view->assign('countProducts', $countProducts);
        $view->assign('countTransactions', $countTransactions);
        $view->assign('comments', $comments);
    }
}
