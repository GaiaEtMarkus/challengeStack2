<?php
namespace App\Core;

use App\Core\Sql;

class Security extends Sql
{
    public static function generateCompleteToken($length = 32)
    {
        $token = bin2hex(random_bytes($length));
        return $token;
    }
    
    public static function staticgenerateTruncatedToken($token)
    {
    // Générer le jeton tronqué en utilisant une fonction de hachage cryptographique (par exemple, sha256)
    $truncatedToken = substr(hash('sha256', $token), 0, 16); // Tronquer le jeton à 16 caractères
    
    return $truncatedToken;
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    public static function form(array $config, array $data): array 
    {
        $listOfErrors = [];
        if(count($config["inputs"]) != count($data)-1){
            die("Tentative de Hack");
    }

        foreach ($config["inputs"] as $name=>$input)
        {
            if(empty($data[$name])){
                die("Tentative de Hack");
            }

            if($input["type"]=="email" && !self::checkEmail($data[$name])){
                $listOfErrors[]=$input["error"];
            }

        }

        return $listOfErrors;
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function securiser($donnees)
    
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
}