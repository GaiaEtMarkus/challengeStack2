<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class DeleteProfile extends AForm {
    
    protected $method = "POST";
    
    public function getConfig(): array {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "/login",
                "submit" => "Supprimer son compte"
            ],
            "deleteThisProfile" => [
                "type" => "text",
                "placeholder" => "Entrez 'deleteThisProfile' pour confirmer",
                "required" => true,
                "error" => "Veuillez entrer la confirmation de suppression"
            ],
        ];
    }
}
