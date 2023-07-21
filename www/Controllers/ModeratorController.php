<?php
namespace App\Controllers;

require_once('./Core/Functions.php');

use App\Models\User;
use App\Core\View;
use App\Core\Security;
use App\Models\Moderator;
use App\Models\Product;

class ModeratorController {

    public function moderatorInterface(): void 
    {
        if ($_SESSION['userData']['id_role'] == 2 || $_SESSION['userData']['id_role'] == 3) {

        $moderator = new Moderator();
        $newUsers = $moderator->getUnverifiedUsers(); 
        $users = $moderator->getAllFromTable("User"); 
        $newProducts = $moderator->getUnverifiedProducts();
        $products = $moderator->getAllFromTable('Product');
      
        $view = new View("Moderator/moderatorInterface", "back");
        $view->assign('newUsers', $newUsers);
        $view->assign('newProducts', $newProducts);
        $view->assign('products', $products);
        $view->assign('users', $users);
        } else {
            header('Location: /error404');
        }
    }
      
    public function validUser()
    {
        if ($_SESSION['userData']['id_role'] == 2 || $_SESSION['userData']['id_role'] == 3) {

            $userId = Security::securiser($_POST['userId']);
            $moderator = new Moderator();
            $userData = $moderator->getUserById($userId);
            $userPseudo = $userData['pseudo'];
            $userMail = $userData['email'];
            $moderator = new Moderator();
            $userData = $moderator->validUser($userId);

                $subject = "Validation de profil";
                $message = "Bonjour {$userPseudo} ! Ceci est un message pour te signaler que ton profil a bien été validé ! A bientôt sur Trokos";
    
                mailFormContact($subject, $userMail, $subject, $message);
                mailFormContact($subject, "trokos.contact@gmail.com", $subject, "Vous avez bien validé le profi de : {$userMail}!");
        
                $message = "L'utilisateur a bien été validé !";
                header('Location: /moderatorinterface?message=' . urlencode($message));             
            } else {
                header('Location: /error404');
        }
    }   

    public function refuseUser()
    {
        if ($_SESSION['userData']['id_role'] == 2 || $_SESSION['userData']['id_role'] == 3) {
            
            $userId = intval(Security::securiser($_POST['userId']));
            $moderator = new Moderator();
            $user = new User();
            $userData = $moderator->getUserById($userId);
            // dd($userData);
            $moderator->deleteUserWithProductsAndTransactions($userId);
            $userPseudo = $userData['pseudo'];
            $userMail = $userData['email'];

            $subject = "Refus de profil";
            $message = "Bonjour {$userPseudo} ! Ceci est un message pour te signaler que ton profil a malheuresement été suspendu ! Merci de nous contacter. A bientôt sur Trokos";

            mailFormContact($subject, $userMail, $subject, $message);
            mailFormContact($subject, "trokos.contact@gmail.com", $subject, "Vous avez bien exclu le profi de : {$userMail}!");
    
            $message = "L'utilisateur a été refusé !";
            header('Location: /moderatorinterface?message=' . urlencode($message));  
        } else {
            header('Location: /error404');
        }
    }

    public function displayNewProducts()
    {
        if ($_SESSION['userData']['id_role'] == 2 || $_SESSION['userData']['id_role'] == 3) {

        $moderator = new Moderator();
        $products = $moderator->getUnverifiedProducts();

        $view = new View("Product/displayNewProducts", "back", compact('products'));
        $view->assign('products', $products);
        } else {
            header('Location: /error404');
    }
    }

    public function validProduct()
    {
        if ($_SESSION['userData']['id_role'] == 2 || $_SESSION['userData']['id_role'] == 3) {
            $productId = Security::securiser($_POST['productId']);
        $trokos = Security::securiser($_POST['trokos']);
        $user = new User;
        $userData = $user->getUserById($_SESSION['userData']['id']);
        $userPseudo = $userData[0]['pseudo'];
        $userMail = $userData[0]['email'];
        $moderator = new Moderator();
        $productData = $moderator->getProductById($productId);
    
        $moderator -> validProduct($productId, $trokos);

            $subject = "Validation de produit";
            $message = "Bonjour {$userPseudo} ! Ceci est un message pour te signaler que ton produit {$productData['title']} a bien été validé ! A bientôt sur Trokos";

            mailFormContact($subject, $userMail, $subject, $message);
            mailFormContact($subject, "trokos.contact@gmail.com", $subject, "Vous avez bien validé le produit {$productData['title']} de : {$userMail}!");
    
            header("Location: /moderatorinterface");
        } else {
            header('Location: /error404');
        }
    }

    public function refuseProduct()
    {
        if ($_SESSION['userData']['id_role'] == 2 || $_SESSION['userData']['id_role'] == 3) {

            $productId = Security::securiser($_POST['productId']);
            $user = new User;
            $userData = $user->getUserById($_SESSION['userData']['id']);
            $userPseudo = $userData['pseudo'];
            $userMail = $userData['email'];
            $moderator = new Moderator();
            $productData = $moderator->getProductById($productId);
            $product = new Product;
            $product->delete($productId);

            $subject = "Refus de produit";
            $message = "Bonjour {$userPseudo} ! Ceci est un message pour te signaler que ton produit {$productData['title']} a malheuresement été refusé ! Merci de nous contacter. A bientôt sur Trokos";

            mailFormContact($subject, $userMail, $subject, $message);
            mailFormContact($subject, "trokos.contact@gmail.com", $subject, "Vous avez bien refusé le produit de : {$userMail}!");
    
            $message = "Le produit a été refusé !";
            header('Location: /moderatorinterface?message=' . urlencode($message));  
        } else {
            header('Location: /error404');
        }
    }
}
