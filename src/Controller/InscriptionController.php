<?php

namespace App\Controller;

use App\Model\InscriptionManager;
use PDO;

class InscriptionController extends AbstractController
{
    public function validateInscription(): string
    {
        $errors = [];
        $errors2 = [];
        $isSuccess = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $request = array_map('trim', $_POST);
            $email = $request['email'];
            $pseudo = $request['pseudo'];
            // $password = password_hash($request['password'], PASSWORD_BCRYPT);

            if (empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = '⚠ L\'adresse email n\'est pas valide !';
            }
            if (empty($request['pseudo'])) {
                $errors['pseudo'] = '⚠ Le pseudo est obligatoire !';
            }
            if (empty($request['password'])) {
                $errors['password'] = '⚠ Le mot de passe est obligatoire !';
            }

            if (!$this->verifyUnicity($email, $pseudo)) {
                if (empty($errors)) {
                    $contactManager = new InscriptionManager();
                    $isSuccess = $contactManager->insert($request);
                    return $this->twig->render('Home/index.html.twig');
                }
            } else {
                $errors2[] = "⚠ L'email ou le pseudo existe déjà. Veuillez choisir d'autres informations !";
            }
        }

        return $this->twig->render('Home/inscription.html.twig', [
            'errors' => $errors,
            'errors2' => $errors2,
            'success' => $isSuccess
        ]);
    }

    public function verifyUnicity(string $email, string $pseudo): bool
    {
        $pdo = new PDO('mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB_NAME, APP_DB_USER, APP_DB_PASSWORD);

        $query = $pdo->prepare("SELECT * FROM user WHERE email = :email OR pseudo = :pseudo");
        $query->execute(['email' => $email, 'pseudo' => $pseudo]);

        return $query->fetch() !== false;
    }
}
