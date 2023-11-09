<?php

namespace App\Controller;

class SceneController extends AbstractController
{
    // public function index(int $id)
    public function index()
    {
        if (!isset($id))
        {
            //TODO 
        }

    //    $sceneManager = new SceneManager();
    //    $scene = $sceneManager->selectOneById($id);

        return $this->twig->render('scene/scene.html.twig', [
         //   'scene' => $scene
        ]);
    }

}