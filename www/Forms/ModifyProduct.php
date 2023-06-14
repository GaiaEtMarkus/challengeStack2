<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Product;

class ModifyProduct extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {           
        $productData = $_SESSION['productData'];

        $product = new Product();
        $categories = $product->getCategories();
        $categoryOptions = [];

        if (is_array($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                $selected = $category['name'] === $_SESSION['productData']['id_category'] ? true : false;
                $categoryOptions[] = ['value' => $category['name'], 'selected' => $selected];
            }
        }

        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "/modifyproduct",
                "enctype" => "",
                "submit" => "Modifier",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "id_category" => [
                    "type" => "select",
                    "options" => $categoryOptions,
                    "required" => true,
                    "error" => "La catégorie est requise"
                ],
                "title" => [
                    "type" => "text",
                    "placeholder" => "Titre du produit",
                    "min" => 2,
                    "max" => 256,
                    "required" => true,
                    "error" => "Le titre du produit doit faire entre 2 et 256 caractères",
                    "value" => $productData['title']
                ],
                "description" => [
                    "type" => "textarea",
                    "placeholder" => "Description du produit",
                    "required" => true,
                    "error" => "La description du produit est requise",
                    "value" => $productData['description']
                ],
                "thumbnail" => [
                    "type" => "text",
                    "error" => "Une erreur est survenue avec la valeur thumbnail",
                    "placeholder" => "Chemin de la photo de produit",
                    "required" => true,
                    "value" => $productData['thumbnail']
                ],
                "productId" => [
                    "type" => "hidden",
                    "required" => true,
                    "value" => $productData['id']
                ]
            ]
        ];
    }
}
?>