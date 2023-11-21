<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $errors = [];

            if (empty($credentials['email'])) {
                $errors[] = 'L\'e-mail est requis';
            }

            if (empty($credentials['password'])) {
                $errors[] = 'Le mot de passe est requis';
            }

            if (empty($errors)) {
                $userManager = new UserManager();
                $user = $userManager->selectOneByEmail($credentials['email']);

                if ($user && password_verify($credentials['password'], $user['password'])) {
                    // Connecter l'utilisateur
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /');
                    exit();
                } else {
                    $errors[] = 'E-mail ou mot de passe incorrect';
                }
            }
        } else {
            $errors = [];
        }

        return $this->twig->render('Home/login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['answer']);
        return $this->twig->render('Home/login.html.twig');
      
            unset($_SESSION['user_id']);
            unset($_SESSION['answer']);
            unset($_SESSION['key']);
            header('Location: /');

        // header('Location: /');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = $_POST;
            $userManager = new UserManager();
            if ($userManager->insert($credentials)) {
                return $this->login();
            }
        }
        return $this->twig->render('User/register.html.twig');
    }
}
