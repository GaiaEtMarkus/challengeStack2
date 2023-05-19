<?php
namespace App\Controllers;
use App\Core\View;
use App\Core\Verificator;
use App\Models\User;

class UserController{
    
    protected int $id = 0;
    protected string $nom;
    protected string $prenom;
    protected string $phone;
    protected string $birth_date;
    protected string $thumbnail;
    protected bool $vip = false;

    public function userCreateProfile(){

        $view = new View("User/userCreateProfile", "front");
    }

    public function userValidProfile(){

        $newUser = new User();
        $nom = filter_var(Verificator::securiser($_POST["nom"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_var(Verificator::securiser($_POST["prenom"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var(Verificator::securiser($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(Verificator::securiser($_POST["phone"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $birth_date = filter_var(Verificator::securiser($_POST["birth_date"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnail = filter_var(Verificator::securiser($_POST["thumbnail"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_var(Verificator::securiser($_POST["thumbnail"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp2 = filter_var(Verificator::securiser($_POST["thumbnail"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vip = false;


        if ( $mdp == $mdp2)  {

            $newUser->hydrate($nom, $prenom, $email, $phone, $birth_date, $thumbnail, $vip, $mdp);
            $newUser->createUser();
            echo "Votre compte a bien été créé";

        } else {

            echo "Les mots de passe ne correspondent pas";
        }

        $view = new View("User/userCreateProfile", "front");
    }

    public function userProfile()
    {
        $view = new View("User/userProfile", "front");
    }

    public function userInterface()
    {
        $view = new View("User/userInterface", "front");
    }

    public function contact()
    {
        $view = new View("User/contact", "front");
    }


}