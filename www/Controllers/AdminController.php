<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;
use App\Core\Security;


$configFilePath = './config.json';

class AdminController {

    public function adminInterface(): void 
    {
        $view = new View("Admin/adminInterface", "back");
    }

    public function configSite(): void 
    {
        $_SESSION['postData'] = json_decode(file_get_contents('php://input'), true);
        
        $configFilePath = './config.json';
        file_put_contents($configFilePath, json_encode($_SESSION['postData']));
        
        $response = [
            'message' => 'Le fichier config.json a été mis à jour avec succès.',
            'data' => $_SESSION['postData']
        ];
            
        header('Content-Type: application/json');

        echo json_encode($response);

    }

    public function adminCreateProfile(): void 
    {
        $configFilePath = './config.json';
        if (file_exists($configFilePath)) {

        $configData = json_decode(file_get_contents('./config.json'), true);
        $password = Security::generateSecurePassword(); 
    
        $id_role = 1;
        $id = null;
        $userPseudo = Security::securiser($configData['pseudo']); 
        $userMail = Security::securiser($configData['email']);
        $hashedPassword = Security::hashPassword($password);
        $completeToken = Security::generateCompleteToken(); 
        $truncatedToken = Security::staticgenerateTruncatedToken($completeToken); 
        $is_verified = false;
        $thumbnailPath = " ";
    
        $user = new User();
        $user->hydrate(
            $id,
            $id_role,
            $is_verified,
            Security::securiser($configData['firstname']),
            Security::securiser($configData['lastname']),
            $userPseudo,
            Security::securiser($configData['birthDate']),
            $userMail,
            Security::securiser($configData['phone']),
            Security::securiser($configData['country']),
            $thumbnailPath,
            Security::securiser($configData['zipCode']),
            Security::securiser($configData['address']),
            $hashedPassword,
            $truncatedToken
        );
        
        $user->save();
    
        $message = "Bonjour $userPseudo ! Ton profil admin a bien été créé. Merci de bien vouloir vouloir recréer ton nouveau mot de passe!";
    
        header('Location: /?message=' . urlencode($message));
    } else {
    
        header('Location: /error404');
    }
    }

    public function moderatorCreateProfile(): void 
    {
        if ($_SESSION['userData']['id_role'] == 1) {
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
                    $id_role = 2;
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

                    $message = "Le profil moderateur a bien été créé. Merci de bien vouloir vouloir lui demander de recréer son nouveau mot de passe!";
    
                    header('Location: /?message=' . urlencode($message));;
                }
            } else {
                $message = "Il y a eu une erreur. Veuillez rééessayer !";
                header('Location: /userCreateProfile?message=' . urlencode($message));;
            }
        }
    } else {
        header('Location: /error404');
    }
}
}