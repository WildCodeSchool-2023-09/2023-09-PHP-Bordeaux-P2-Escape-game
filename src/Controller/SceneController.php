<?php

namespace App\Controller;

use App\Model\SceneManager;

class SceneController extends AbstractController
{
    /**
     * Display home page
     */
    public function sceneEnigme(?int $id = null): string
    {
        $sceneManager = new SceneManager();
        $scene = $sceneManager->selectOneById($id);

        return $this->twig->render('Scene/scene.html.twig', ['scene' => $scene]);
    }

    public function planEnigme(?int $id = null): string
    {
        $planManager = new SceneManager();
        $plan = $planManager->selectOneById($id);

        return $this->twig->render('Plan/plan.html.twig', ['plan' => $plan]);
    }

    //     public function show(int $id)
    //     {
    //         $statement = $this->connection->prepare("SELECT hint FROM enigma");
    //         $statement->execute();
    //     }
}
