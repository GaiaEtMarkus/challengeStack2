<?php
namespace App;

session_start();
require "vendor/autoload.php";
// var_dump($_SESSION);
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

$uriExploded = explode("?",$_SERVER["REQUEST_URI"]);
$uri = rtrim(strtolower(trim($uriExploded[0])),"/");
$uri = (empty($uri))?"/":$uri;


$routes = include 'routes.php';

if (empty($routes[$uri])) {
    header("HTTP/1.0 404 Not Found");
    include "./Views/404.php"; 
    exit();
}


if(empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])) {
    die("Absence de controller ou d'action dans le ficher de routing pour la route ".$uri);
}

$controller = $routes[$uri]["controller"];
$action = $routes[$uri]["action"];

if(!file_exists("Controllers/".$controller."Controller.php")){
    die("Le fichier Controllers/".$controller."Controller.php n'existe pas");
}

include "Controllers/".$controller."Controller.php";

$controller = "\\App\\Controllers\\".$controller."Controller";
if(!class_exists($controller)){
    die("La classe ".$controller." n'existe pas");
}

$objet = new $controller();

if(!method_exists($objet, $action)){
    die("L'action ".$action." n'existe pas");
}

$objet->$action();
}
else {
    include "./Views/config.php";
}
?>
