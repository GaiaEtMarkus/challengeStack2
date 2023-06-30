<?php
namespace App\Core;

abstract class ModeratorSql extends Sql{

    public function getUnverifiedUsers()
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "User" WHERE is_verified = false');
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function verify($userId)
    {
        $queryPrepared = $this->pdo->prepare('UPDATE "User" SET is_verified = true WHERE id = :userId');
        $queryPrepared->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $queryPrepared->execute();
    }

    public function getUnverifiedProducts()
    {
        $queryPrepared = $this->pdo->prepare('SELECT * FROM "Product" WHERE is_verified = false');
        $queryPrepared->execute();
        $result = $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function verifyProduct($productId)
    {
        $queryPrepared = $this->pdo->prepare('UPDATE "Product" SET is_verified = true WHERE id = :productId');
        $queryPrepared->execute([':productId' => $productId]);
    }

    public function getUserById(int $userId): array
    {
        $query = 'SELECT * FROM "User" WHERE id = :userId';
        $params = [':userId' => $userId];
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        var_dump($queryPrepared);
    
        return $queryPrepared->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function validUser(int $userId)
    {
    $query = 'UPDATE "User" SET is_verified = TRUE WHERE id = :userId';
    $params = [':userId' => $userId];
    $queryPrepared = $this->pdo->prepare($query);
    $queryPrepared->execute($params);
    }

public function validProduct(int $productId, int $trokos)
{
    $query = 'UPDATE "Product" SET is_verified = TRUE, trokos = :trokos WHERE id = :productId';
    $params = [
        ':productId' => $productId,
        ':trokos' => $trokos
    ];
    $queryPrepared = $this->pdo->prepare($query);
    $queryPrepared->execute($params);
}


}