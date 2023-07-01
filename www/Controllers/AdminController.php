<?php
namespace App\Controllers;

use App\Core\View;


class AdminController {

    public function adminInterface(): void 
    {
        $view = new View("Admin/adminInterface", "back");
    }

}