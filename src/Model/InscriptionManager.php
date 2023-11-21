<?php

namespace App\Model;

use PDO;

class InscriptionManager extends AbstractManager
{
    public const TABLE = 'user';

    public function insert(array $contact): bool
    {
        $query = " INSERT INTO "  . self::TABLE . '(pseudo, password, email) 
        VALUES (:pseudo, :password, :email)';
        $statement = $this->pdo->prepare($query);

        $statement->bindValue('pseudo', $contact['pseudo'], PDO::PARAM_STR);
        // $statement->bindValue('password', $contact['password'], PDO::PARAM_STR);
        $statement->bindValue('password', password_hash($contact['password'], PASSWORD_DEFAULT));
        $statement->bindValue('email', $contact['email'], PDO::PARAM_STR);

        $success = $statement->execute();

        // Ajoute une entrée dans la table 'progress' associée à cet utilisateur
        if ($success) {
            $userId = $this->pdo->lastInsertId(); // Récupère l'ID de l'utilisateur nouvellement inséré
            $this->createProgressEntry($userId);
        }

        return $success;
    }

    // Méthode pour créer une entrée dans la table 'progress' pour un utilisateur donné
    private function createProgressEntry($userId): void
    {
        $query = "INSERT INTO progress (user_id, success, score) VALUES (:user_id, 0, 0)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
}
