<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Security;
use App\Models\Moderator;
use App\Models\Product;

class AdminController {

    public function moderatorInterface(): void 
    {
        $moderator = new Moderator();
        $newUsers = $moderator->getUnverifiedUsers(); 
        $newProducts = $moderator->getUnverifiedProducts();
      
        $view = new View("Moderator/adminInterface", "back");
        $view->assign('newUsers', $newUsers);
        $view->assign('newProducts', $newProducts);

    }
}