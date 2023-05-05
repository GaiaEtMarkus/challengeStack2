<?php
namespace App\Controllers;
use App\Core\View;

class Main{
    public function index(){

        $pseudo = "Prof";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
    }

}