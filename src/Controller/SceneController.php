<?php

namespace App\Controller;
use App\Model\ItemManager;

class SceneController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Home/index.html.twig');
    }
}
