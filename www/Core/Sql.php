<?php
namespace App\Core;

abstract class Sql{

    private $pdo;
    private $table;

    public function __construct(){
        //Mettre en place un SINGLETON
        try{
            $this->pdo = new \PDO("pgsql:host=database;port=5432;dbname=tournamount" , "tournamount_admin" , "Admin1234" );
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = "esgi_".$this->table;
    }
    
}