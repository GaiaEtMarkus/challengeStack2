<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Forms\AddUser;
use App\Core\Security;
use App\Forms\ModifyProfile;
use App\Forms\DeleteProfile;
use App\Forms\LoginUser;
use App\Core\SqlModerator;
use App\Models\Moderator;

class ModeratorController {

    public function displayNewUsers(): void {

        $moderator = new Moderator();
        $newUsers = $moderator->getUnverifiedUsers(); 
      
        $view = new View("Moderator/displayNewUsers", "back");
        $view->assign('newUsers', $newUsers);
      }

      
    public function validUser()
    {
        $userId = $_GET['userId'];

        $moderator = new Moderator();
        $moderator->verify($userId);

        header("Location: /displaynewusers");
    }

    public function displayNewProducts()
    {
        $moderator = new Moderator();
        $products = $moderator->getUnverifiedProducts();

        $view = new View("Moderator/displayNewProducts", "back", compact('products'));
        $view->assign('products', $products);
    }

    public function validProduct()
    {
        $productId = $_POST['productId'];

        $moderatorSql = new Moderator();
        $moderatorSql->verifyProduct($productId);


        header("Location: /displaynewproducts");
        exit;
    }
}
