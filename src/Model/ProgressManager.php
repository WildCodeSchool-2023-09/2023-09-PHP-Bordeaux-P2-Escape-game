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

    public function recordCorrectAnswer(int $userId, string $scene)
    {
        $pdo = $this->pdo;

        // Vérifier si l'utilisateur est déjà dans la BDD
        $existingEntryQuery = "SELECT id FROM " . static::TABLE . " WHERE user_id = :userId";
        $existingEntryStatement = $pdo->prepare($existingEntryQuery);
        $existingEntryStatement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $existingEntryStatement->execute();

        // Si il il y a un user, augmente les points.
        if ($existingEntryStatement->rowCount() > 0) {
            $updateQuery = "UPDATE " . static::TABLE . " SET success = 1, score = score + 10 WHERE user_id = :userId";
            $updateStatement = $pdo->prepare($updateQuery);
            $updateStatement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $updateStatement->execute();
        } 
    }
    
    public function recordIncorrectAnswer(int $userId, string $scene): void
    {
        $query = "UPDATE progress SET score = score - 5 WHERE user_id = :userId AND scene = :scene";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':scene', $scene, PDO::PARAM_STR);
        $statement->execute();
    }
    
}