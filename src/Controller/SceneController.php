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

class SceneController extends AbstractController
{
    // public function index(int $id)
    // {
    //     if(!isset($id))
    //     {
    //         //TODO
    //     }

    // $sceneManager = new SceneManager();
    // $scene = $sceneManager->selectOneById($id);

    //     return $this->twig->render('scene/scene.html.twig', [
    //     'scene' => $scene
    //     ]);
    // }
}
