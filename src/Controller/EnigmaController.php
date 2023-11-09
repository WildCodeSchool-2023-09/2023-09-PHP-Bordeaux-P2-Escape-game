<?php

namespace App\Controller;

class EnigmaController extends AbstractController
{
    public function enigma(): string
    {
        return $this->twig->render('Home/enigma.html.twig');
    }
}
