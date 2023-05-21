<?php
namespace App\Controllers;
use App\Core\View;
use App\Core\Verificator;
use App\Models\User;

class UserController{
    
    protected int $id = 0;
    protected string $name;
    protected string $surname;
    protected string $email;
    protected string $phone;
    protected string $country;
    protected string $birth_date;
    protected string $thumbnail;
    protected string $pwd;
    protected bool $vip = false;

    public function userCreateProfile(){

        $view = new View("User/userCreateProfile", "front");
    }

    public function userValidProfile(){

        $newUser = new User();
        $name = filter_var(Verificator::securiser($_POST["name"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $surname = filter_var(Verificator::securiser($_POST["surname"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var(Verificator::securiser($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(Verificator::securiser($_POST["phone"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $country = filter_var(Verificator::securiser($_POST["country"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $birth_date = filter_var(Verificator::securiser($_POST["birth_date"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnail = filter_var(Verificator::securiser($_POST["thumbnail"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pwd = filter_var(Verificator::securiser($_POST["pwd"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPwd = filter_var(Verificator::securiser($_POST["confirmPwd"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vip = false;


        if ( $pwd == $confirmPwd)  {

            $newUser->hydrate($name, $surname, $email, $phone, $birth_date, $thumbnail, $pwd, $country, $vip);
            $newUser->createUser($newUser);
            echo "Votre compte a bien été créé";

        } else {

            echo "Les mots de passe ne correspondent pas";
        }

        $view = new View("User/userInterface", "front");
    }

    public function userProfile()
    {

        // appeller 
        // User::methodeDesirer()
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