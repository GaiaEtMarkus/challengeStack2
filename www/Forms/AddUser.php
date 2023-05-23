<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

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
                        "max"=>60,
                        "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
                    ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "min"=>2,
                    "max"=>120,
                    "error"=>"Votre nom doit faire entre 2 et 120 caractères"
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
                "country"=>[
                    "type"=>"select",
                    "options"=>["","FR", "US", "EN", "MOR", "ALG", "TUN", "CAM", "SEN"],
                    "error"=>"Pays incorrect"
                ]
            ]
        ];
    }

}