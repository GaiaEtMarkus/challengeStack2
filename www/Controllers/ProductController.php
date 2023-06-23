<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Security;
use App\Forms\AddProduct;
use App\Forms\LoginUser;
use App\Forms\ModifyProfile;
use App\Forms\DeleteProfile;
use App\Models\Product;
use App\Forms\ModifyProduct;

class ProductController {
    
    // protected int $id = 0;
    // protected string $firstname;
    // protected string $surname;
    // protected string $email;
    // protected string $phone;
    // protected string $country;
    // protected string $birth_date;
    // protected string $thumbnail;
    // protected string $pwd;
    // protected bool $vip = false;

    public function createProduct(): void {
        if (isset($_SESSION['userData'])) {
            if ($_SESSION['userData']['is_verified'] === true) {
                $form = new AddProduct();
                $view = new View("Forms/form", "front");
                $view->assign('form', $form->getConfig());
    
                if ($form->isSubmit()) {
                    $id = null;
                    $product = new Product();
                    $categoryName = Security::securiser($_POST['id_category']);
                    $categoryOptions = $_SESSION['categoryOptions'];
                    $id_category = array_search($categoryName, array_column($categoryOptions, 'value')) + 1;
                    $errors = Security::form($form->getConfig(), $_POST);
                    $trokos = 0;
                    $is_verified = false;
    
                    if (empty($errors)) {
                        $thumbnail = $_FILES['thumbnail'] ?? null;
                        if ($thumbnail && $thumbnail['error'] === UPLOAD_ERR_OK) {
                            $thumbnailPath = './assets/product/' . $thumbnail['name'];
                            move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                        } else {
                            $thumbnailPath = null; // Pas de fichier téléchargé
                        }
    
                        $product->hydrate(
                            $id,
                            $id_category,
                            $_SESSION['userData']['id'],
                            Security::securiser($_POST['titre']),
                            Security::securiser($_POST['description']),
                            $trokos,
                            $thumbnailPath,
                            $is_verified
                        );
                        $product->save();
    
                        echo "Insertion en BDD";
                    } else {
                        $view->assign('errors', $errors);
                    }
                }
            } else {
                $message = "Votre profil doit être validé avant de pouvoir créer un produit. Veuillez attendre la validation de votre profil sous 24h ouvrables maximum après la date de création de votre profil.";
                header('Location: /?message=' . urlencode($message));
                exit;
            }
        } else {
            $message = "Veuillez vous connecter afin de pouvoir créer un produit.";
            header('Location: /?message=' . urlencode($message));
            exit;
        }
    }
    

    public function modifyProduct()
    {
        $productId = intval($_POST['productId']);
    
        if (isset($_SESSION['userData'])) {
            $form = new ModifyProduct;
            $view = new View("Forms/form", "front");
            $product = new Product();
            $productData = $product->getProductById($productId);
            $_SESSION['productData'] = $productData;
            $view->assign('form', $form->getConfig($productData));
    
            if ($form->isSubmit()) {
                $errors = Security::form($form->getConfig(), $_POST);
                if (empty($errors)) {
                    $thumbnail = $_FILES['thumbnail_old'] ?? null;
                    $thumbnailPath = $thumbnail ? './assets/product/' . $thumbnail['name'] : $productData['thumbnail'];
    
                    if ($thumbnail && $thumbnail['error'] === UPLOAD_ERR_OK) {
                        move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                    }
    
                    $categoryName = Security::securiser($_POST['id_category']);
                    $categoryOptions = $_SESSION['categoryOptions'];
                    var_dump($categoryOptions); // Ajout du var_dump pour déboguer la valeur de $categoryOptions
                    $id_category = array_search($categoryName, array_column($categoryOptions, 'value')) + 1 ;

    
                    $product->hydrate(
                        $productData['id'],
                        $id_category,
                        $productData['id_seller'],
                        Security::securiser($_POST['title']),
                        Security::securiser($_POST['description']),
                        $productData['trokos'],
                        $thumbnailPath
                    );
                    $product->save();
    
                    echo "Mise à jour réussie";
                    // Redirection
                } else {
                    $view->assign('errors', $errors);
                }
            }
    
            $view->assign('productData', $productData);
        } else {
            $message = "Veuillez vous connecter afin de pouvoir modifier le produit !";
            header('Location: /?message=' . urlencode($message));
        }
    }
    
    public function deleteProduct(): void
    {
        $productId = $_POST['productId'];
        var_dump($productId); // Ajout du var_dump pour déboguer la valeur de $productId
        $product = new Product();
        $product->delete($productId);
        
        $message = "Le produit a été supprimé avec succès.";
        // header('Location: /userInterface?message=' . urlencode($message));
    }

    public function displayProducts()
    {
        $product = new Product();
        $products = $product->getVerifiedProducts();

        $view = new View("Product/displayProducts", "front", compact('products'));
        $view->assign('products', $products);
    }

    public function displayProductDetails(): void
    {
        if (isset($_GET['productId'])) {
            $productId = intval($_GET['productId']);
            $product = new Product();
            $productData = $product->getProductById($productId);
    
            if ($productData) {
                $view = new View("Product/displayProductDetails", "front");
                $view->assign('product', $productData);
            } else {
                $message = "Produit non trouvé.";
                header('Location: /?message=' . urlencode($message));
                exit;
            }
        }
    }
}
