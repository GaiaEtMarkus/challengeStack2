<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class LoginForm extends AForm {
    
    protected $method = "POST";
    
    public function getConfig(): array {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "/login", // URL de la page qui traitera la soumission du formulaire
                "submit" => "Se connecter"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Email",
                    "error" => "Veuillez entrer un email valide"
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Mot de passe",
                    "error" => "Veuillez entrer un mot de passe valide"
                ]
            ]
        ];
    }
}
