<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function getUserScore(int $userId): ?int
    {
        $statement = $this->pdo->prepare("SELECT score FROM progress WHERE user_id = :userId");
        $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function selectOneByEmail(string $email): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function insert(array $credentials): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE .
            " (`pseudo`, `password`, `email`)
            VALUES (:pseudo, :password, :email)");
        $statement->bindValue(':email', $credentials['email']);
        $statement->bindValue(':password', password_hash($credentials['password'], PASSWORD_DEFAULT));
        $statement->bindValue(':pseudo', $credentials['pseudo']);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function updateUserScore($userId, $newScore)
    {
        $pdo = $this->pdo;
        $query = "UPDATE progress SET score = :newScore WHERE user_id = :userId";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':newScore', $newScore, \PDO::PARAM_INT);
        $statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
