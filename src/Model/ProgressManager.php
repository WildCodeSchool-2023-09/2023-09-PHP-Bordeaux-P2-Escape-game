<?php

namespace App\Model;

use PDO;

class ProgressManager extends AbstractManager
{
    public const TABLE = 'progress';

    /**
     * Met à jour le score du joueur.
     */
    public function updateScore(int $userId, int $score): void
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET score = :score WHERE user_id = :userId");
        $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
        $statement->bindValue(':score', $score, PDO::PARAM_INT);
        $statement->execute();
    }

    public function recordCorrectAnswer(int $userId): void
    {
        $pdo = $this->pdo;

        // Vérifier si l'utilisateur est déjà dans la BDD
        $query = "SELECT id FROM " . static::TABLE . " WHERE user_id = :userId";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();

        // Si il il y a un user, augmente les points.
        if ($statement->rowCount() > 0) {
            $query = "UPDATE " . static::TABLE . " SET success = 1, score = score + 0 WHERE user_id = :userId";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function recordIncorrectAnswer(int $userId): void
    {
        $query = "UPDATE progress SET score = score - 5 WHERE user_id = :userId";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
}
