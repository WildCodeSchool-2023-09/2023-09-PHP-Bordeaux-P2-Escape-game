<?php

namespace App\Controller;

use App\Model\ScenarioManager;

class ScenarioController extends AbstractController
{
    /**
     * Display home page
     */
    public function scenario(?int $id=null): string
    {
        return $this->twig->render('scenario.html.twig');
    }
}
