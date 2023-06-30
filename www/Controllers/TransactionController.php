<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Transaction;
use App\Models\Product;
use App\Core\Security;

class TransactionController
{
    public function createTransaction()
    {
        if (isset($_SESSION['userData'])) {
            $productId = Security::securiser($_POST['productId']);
    
            if ($productId) {
                $product = new Product();
                $productData = $product->getProductById($productId);
    
                if ($productData) {
                    $userId = $_SESSION['userData']['id'];
                    $sellerProducts = $product->getProductsByUserId($userId);
    
                    $view = new View("transaction/createTransaction", "front");
                    $view->assign('productData', $productData);
                    $view->assign('exchangeProducts', $sellerProducts);
                } else {
                    $message = "Le produit sélectionné n'existe pas.";
                    header('Location: /?message=' . urlencode($message));
                    exit;
                }
            } else {
                // Rediriger vers une page appropriée
            }
        } else {
            $message = "Veuillez vous connecter pour créer une transaction.";
            header('Location: /?message=' . urlencode($message));
        }
    }

    public function saveTransaction()
    {
        if (isset($_SESSION['userData'])) {

            $transaction = new Transaction;
            $productId =  Security::securiser(intval($_POST['productReceiverId']));
            $receiverId = Security::securiser(intval($_POST['receiverId']));
            $receiverTrokos = intval($_POST['receiverTrokos']);
            $exchangeProductId = $_POST['exchangeProductId'];
            $productSender = $transaction->getProductById($exchangeProductId);
            $senderTrokos = $productSender['trokos'];
            $quality = ($receiverTrokos - $senderTrokos);
            $is_validate = true;
            $id= null;
            $userId = $_SESSION['userData']['id'];
            $transaction->hydrate($id, $receiverId, $userId, $productId, $exchangeProductId, $is_validate, $quality);
            $transaction->save();

            $message = "Votre proposition de transaction a bien été effectué.";
            header('Location: /displayProducts?message=' . urlencode($message));        
        } else {
            $message = "Veuillez vous connecter pour créer une transaction.";
            header('Location: /displayProducts?message=' . urlencode($message));
        }
    }
    
    public function validateTransaction()
    {   
        $transactionId = Security::securiser($_POST['transactionId']);
        $transaction = new Transaction;
        $transaction->validateTransaction($transactionId);

        $message = "La transaction a bien été acceptée !";
        header('Location: /userInterface?message=' . urlencode($message)); 
    }
    
}

  