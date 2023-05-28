<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;
use App\Core\Security;
use App\Forms\LoginUser;
use App\Forms\ModifyProfile;
use App\Forms\DeleteProfile;

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
    

    public function userModifyProfile()
    {
        $userData = $_SESSION['userData'];
        $form = new ModifyProfile;
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
    
        if ($form->isSubmit()) {
            $errors = Security::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                // Instancier un nouvel objet User
                $user = new User();
    
                // Mettre à jour les attributs de l'utilisateur avec les nouvelles valeurs
                $user->hydrate(
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
                    Security::securiser($_POST['thumbnail']),
                    $userData['pwd'],
                    $userData['is_verified']
                );
    
                $user->save();
                echo "Mise à jour réussie";
                // Redirection 
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
