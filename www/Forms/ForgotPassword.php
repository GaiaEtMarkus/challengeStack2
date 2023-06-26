<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class ForgotPassword extends AForm {
    
    protected $method = "POST";
    
    public function getConfig(): array {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "submit" => "Envoyer e-mail",
                "action" => "",
                "enctype" => ""
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Veuillez saisir votre email",
                    "required" => true,
                    "error" => "Veuillez entrer la confirmation de suppression"
                ],
                "message" => [
                    "type" => "hidden",
                    "required" => true,
                    "error" => "",
                    "value" => "Message automatique"
                ],
                "subject" => [
                    "type" => "hidden",
                    "placeholder" => "",
                    "required" => true,
                    "error" => "",
                    "value" => "Mot de passe oublié"
                ],
                "name" => [
                    "type" => "hidden",
                    "placeholder" => "",
                    "required" => true,
                    "error" => "",
                    "value" => "Message automatique"
                ],
            ]
        ];
    }
}
