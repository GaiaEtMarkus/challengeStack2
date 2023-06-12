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
            $isModifyForm = false; 
            $view->assign('isModifyForm', $isModifyForm);


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
                        $thumbnailPath = './assets/userProfile/' . $thumbnail['name'];
                        var_dump($thumbnailPath); // Ajout du var_dump pour déboguer la valeur de $thumbnail
                        move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath);
                    } else {
                        $thumbnailPath = null; // Pas de fichier téléchargé
                    }

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

    public function deleteProduct(): void
    {
        $productId = $_POST['productId'];
        var_dump($_GET['productId']);

        $product = new Product();
        $product->delete($productId);
        
        $message = "Le produit a été supprimé avec succès.";
        header('Location: /userInterface?message=' . urlencode($message));
    }
    

}
