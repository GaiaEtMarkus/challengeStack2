<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;
use App\Core\Security;
use App\Forms\LoginUser;
use App\Forms\ModifyProfile;
use App\Core\Sql;

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

    public function userModifyProfile() {

        $user = $_SESSION['userConnected'];

        $form = new ModifyProfile();
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
        $view->assign('user', $user);

        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                // Récupérer les nouvelles valeurs des attributs depuis le formulaire
                $newUsername = Security::securiser($_POST['username']);
                $newEmail = Security::securiser($_POST['email']);
                // ... récupérer les autres attributs

                // Construire et exécuter la requête SQL pour mettre à jour les attributs de l'utilisateur
                $user->setUsername($newUsername);
                $user->setEmail($newEmail);
                // ... mettre à jour les autres attributs

                $user->save(); // Appeler la méthode save() pour enregistrer les modifications dans la base de données

                echo "Mise à jour réussie";
                // Redirection ou affichage d'un message de succès
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function showLoginForm() {
        $form = new LoginUser;
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if($form->isSubmit()){
            $errors = Security::form($form->getConfig(), $_POST);
            if(empty($errors)){
                $email = Security::securiser($_POST['email']); 
                $password = Security::securiser($_POST['pwd']); 
                $userConnected = new User();
    
                $isLoggedIn = $userConnected->login($email, $password);
    
                if ($isLoggedIn) {
                    var_dump($userConnected);
                    echo "Connecté avec succès";
                    // Redirection vers la page d'accueil ou le tableau de bord de l'utilisateur
                    // header('Location: /');
                } else {
                    echo "Échec de la connexion";
                }
            } else{
                $view->assign('errors', $errors);
            }
        }
    }

    public function userCreateProfile(): void {
    
        $form = new AddUser();
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if($form->isSubmit()){
            $errors = Security::form($form->getConfig(), $_POST);
            if(empty($errors)){
                $is_verified = "f";
                $id_role = 1;
                $hashedPassword = Security::hashPassword($_POST['pwd']);
                $user = new User();
                $user->hydrate(
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
                    Security::securiser($_POST['thumbnail']), 
                    $hashedPassword,                    
                    $is_verified
                );
                // Enregistrement de l'utilisateur dans la base de données
                $user->save();
                echo "Insertion en BDD";
            } else{
                $view->assign('errors', $errors);
            }
        }
    }
    
    // public function userProfile() {
    //     $view = new View("User/userProfile", "front");
    //     // Consider rendering or returning the view here.
    // }

    public function userInterface() {
        $view = new View("User/userInterface", "front");
        // Consider rendering or returning the view here.
    }

    public function contact() {
        $view = new View("User/contact", "front");
        // Consider rendering or returning the view here.
    }
}
