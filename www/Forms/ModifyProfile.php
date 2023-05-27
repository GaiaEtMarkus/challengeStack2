<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class ModifyProfile extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
        $user = $_SESSION['userConnected'];

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
                    "value" => $user->getFirstname(),
                    "error" => "Votre prénom doit faire entre 2 et 256 caractères"
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom",
                    "min" => 2,
                    "max" => 256,
                    "value" => $user->getLastname(),
                    "error" => "Votre nom doit faire entre 2 et 256 caractères"
                ],
                "pseudo" => [
                    "type" => "text",
                    "placeholder" => "Votre pseudo",
                    "min" => 2,
                    "max" => 16,
                    "value" => $user->getPseudo(),
                    "error" => "Votre nom doit faire entre 2 et 16 caractères"
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "value" => $user->getEmail(),
                    "error" => "Le format de votre email est incorrect"
                ],
                "phone" => [
                    "type" => "number",
                    "placeholder" => "Votre numéro de téléphone",
                    "value" => $user->getPhone(),
                    "error" => "Le format de votre téléphone est incorrect"
                ],
                "birth_date" => [
                    "type" => "date",
                    "placeholder" => "Votre date de naissance",
                    "value" => $user->getBirthDate(),
                    "error" => "Le format de votre date de naissance est incorrect"
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "value" => $user->getPwd(),
                    "error" => "Votre mot de passe est incorrect"
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation",
                    "confirm" => "pwd",
                    "error" => "Les mots de passe ne sont pas identiques"
                ],
                "address" => [
                    "type" => "text",
                    "placeholder" => "Votre adresse",
                    "min" => 2,
                    "max" => 256,
                    "value" => $user->getAddress()
                ],
                "zip_code" => [
                    "type" => "number",
                    "placeholder" => "Votre code postal",
                    "min" => 2,
                    "max" => 5,
                    "value" => $user->getZipCode()
                ],
                "country" => [
                    "type" => "select",
                    "options" => ["", "FR", "US", "EN", "MOR", "ALG", "TUN", "CAM", "SEN"],
                    "value" => $user->getCountry(),
                    "error" => "Pays incorrect"
                ],
                "thumbnail" => [
                    "type" => "text",
                    "error" => "Une erreur est survenue avec la valeur thumnbail",
                    "placeholder" => "Chemin de la photo de profil",
                    "value" => $user->getThumbnail()
                ]
            ]
        ];
    }
}
