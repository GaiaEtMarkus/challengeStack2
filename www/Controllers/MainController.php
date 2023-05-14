<?php
namespace App\Controllers;
use App\Core\View;

class MainController{
    public function index(){

        $pseudo = "user";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
    }
}