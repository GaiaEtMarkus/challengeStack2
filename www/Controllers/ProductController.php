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
    
    protected int $id = 0;
    protected string $firstname;
    protected string $surname;
    protected string $email;
    protected string $phone;
    protected string $country;
    protected string $birth_date;
    protected string $thumbnail;
    protected string $pwd;
    protected bool $vip = false;


    public function createProduct(): void {

        if (isset($_SESSION['userData'])) {

            $form = new AddProduct();
            $view = new View("Forms/form", "front");
            $view->assign('form', $form->getConfig());


            if($form->isSubmit()){

                $id = null ;
                $product = new Product();
                $categoryName = Security::securiser($_POST['id_category']);
                $categoryOptions = $_SESSION['categoryOptions'];
                var_dump($categoryOptions); // Ajout du var_dump pour déboguer la valeur de $categoryOptions
                $id_category = array_search($categoryName, array_column($categoryOptions, 'value')) + 1 ;
                $errors = Security::form($form->getConfig(), $_POST);
                $trokos = 0;

                if(empty($errors)){

                    $thumbnail = $_FILES['thumbnail'] ?? null;
                    if ($thumbnail && $thumbnail['error'] === UPLOAD_ERR_OK) {
                        $thumbnailPath = './assets/product/' . $thumbnail['name'];
                        var_dump($thumbnailPath); // Ajout du var_dump pour déboguer la valeur de $thumbnail
                        move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                    } else {
                        $thumbnailPath = null; // Pas de fichier téléchargé
                    }
                            
                    var_dump($thumbnail); // Ajout du var_dump pour déboguer la valeur de $thumbnail

                    $product = new Product();
                    $product->hydrate(
                        $id,
                        $id_category, 
                        $_SESSION['userData']['id'], 
                        Security::securiser($_POST['titre']), 
                        Security::securiser($_POST['description']), 
                        $trokos, 
                        $thumbnailPath, 
                    );
                    $product->save();
                    echo "Insertion en BDD";
                } else{
                    $view->assign('errors', $errors);
                }
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
            var_dump($productData);
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
    
                    $product->hydrate(
                        $productData['id'],
                        $productData['id_category'],
                        $productData['id_seller'],
                        Security::securiser($_POST['title']),
                        Security::securiser($_POST['description']),
                        $productData['trokos'],
                        $thumbnailPath,
                    );
                    $product->save();
    
                    echo "Mise à jour réussie";
                    // Redirection
                } else {
                    $view->assign('errors', $errors);
                }
            }
    
            // Assignez les données du produit à la vue
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
    

}
