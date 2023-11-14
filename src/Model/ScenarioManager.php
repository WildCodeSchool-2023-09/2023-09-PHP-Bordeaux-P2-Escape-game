<?php

namespace App\Model;

use PDO;

class ScenarioManager extends AbstractManager
{
    public const TABLE = 'scenario';

    /**
     * Insert new item in database
     */
    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }

    public function getScores(): array
    {
        $statement = $this->pdo->query(
            "SELECT user.pseudo, progress.score
            FROM user
            JOIN progress ON user.id = progress.user_id"
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

