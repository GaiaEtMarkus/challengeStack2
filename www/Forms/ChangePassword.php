<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class ChangePassword extends AForm {
    
    protected $method = "POST";
    
    public function getConfig(): array {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "submit" => "Se connecter",
                "action" => "",
                "enctype" => "",
            ],
            "inputs" => [
                "password" => [
                    "type" => "text",
                    "placeholder" => "Mot de passe",
                    "required"=>true,
                    "error" => "Veuillez saisir un mot de passe valide"
                ],
                "confirmPassword" => [
                    "type" => "text",
                    "placeholder" => "Confirmer votre mot de passe",
                    "required"=>true,
                    "error" => "Veuillez entrer un mot de passe valide"
                ]
            ]
        ];
    }
}
