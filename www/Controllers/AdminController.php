<?php
namespace App\Controllers;

use App\Core\View;
use App\Forms\Initialisation;


class AdminController {

    public function adminInterface(): void 
    {
        $view = new View("Admin/adminInterface", "back");
    }
}