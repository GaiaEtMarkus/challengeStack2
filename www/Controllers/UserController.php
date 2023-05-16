<?php
namespace App\Controllers;
use App\Core\View;

class UserController{

    public function userCreateProfile(){

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