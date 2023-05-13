<?php
namespace App\Controllers;
use App\Core\View;

class UserController{

    public function userCreateProfile(){

        $view = new View("User/userCreateProfile", "front");
        
    }

}