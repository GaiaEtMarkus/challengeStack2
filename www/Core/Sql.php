<?php
namespace App\Core;
use App\Models\User;

abstract class Sql{

    protected  $pdo;
    private $table;

    public function __construct(){
        try{ 
            $this->pdo = new \PDO("pgsql:host=database;port=5432;dbname=trokos" , "trokos_admin" , "Admin1234" );
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
        foreach($columns as $key=>$value)
        {
            if(is_bool($value))
            {
                $columns[$key] = $value ? "true" : "false";
            }
        }
        if(is_numeric($this->getId()) && $this->getId()>0)
        {
            $columnsUpdate = [];
            foreach ($columns as $key=>$value)
            {
                $columnsUpdate[]= $key."=:".$key;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE \"".$this->table."\" SET ".implode(",",$columnsUpdate)." WHERE id=".$this->getId());
    
        }else{
            $queryPrepared = $this->pdo->prepare("INSERT INTO \"".$this->table."\" (".implode(",", array_keys($columns)).") 
                            VALUES (:".implode(",:", array_keys($columns)).")");
        }
        $queryPrepared->execute($columns);
        // dd($queryPrepared);
        // var_dump($queryPrepared->execute($columns));
    }

    public function login($email, $password)
    {
        $query = $this->pdo->prepare('SELECT * FROM "User" WHERE email = :email');
        $query->execute([':email' => $email]);
        $userData = $query->fetch(\PDO::FETCH_ASSOC);

        if($userData === false) {
            return false;
        }

        if (password_verify($password, $userData['pwd'])) {
                  
            $_SESSION['userData'] = $userData;
            var_dump($_SESSION['userData']);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id): void
    {
        $queryPrepared = $this->pdo->prepare('DELETE FROM "' . $this->table . '" WHERE id = :id');
        $queryPrepared->execute([':id' => $id]);
    }
    
    public function getAllFromTable($tableName)
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM \"$tableName\"");
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
            
        return $result;
    }

    public function getProductsByUserId(int $userId): array
    {
        $query = 'SELECT * FROM "Product" WHERE id_seller = :userId';
        $params = [':userId' => $userId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    
        return $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    
    public function getUserById(int $userId): array
    {
        $query = 'SELECT * FROM "User" WHERE id = :userId';
        $params = [':userId' => $userId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    
        return $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductById(int $productId): ?array
    {
        $query = 'SELECT * FROM "Product" WHERE id = :productId';
        $params = [':productId' => $productId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function getCategoryNameById($categoryId)
    {
        $queryPrepared = $this->pdo->prepare("SELECT name FROM \"Category\" WHERE id = :categoryId");
        $queryPrepared->bindValue(':categoryId', $categoryId, \PDO::PARAM_INT);
        $queryPrepared->execute();
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result['name'];
        } else {
            return null;
        }
    }

    public function getVerifiedProducts()
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "Product" WHERE is_verified = true');
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    protected function arrayToString(array $array)
    {
    return '{' . implode(',', $array) . '}';
    }

    public function getTransactionById(int $transactionId): ?array
    {
        $query = 'SELECT * FROM "Transaction" WHERE id = :transactionId';
        $params = [':transactionId' => $transactionId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function validateTransaction($transactionId)
    {
        $query = 'UPDATE "Transaction" SET is_validate = true WHERE id = :transactionId';
        $params = [':transactionId' => $transactionId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    }

    public function getUserByMail(string $mailUser): ?array
    {
        $query = 'SELECT * FROM "User" WHERE email = :mailUser';
        $params = [':mailUser' => $mailUser];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function getUserByToken(string $token): ?array
    {
        $query = 'SELECT * FROM "ResetToken" WHERE token = :token';
        $params = [':token' => $token];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function setResetToken($userId, $token, $expiration)
    {
        $query = 'INSERT INTO "ResetToken" (user_id, token, expiration) VALUES (:userId, :token, :expiration)';
        $params = [
            ':userId' => $userId,
            ':token' => $token,
            ':expiration' => date('Y-m-d H:i:s', $expiration)
        ];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);   
    }
    
    public function getAllComments($targetUserId = null, $targetProductId = null)
    {
    $query = 'SELECT * FROM "Comment" WHERE target_user = :target_user OR target_product = :target_product';
    $params = [
        'target_user' => $targetUserId,
        'target_product' => $targetProductId,
    ];

    $queryPrepared = $this->pdo->prepare($query);
    $queryPrepared->execute($params); 
    $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

    if ($result === false) {
        return null;
    }
    return $result;    
    }

    public function getCommentsByUserId(int $userId): array
    {
        $query = 'SELECT * FROM "Comment" WHERE target_user = :userId';
        $params = [':userId' => $userId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    
        return $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCommentsByProductId(int $productId): array
    {
        $query = 'SELECT * FROM "Comment" WHERE target_product = :productId';
        $params = [':productId' => $productId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    
        return $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductCountByUserId(int $userId): int
    {
        $query = 'SELECT COUNT(*) as count FROM "Product" WHERE id_seller = :userId';
        $params = [':userId' => $userId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);
        return (int)$result['count'];
    }

    public function getTransactionCountByUserId(int $userId): int
    {
        $query = 'SELECT COUNT(*) as count FROM "Transaction" WHERE id_receiver = :userId OR id_seller = :userId';
        $params = [':userId' => $userId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);
        return (int)$result['count'];
    }
}