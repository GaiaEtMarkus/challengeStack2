<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Product;

class AddProduct extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
        $product = new Product();
        $categories = $product->getCategories(); // Récupérez toutes les catégories
        // var_dump($categories); // Ajoutez var_dump ici pour afficher les catégories
        $categoryOptions = [];

        if (is_array($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                $categoryOptions[] = ['value' => $category['name'], 'selected' => false];
            }
            $_SESSION['categoryOptions'] = $categoryOptions;
        }

        // var_dump($categoryOptions);

        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "submit"=>"Ajouter",
                "cancel"=>"Annuler"
            ],
            "inputs" =>[
                "id_category"=>[
                    "type"=>"select",
                    "options" => $categoryOptions, // Ajoutez les options ici
                    "required"=>true,
                    "error"=>"La catégorie est requise"
                ],
                // "id_seller"=>[
                //     "type"=>"number",
                //     "placeholder"=>"ID du vendeur",
                //     "min"=>1,
                //     "required"=>true,
                //     "error"=>"L'ID du vendeur est incorrect"
                // ],
                "titre"=>[
                    "type"=>"text",
                    "placeholder"=>"Titre du produit",
                    "min"=>2,
                    "max"=>256,
                    "required"=>true,
                    "error"=>"Le titre du produit doit faire entre 2 et 256 caractères"
                ],
                "description"=>[
                    "type"=>"textarea",
                    "placeholder"=>"Description du produit",
                    "required"=>true,
                    "error"=>"La description du produit est requise"
                ],
                // "trokos"=>[
                //     "type"=>"number",
                //     "placeholder"=>"Valeur en trokos",
                //     "required"=>true,
                //     "error"=>"La valeur en trokos est incorrecte"
                // ],
                "thumbnail" => [
                    "type" => "text",
                    "placeholder"=>"Chemin de la photo de profil",
                    "required"=>true,
                    "error" => "Une erreur est survenue avec la valeur thumbnail"
                ]
            ]
        ];
        // var_dump($categoryOptions);
    }
}
