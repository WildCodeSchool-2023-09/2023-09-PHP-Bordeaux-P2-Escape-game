<?php

namespace App\Controller;

use App\Model\ScenarioManager;

class ScenarioController extends AbstractController
{
    /**
     * Display home page
     */
    public function scenario(): string
    {
        return $this->twig->render('scenario.html.twig');
    }
}
