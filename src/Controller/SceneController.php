<?php

namespace App\Controller;

use App\Model\SceneManager;

class SceneController extends AbstractController
{
    /**
     * Display page
     */
    public function sceneEnigme(?string $scene = 'scene1', ?string $plan = null): string
    {
        $sceneManager = new SceneManager();
        $scene = $sceneManager->getScene($scene, $plan);

        //TODO AVOIR LE PLAN ,il est où ? SQL ? Tableau?
        return $this->twig->render('scene/scene.html.twig', [
            'scene' => $scene,
        ]);
    }

    // public function sceneEnigme(): string
    // {
    // //     $sceneManager = new SceneManager();
    // //     $scene = $sceneManager->selectOneById($id);

    //     return $this->twig->render('scene/scene.html.twig', ['sceneEnigme' => $scene]);
    // }

    // public function planEnigme(?int $id = null): string
    // {
    //     $planManager = new SceneManager();
    //     $plan = $planManager->selectOneById($id);

    //     return $this->twig->render('Plan/plan.html.twig', ['plan' => $plan]);
    // }
}
