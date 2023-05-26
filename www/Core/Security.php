<?php
namespace App\Core;

class Security 
{
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function login($username, $password)
    {
        // Vérification des informations de connexion
        // ...
    }
}