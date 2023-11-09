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

       return $statement->execute();
    }

}
