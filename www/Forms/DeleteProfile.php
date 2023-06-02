<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class DeleteProfile extends AForm {
    
    protected $method = "POST";
    
    public function getConfig(): array {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "submit" => "Supprimer son compte",
                "action" => "",
                "enctype" => ""
            ],
            "inputs" => [
                "deleteThisProfile" => [
                    "type" => "text",
                    "placeholder" => "Entrez 'deleteThisProfile' pour confirmer",
                    "required" => true,
                    "error" => "Veuillez entrer la confirmation de suppression"
                ],
            ]
        ];
    }
}
