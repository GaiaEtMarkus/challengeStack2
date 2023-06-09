<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Core\View;


class AddUser extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "submit"=>"S'inscrire",
                "cancel"=>"Annuler"
            ],
            "inputs" =>[
                "firstname"=>[
                        "type"=>"text",
                        "placeholder"=>"Votre prénom",
                        "min"=>2,
                        "max"=>256,
                        "error"=>"Votre prénom doit faire entre 2 et 25§ caractères"
                    ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "min"=>2,
                    "max"=>256,
                    "error"=>"Votre nom doit faire entre 2 et 256 caractères"
                ],
                "pseudo"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre pseudo",
                    "min"=>2,
                    "max"=>16,
                    "error"=>"Votre nom doit faire entre 2 et 16 caractères"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "error"=>"Le format de votre email est incorrect"
                ],
                "phone"=>[
                    "type"=>"number",
                    "placeholder"=>"Votre numéro de téléphone",
                    "error"=>"Le format de votre téléphone est incorrect"
                ],
                "birth_date"=>[
                    "type"=>"date",
                    "placeholder"=>"Votre date de naissance",
                    "error"=>"Le format de votre date de naissance est incorrect"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "error"=>"Votre mot de passe est incorrect"
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "confirm"=>"pwd",
                    "error"=>"Les mot de passes ne sont pas identiques"
                ],
                "address"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre addresse",
                    "min"=>2,
                    "max"=>256,
                ],
                "zip_code"=>[
                    "type"=>"number",
                    "placeholder"=>"Votre code postale",
                    "min"=>2,
                    "max"=>5,
                ],
                "country" => [
                    "type" => "select",
                    "options" => View::buildCountryOptions(),
                    "error" => "Pays incorrect"
                ],
                "thumbnail" => [
                    "type" => "text",
                    "error" => "Une erreur est survenue avec la valeur thumnbail",
                    "placeholder"=>"chemin de la photo de profil"
                ]
            ]
        ];
    }
}