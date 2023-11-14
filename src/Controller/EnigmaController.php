<?php

namespace App\Controller;

class EnigmaController extends AbstractController
{
    public function enigma(): string
    {
        $compteur = 0;
        $result = null;

        if (isset($_POST["shining"])) {
            $compteur = $compteur + 1;
            //echo 'Bravo';
            $result = true;
        } elseif (isset($_POST["espace"]) || isset($_POST["pulp"])) {
            $compteur = $compteur -1;
            //echo 'Raté !';
            $result = false;
        }

        return $this->twig->render('Home/enigma.html.twig', [
            'result' => $result
        ]);
    }
}
