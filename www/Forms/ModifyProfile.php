<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\User;

class ModifyProfile extends AForm {
    

    protected $method = "POST";

    public function getConfig(): array
    {        

        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Modifier",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "min" => 2,
                    "max" => 256,
                    "value" => $_SESSION['userData']['firstname'],
                    "error" => "Votre prénom doit faire entre 2 et 256 caractères"
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom",
                    "min" => 2,
                    "max" => 256,
                    "value" => $_SESSION['userData']['lastname'],
                    "error" => "Votre nom doit faire entre 2 et 256 caractères"
                ],
                "pseudo" => [
                    "type" => "text",
                    "placeholder" => "Votre pseudo",
                    "min" => 2,
                    "max" => 16,
                    "value" => $_SESSION['userData']['pseudo'],
                    "error" => "Votre nom doit faire entre 2 et 16 caractères"
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "value" => $_SESSION['userData']['email'],
                    "error" => "Le format de votre email est incorrect"
                ],
                "phone" => [
                    "type" => "number",
                    "placeholder" => "Votre numéro de téléphone",
                    "value" => $_SESSION['userData']['phone'],
                    "error" => "Le format de votre téléphone est incorrect"
                ],
                "birth_date" => [
                    "type" => "date",
                    "placeholder" => "Votre date de naissance",
                    "value" => $_SESSION['userData']['birth_date'],
                    "error" => "Le format de votre date de naissance est incorrect"
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "error" => "Votre mot de passe est incorrect"
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation",
                    "error" => "Les mots de passe ne sont pas identiques"
                ],
                "address" => [
                    "type" => "text",
                    "placeholder" => "Votre adresse",
                    "min" => 2,
                    "max" => 256,
                    "value" => $_SESSION['userData']['address'],
                ],
                "zip_code" => [
                    "type" => "number",
                    "placeholder" => "Votre code postal",
                    "min" => 2,
                    "max" => 5,
                    "value" => $_SESSION['userData']['zip_code'],
                ],
                "country" => [
                    "type" => "select",
                    "options" => ["", "FR", "US", "EN", "MOR", "ALG", "TUN", "CAM", "SEN"],
                    "value" => $_SESSION['userData']['country'],
                    "error" => "Pays incorrect"
                ],
                "thumbnail" => [
                    "type" => "text",
                    "error" => "Une erreur est survenue avec la valeur thumnbail",
                    "placeholder" => "Chemin de la photo de profil",
                    "value" => $_SESSION['userData']['thumbnail'],
                ]
            ]
        ];
    }
}
