<?php
namespace App;

session_start();
require "vendor/autoload.php";
var_dump($_SESSION);
// var_dump($_POST);
// var_dump($_GET);

$configFilePath = './config.json';
if (file_exists($configFilePath)) {

spl_autoload_register(function ($class) {
    $class = str_replace("App\\", "", $class);
    $class = str_replace("\\", "/", $class) . ".php";

    $filePath = __DIR__ . "/" . $class; 

    if (file_exists($filePath)) {
        include $filePath;
    }
});


//Récupérer dans l'url l'uri /login ou /user/toto
//Nettoyer la donnée
//S'il y a des paramètres dans l'url il faut les enlever :
$uriExploded = explode("?",$_SERVER["REQUEST_URI"]);
$uri = rtrim(strtolower(trim($uriExploded[0])),"/");
//Dans le cas où nous sommes à la racine $uri sera vide du coup je remets / en tout cas
$uri = (empty($uri))?"/":$uri;


$routes = include 'routes.php';

//test si conf existe, cas contraire redigirer vers /config

//Page 404
if(empty($routes[$uri])) {
    die("Page 404");
}

if(empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])) {
    die("Absence de controller ou d'action dans le ficher de routing pour la route ".$uri);
}

$controller = $routes[$uri]["controller"];
$action = $routes[$uri]["action"];

//Vérification de l'existance de la classe
if(!file_exists("Controllers/".$controller."Controller.php")){
    die("Le fichier Controllers/".$controller."Controller.php n'existe pas");
}

include "Controllers/".$controller."Controller.php";

//Le fichier existe mais est-ce qu'il possède la bonne classe
//bien penser à ajouter le namespace \App\Controllers\Security
$controller = "\\App\\Controllers\\".$controller."Controller";
if(!class_exists($controller)){
    die("La classe ".$controller." n'existe pas");
}

$objet = new $controller();

//Est-ce que l'objet contient bien la méthode
if(!method_exists($objet, $action)){
    die("L'action ".$action." n'existe pas");
}

$objet->$action();
}
else {
    include "./Views/config.php";
}
?>
