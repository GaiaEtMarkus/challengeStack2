<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Core\View;

class AddUser extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "multipart/form-data",
                "submit" => "S'inscrire",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "min" => 2,
                    "max" => 256,
                    "required" => true,
                    "error" => "Votre prénom doit faire entre 2 et 25§ caractères"
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom",
                    "min" => 2,
                    "max" => 256,
                    "required" => true,
                    "error" => "Votre nom doit faire entre 2 et 256 caractères"
                ],
                "pseudo" => [
                    "type" => "text",
                    "placeholder" => "Votre pseudo",
                    "min" => 2,
                    "max" => 16,
                    "required" => true,
                    "error" => "Votre nom doit faire entre 2 et 16 caractères"
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "required" => true,
                    "error" => "Le format de votre email est incorrect"
                ],
                "phone" => [
                    "type" => "number",
                    "placeholder" => "Votre numéro de téléphone",
                    "required" => true,
                    "error" => "Le format de votre téléphone est incorrect"
                ],
                "birth_date" => [
                    "type" => "date",
                    "placeholder" => "Votre date de naissance",
                    "required" => true,
                    "error" => "Le format de votre date de naissance est incorrect"
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "required" => true,
                    "error" => "Votre mot de passe est incorrect"
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation",
                    "confirm" => "pwd",
                    "required" => true,
                    "error" => "Les mots de passe ne sont pas identiques"
                ],
                "address" => [
                    "type" => "text",
                    "placeholder" => "Votre adresse",
                    "min" => 2,
                    "max" => 256,
                    "required" => true,
                ],
                "zip_code" => [
                    "type" => "number",
                    "placeholder" => "Votre code postal",
                    "min" => 2,
                    "max" => 5,
                    "required" => true,
                ],
                "country" => [
                    "type" => "select",
                    "options" => View::buildCountryOptions(),
                    "required" => true,
                    "error" => "Pays incorrect"
                ],
                "thumbnail" => [
                    "type" => "file",
                    "placeholder" => "Photo du produit",
                    "required" => true,
                    "error" => "Une erreur est survenue lors du téléchargement du fichier"
                ]
            ]
        ];
    }
}