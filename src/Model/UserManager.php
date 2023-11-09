<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';
    public function selectOneByEmail(string $email): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
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
}
