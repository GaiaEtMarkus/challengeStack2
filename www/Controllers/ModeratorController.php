<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Security;
use App\Models\Moderator;
use App\Models\Product;

class ModeratorController {

    public function displayNewUsers(): void {

        $moderator = new Moderator();
        $newUsers = $moderator->getUnverifiedUsers(); 
      
        $view = new View("User/displayNewUsers", "back");
        $view->assign('newUsers', $newUsers);
      }

      
      public function validUser()
      {
          $userId = Security::securiser($_GET['userId']);
      
          $moderator = new Moderator();
          $userData = $moderator->getUserById($userId);
          var_dump($userData); 

          if ($userData) {
              $userData['is_verified'] = true;
              $user = new User();
              $user->hydrate(
                  $userData['id'],
                  $userData['id_role'],
                  $userData['firstname'],
                  $userData['lastname'],
                  $userData['pseudo'],
                  $userData['email'],
                  $userData['phone'],
                  $userData['birth_date'],
                  $userData['address'],
                  $userData['zip_code'],
                  $userData['country'],
                  $userData['pwd'],
                  $userData['thumbnail'],
                  $userData['token_hash'],
                  $userData['is_verified']
              );
      
              $user->save();
      
              header("Location: /displaynewusers");
          } else {
          }
      }
      

    public function displayNewProducts()
    {
        $moderator = new Moderator();
        $products = $moderator->getUnverifiedProducts();

        $view = new View("Product/displayNewProducts", "back", compact('products'));
        $view->assign('products', $products);
    }

    public function validProduct()
    {
        $productId = Security::securiser($_POST['productId']);
        $trokos = Security::securiser($_POST['trokos']);
    
        $moderator = new Moderator();
        $productData = $moderator->getProductById($productId);
    
        if ($productData) {

            $productData['trokos'] = $trokos;
            $productData['is_verified'] = true;
    
            $product = new Product();
            $product->hydrate(
                $productData['id'],
                $productData['id_category'],
                $productData['id_seller'],
                $productData['title'],
                $productData['description'],
                $productData['trokos'],
                $productData['thumbnail'],
                $productData['is_verified']
            );
                
            $product->save();
    
            header("Location: /displaynewproducts");
        } else {
        }
    }
}
