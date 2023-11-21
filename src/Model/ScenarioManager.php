<?php

namespace App\Model;

use PDO;

class ScenarioManager extends AbstractManager
{
    public const TABLE = 'scenario';

    /**
     * Insert a new item into the database.
     */
    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue(':title', $item['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update an item in the database.
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id = :id");
        $statement->bindValue(':id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue(':title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Get user and global scores.
     */
    public function getScores(): array
    {
        $userScores = $this->getUserScores();
        $globalScores = $this->getGlobalScores();
        return ['userScores' => $userScores, 'globalScores' => $globalScores];
    }

    /**
     * Get scores for a specific user.
     */
    private function getUserScores(): array
    {
        $userScoresStatement = $this->pdo->prepare(
            "SELECT user.pseudo, progress.score
            FROM user
            JOIN progress ON user.id = progress.user_id
            WHERE user.id = :userId"
        );
        $userScoresStatement->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
        $userScoresStatement->execute();
        return $userScoresStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get global scores for all users.
     */
    private function getGlobalScores(): array
    {
        $globalStmt  = $this->pdo->query(
            "SELECT user.pseudo, progress.score
            FROM user
            JOIN progress ON user.id = progress.user_id"
        );

        return $globalStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
