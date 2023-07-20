<?php
namespace App\Controllers;

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


class AdminController {

    public function adminInterface(): void 
    {
        $view = new View("Admin/adminInterface", "back");
    }

    public function configSite(): void 
    {
        $_SESSION['postData'] = json_decode(file_get_contents('php://input'), true);
        
        // Traiter les données et mettre à jour le fichier config.json
        $configFilePath = './config.json';
        file_put_contents($configFilePath, json_encode($_SESSION['postData']));
        
        // Envoyer une réponse JSON indiquant la mise à jour réussie
        $response = [
            'message' => 'Le fichier config.json a été mis à jour avec succès.',
            'data' => $_SESSION['postData']
        ];
            
        //implementer fontions

        header('Content-Type: application/json');

        echo json_encode($response);

    }

    public function adminCreateProfile(): void 
    {

        echo'tutu';
        // Récupérer les données de config.json
        $configData = json_decode(file_get_contents('./config.json'), true);
        
        // Vous devez implémenter une fonction pour générer un mot de passe sécurisé ou le récupérer d'une autre manière
        $password = Security::generateSecurePassword(); 
    
        $id_role = 3;
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
    
        header('Location: /?message=' . urlencode($message));;
    }
    
}