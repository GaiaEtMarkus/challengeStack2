<?php

use App\Core\Security;
use App\Forms\AddUser;
use App\Core\View;
use App\Models\User;

echo 'tutu';
$configFilePath = './config.json';

// Récupérons les données JSON de la requête POST
$data = json_decode(file_get_contents('php://input'), true);

if (isset($configFilePath) && isset($data)) {
    $configContent = json_encode($data, JSON_PRETTY_PRINT);

    // Créer le fichier config.json
    if (file_put_contents($configFilePath, $configContent) !== false) {
        
        $form = new AddUser();
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        // Sécuriser les valeurs du formulaire
        $userPseudo = Security::securiser($data['pseudo']); 
        $userMail = Security::securiser($data['email']);
        $userPassword = Security::securiser($data['pwd']);
        $userPasswordConfirm = Security::securiser($data['pwdConfirm']);

        if ($userPassword !== $userPasswordConfirm) {
            $message = "Les mots de passes ne sont pas identiques. Veuillez rééessayer !";
            echo json_encode(['redirect' => '/userCreateProfile?message=' . urlencode($message)]);
        } else {
            $id_role = 3;
            $id = null;
            $hashedPassword = Security::hashPassword($userPassword);
            $completeToken = Security::generateCompleteToken(); 
            $truncatedToken = Security::staticgenerateTruncatedToken($completeToken); 
            $is_verified = false;

            $user = new User();
            $user->hydrate(
                $id,
                $id_role,
                $is_verified,
                Security::securiser($data['firstname']),
                Security::securiser($data['lastname']),
                $userPseudo,
                Security::securiser($data['birth_date']),
                $userMail,
                Security::securiser($data['phone']),
                Security::securiser($data['country']),
                $thumbnailPath,
                Security::securiser($data['zip_code']),
                Security::securiser($data['address']),
                $hashedPassword,
                $truncatedToken
            );
            
            $user->save();

            $subject = "Nouvelle création de compte";
            $message = "Bonjour $userPseudo ! Nous te remercions pour ton inscription et te souhaite de faire plein de bonnes affaires sur Trokos !";

            mailFormContact($subject, $userMail, $subject, $message);
            mailFormContact($subject, "trokos.contact@gmail.com", "D'inscription'", "Un nouvel utilisateur s'est inscrit sur Trokos : $userMail !");

            $message = "Votre compte a été créé !";
            echo json_encode(['redirect' => '/?message=' . urlencode($message)]);
        }
    } else {
        // Une erreur s'est produite lors de la création du fichier config.json
        // Vous pouvez envoyer une réponse JSON appropriée si nécessaire
        echo json_encode(['error' => 'Erreur lors de la création du fichier config.json.']);
    }  
}

session_unset()
?>
