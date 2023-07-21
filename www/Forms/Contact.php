<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class Contact extends AForm {
    
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
                "name" => [
                    "type" => "text",
                    "placeholder" => "Votre nom",
                    "required"=>true,
                    "error" => "Veuillez  saisir votre nom"
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "required"=>true,
                    "error" => "Veuillez saisir votre email"
                ],
                "subject" => [
                    "type" => "text",
                    "placeholder" => "Le sujet",
                    "required"=>true,
                    "error" => "Veuillez saisir le sujet"
                ],
                "message" => [
                    "type" => "textarea",
                    "placeholder" => "Le message",
                    "required"=>true,
                    "error" => "Veuillez saisir le message"
                ]
            ]
        ];
    }
}
