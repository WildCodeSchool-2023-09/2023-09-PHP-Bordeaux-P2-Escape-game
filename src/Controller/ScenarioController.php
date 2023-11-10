<?php

namespace App\Controller;

use App\Model\ItemManager;

class ScenarioController extends AbstractController
{
    /**
     * Display home page
     */
    public function scenario(?int $id = null)
    {
        return $this->twig->render('scenario/index.html.twig');
    }
}
