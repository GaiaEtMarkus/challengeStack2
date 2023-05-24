<?php
namespace App\Controllers;
use App\Core\Verificator;
use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;

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

    // public function userCreateProfile() {
    //     $view = new View("User/userCreateProfile", "front");
    //     // Consider rendering or returning the view here.
    // }

    public function userCreateProfile(): void {
    
        $form = new AddUser();
        $view = new View("User/userCreateProfile", "front");
        $view->assign('form', $form->getConfig());
    
        if($form->isSubmit()){
            $errors = Verificator::form($form->getConfig(), $_POST);
            if(empty($errors)){
                $vip = isset($_POST['vip']) && $_POST['vip'] === 'on' ? "t" : "f";
                // Création d'un nouvel utilisateur et hydratation avec les valeurs du formulaire
                $user = new User();
                $user->hydrate(
                    $_POST['firstname'], 
                    $_POST['lastname'], 
                    $_POST['email'], 
                    $_POST['phone'], 
                    $_POST['birth_date'], 
                    $_POST['thumbnail'], 
                    password_hash($_POST['pwd'], PASSWORD_DEFAULT), // Hashage du mot de passe
                    $_POST['country'],
                    $vip
                    // A remplacer par la vraie valeur VIP
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
