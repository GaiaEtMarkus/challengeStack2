<?php
namespace App\Core;

abstract class Sql{

    private  $pdo;
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
        $this->table = $this->table;
    }

    

    public static function getInstance() {
        if (self::$pdo == null) {
            self::$pdo = new Sql();
        }
        return self::$pdo;
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted =get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);

        if(is_numeric($this->getId()) && $this->getId()>0)
        {
            $columnsUpdate = [];
            foreach ($columns as $key=>$value)
            {
                $columnsUpdate[]= $key."=:".$key;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE ".$this->table." SET ".implode(",",$columnsUpdate)." WHERE id=".$this->getId());

        }else{
            $queryPrepared = $this->pdo->prepare("INSERT INTO \"".$this->table."\" (".implode(",", array_keys($columns)).") 
                            VALUES (:".implode(",:", array_keys($columns)).")");
            var_dump($queryPrepared);
        }

        // var_dump($queryPrepared->queryString); // Ajouter cette ligne pour afficher la requête préparée
        // var_dump($columns); // Affiche les données à lier
        $queryPrepared->execute($columns);
    }

    // public function __destruct() {
    //     Sql::$pdo = null;
    // }

    public function login($email, $password)
    {
        $query = $this->pdo->prepare('SELECT * FROM User WHERE email = :email');
        $query->execute([':email' => $email]);
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        var_dump($user);

        if($user === false) {
            // Pas d'utilisateur avec cet email trouvé
            return false;
        }

        // Utilisez password_verify pour comparer le mot de passe fourni avec le mot de passe hashé de l'utilisateur
        if (password_verify($password, $user['pwd'])) {
            // Les mots de passe correspondent
            $_SESSION['user'] = $user;
            return true;
        } else {
            // Les mots de passe ne correspondent pas
            return false;
        }
    }

}