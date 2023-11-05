<?php

namespace App\Controller;

use App\Controller\AbstractController;
use PDO;

class UserInscription extends AbstractController
{
    public function validateInscription()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];
            $pseudo = $_POST["pseudo"];
            $motDePasse = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $errors = [];
            $errors = $this->verifyInputs($errors, $email);
            if (empty($errors)) {
                $this->registerInscription($email, $pseudo, $errors, $motDePasse);
            } else {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
            }
        }
    }

    private function verifyInputs($errors, $email)
    {
        if (!isset($_POST['email']) || trim($_POST['email']) === '') {
            $errors[] = "L'email' est obligatoire.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        }
        if (!isset($_POST['pseudo']) || trim($_POST['pseudo']) === '') {
            $errors[] = "Le pseudo est obligatoire.";
        }
        if (!isset($_POST['password']) || trim($_POST['password']) === '') {
            $errors[] = "Le mot de passe est obligatoire.";
        }

        return $errors;
    }

    private function registerInscription($email, $pseudo, $errors, $motDePasse)
    {
        $pdo = new PDO('mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB_NAME, APP_DB_USER, APP_DB_PASSWORD);
        $query = $pdo->prepare("SELECT * FROM user WHERE email = :email OR pseudo = :pseudo");
        $query->execute(['email' => $email, 'pseudo' => $pseudo]);
        if ($query->fetch()) {
            $errors[] = "L'email ou le pseudo existe déjà. Veuillez choisir d'autres informations.";
        }
        // Insertion des données dans la base de données
        $query = $pdo->prepare("INSERT INTO user (email, pseudo, password) 
        VALUES (:email, :pseudo, :password)");
        $success = $query->execute(['email' => $email, 'pseudo' => $pseudo, 'password' => $motDePasse]);
        if ($success) {
            echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header('Location: ../View/Home/index.html.twig');
        } else {
            echo "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}
