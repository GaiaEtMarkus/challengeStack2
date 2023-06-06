<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Core\View;

class AddProduct extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
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
                    "type"=>"number",
                    "placeholder"=>"ID de catégorie",
                    "min"=>1,
                    "required"=>true,
                    "error"=>"L'ID de catégorie est incorrect"
                ],
                "id_seller"=>[
                    "type"=>"number",
                    "placeholder"=>"ID du vendeur",
                    "min"=>1,
                    "required"=>true,
                    "error"=>"L'ID du vendeur est incorrect"
                ],
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
                "trokos"=>[
                    "type"=>"text",
                    "placeholder"=>"Valeur en trokos",
                    "required"=>true,
                    "error"=>"La valeur en trokos est incorrecte"
                ],
                "thumbnail" => [
                    "type" => "text",
                    "placeholder"=>"Chemin de la photo de profil",
                    "required"=>true,
                    "error" => "Une erreur est survenue avec la valeur thumbnail"
                ]
            ]
        ];
    }
}
