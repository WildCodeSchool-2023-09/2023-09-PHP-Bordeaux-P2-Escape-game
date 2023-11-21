<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function win(): string
    {
        return $this->twig->render('Home/win.html.twig');
    }

    public function lose(): string
    {
        return $this->twig->render('Home/lose.html.twig');
    }

    public function tutorial(): string
    {
        return $this->twig->render('Home/tutorial.html.twig');
    }
}
