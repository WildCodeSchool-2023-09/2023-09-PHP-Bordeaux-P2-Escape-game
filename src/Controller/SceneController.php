<?php

namespace App\Controller;

use App\Model\SceneManager;
use App\Model\UserManager;

class SceneController extends AbstractController
{
    public function sceneEnigme(?string $scene = 'scene1', ?string $message = null): string
    {
        $sceneManager = new SceneManager();
        $userManager = new UserManager();
        $sceneData = $sceneManager->getScene($scene);
        $switchPicture = null;

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

        // Réinitialisez la réponse après avoir changé de scène
        // unset($_SESSION['answer']);

        if (isset($_SESSION['answer'])) {
            $userAnswer = $_SESSION['answer'];
            // var_dump($_SESSION);
            if ($userAnswer !== null) {
                $switchPicture = $sceneData['image'];
            }
        }

        return $this->twig->render('scene/scene.html.twig', [
            'scene' => $sceneData,
            'linkedScene' => $linkedSceneData,
            'switchPicture' => $switchPicture,
            'message' => $message,
            'userScore' => $userScore,
        ]);
    }

    public function planEnigme(string $scene, string $plan): string
    {
        $result = null;
        $sceneManager = new SceneManager();
        $userManager = new UserManager();


        $planData = $sceneManager->getPlan($scene, $plan);
        // var_dump( $planData);

        $result = null;

        if (isset($_SESSION['answer']["$scene-$plan"])) {
            header("Location: /scene?scene=$scene&message=" . $planData['validated']);
            exit();
        }

        // enigme
        if (isset($planData['enigma'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $goodIndex = $planData['enigma']['goodIndex'];
                $answer = $planData['enigma']['answers'][$goodIndex];
                $answer = str_replace(' ', '_', $answer);
                //TODO COMPTER LES POINTS
                if (isset($_POST[$answer])) {
                    $_SESSION['answer']["$scene-$plan"] = true;
                    $_SESSION['key'] = true;
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
            'userScore' => $userScore,
            'result' => $result

        ]);
    }
}
