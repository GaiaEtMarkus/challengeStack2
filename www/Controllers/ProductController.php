<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;
use App\Core\Security;
use App\Forms\AddProduct;
use App\Forms\LoginUser;
use App\Forms\ModifyProfile;
use App\Forms\DeleteProfile;

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
    
        $form = new AddProduct();
        $view = new View("Forms/form", "front");
        $view->assign('form', $form->getConfig());
        $isModifyForm = false; 
        $view->assign('isModifyForm', $isModifyForm);

        if($form->isSubmit()){
            $errors = Security::form($form->getConfig(), $_POST);
            if(empty($errors)){
                $is_verified = "f";
                $id_role = 1;
                $id = null;
                $hashedPassword = Security::hashPassword($_POST['pwd']);
                $user = new User();
                $user->hydrate(
                    $id,
                    $id_role,
                    Security::securiser($_POST['firstname']), 
                    Security::securiser($_POST['lastname']), 
                    Security::securiser($_POST['pseudo']), 
                    Security::securiser($_POST['email']), 
                    Security::securiser($_POST['phone']), 
                    Security::securiser($_POST['birth_date']), 
                    Security::securiser($_POST['address']),
                    Security::securiser($_POST['zip_code']),
                    Security::securiser($_POST['country']),
                    $hashedPassword,                    
                    Security::securiser($_POST['thumbnail']), 
                    $is_verified
                );
                // Enregistrement de l'utilisateur dans la base de données
                $user->save();
                echo "Insertion en BDD";
            } else{
                $view->assign('errors', $errors);
            }
        }
    }

}
