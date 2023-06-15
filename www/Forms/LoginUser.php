<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class LoginUser extends AForm {
    
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
                "email" => [
                    "type" => "email",
                    "placeholder" => "Email",
                    "required"=>true,
                    "error" => "Veuillez entrer un email valide"
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Mot de passe",
                    "required"=>true,
                    "error" => "Veuillez entrer un mot de passe valide"
                ]
            ]
        ];
    }
}
