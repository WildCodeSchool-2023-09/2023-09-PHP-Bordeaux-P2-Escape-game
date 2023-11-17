<?php

namespace App\Controller;

use App\Model\SceneManager;
use App\Model\UserManager;

class SceneController extends AbstractController
{
    public function sceneEnigme(?string $scene = 'scene1'): string
    {
        $sceneManager = new SceneManager();
        $userManager = new UserManager();
        // echo "coucou1";

        // Chargez d'abord la scène
        $sceneData = $sceneManager->getScene($scene);

        if (empty($sceneData)) {
            return $this->twig->render('error/500.html.twig');
        }

        $linkedSceneData = null;
        if (isset($sceneData['linkedScene'])) {
            $linkedSceneData = $sceneManager->getScene($sceneData['linkedScene']);
        }
        $userScore = null;
        if (isset($_SESSION['user_id'])) {
            $userScore = $userManager->getUserScore($_SESSION['user_id']);
        }

        // var_dump( $sceneData);
        return $this->twig->render('scene/scene.html.twig', [
            'scene' => $sceneData,
            'linkedScene' => $linkedSceneData,
            'userScore' => $userScore,
        ]);
    }

    public function planEnigme(string $scene, string $plan): string
    {
        $result = null;
        $sceneManager = new SceneManager();
      //  $userManager = new UserManager();
        // echo "coucou";

        // Chargez d'abord la scène
        $planData = $sceneManager->getPlan($scene, $plan);
        // var_dump( $planData);

        if (empty($planData)) {
            return $this->twig->render('error/500.html.twig');
        }

        if (isset($planData['enigma'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $goodIndex = $planData['enigma']['goodIndex'];
                $answer = $planData['enigma']['answers'][$goodIndex];
                $answer = str_replace(' ', '_', $answer);
                //TODO COMPTER LES POINTS
                if (isset($_POST[$answer])) {
                    $result = [
                        'success' => true,
                        'goodIndex' => $goodIndex
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'goodIndex' => $goodIndex
                    ];
                }
            }
        }
        return $this->twig->render('Plan/plan.html.twig', [
            'scene' => $scene,
            'plan' => $planData,
            'result' => $result,
        ]);
    }
}
