<?php

namespace App\Controller;

use App\Model\SceneManager;

class SceneController extends AbstractController
{
    public function sceneEnigme(?string $scene = 'scene1', ?string $plan = null): string
    {
        $sceneManager = new SceneManager();
        // echo "coucou1";

        // Chargez d'abord la scène
        $sceneData = $sceneManager->getScene($scene);

        // Si un plan est spécifié, chargez les détails du plan
        if (!empty($plan) && isset($sceneData['linkedPlans'][$plan])) {
            $sceneData = $sceneData['linkedPlans'][$plan];
        }

        if (empty($sceneData)) {
            return $this->twig->render('error/500.html.twig');
        }

        $linkedSceneData = null;
        if (isset($sceneData['linkedScene'])) {
            $linkedSceneData = $sceneManager->getScene($sceneData['linkedScene']);
        }


        // var_dump( $sceneData);
        return $this->twig->render('scene/scene.html.twig', [
            'scene' => $sceneData,
            'linkedScene' => $linkedSceneData,
            // 'sceneId' => $scene,
            // 'plan' => $plan,
        ]);
    }

    public function planEnigme(string $scene, string $plan): string
    {
        $sceneManager = new SceneManager();
        // echo "coucou";

        // Chargez d'abord la scène
        $planData = $sceneManager->getPlan($scene, $plan);
        // var_dump( $planData);

        if (empty($planData)) {
            return $this->twig->render('error/500.html.twig');
        }

        return $this->twig->render('Plan/plan.html.twig', [
            'scene' => $scene,
            'plan' => $planData,
        ]);
    }
}
