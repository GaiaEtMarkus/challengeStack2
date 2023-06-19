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
}