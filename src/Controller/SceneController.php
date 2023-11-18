<?php

namespace App\Controller;

use App\Model\SceneManager;
use App\Model\UserManager;
use App\Model\ProgressManager;

class SceneController extends AbstractController
{
    public function sceneEnigme(?string $scene = 'scene1', ?string $message = null): string
    {
        $sceneManager = new SceneManager();
        $userManager = new UserManager();
        $progressManager = new ProgressManager();
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

        if (isset($_SESSION['answer'])) {
            $userAnswer = $_SESSION['answer'];
            if ($userAnswer !== null) {
                $switchPicture = $sceneData['image'];
            }
        }

        if (isset($_SESSION['answer']) && isset($_SESSION['answer'][$scene]) && $_SESSION['answer'][$scene]) {
            $userScore = $userManager->getUserScore($_SESSION['user_id']);
            $userScore += 10;
            $userManager->updateUserScore($_SESSION['user_id'], $userScore);
            $progressManager->recordCorrectAnswer($_SESSION['user_id']);
            unset($_SESSION['answer'][$scene]);
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
        $sceneManager = new SceneManager();
        $userManager = new UserManager();
        $progressManager = new ProgressManager();
        $planData = $sceneManager->getPlan($scene, $plan);

        $result = $this->processEnigmaAnswer($scene, $plan, $planData, $userManager, $progressManager);

        if (empty($planData)) {
            return $this->twig->render('error/500.html.twig');
        }

        $userScore = null;
        if (isset($_SESSION['user_id'])) {
            $userScore = $userManager->getUserScore($_SESSION['user_id']);
        }

        $this->processCorrectAnswer($scene, $plan, $userScore, $userManager, $progressManager);

        return $this->twig->render('Plan/plan.html.twig', [
            'scene' => $scene,
            'plan' => $planData,
            'userScore' => $userScore,
            'result' => $result
        ]);
    }

    private function processEnigmaAnswer(
        string $scene,
        string $plan,
        array $planData,
        UserManager $userManager,
        ProgressManager $progressManager
    ): array {
        $result = [];

        if (isset($_SESSION['answer']["$scene-$plan"])) {
            $location = "/scene?scene=$scene&message=" . $planData['validated'];
            header("Location: $location");
            exit();
        }

        $progressManager = new ProgressManager();

        if (isset($planData['enigma']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $goodIndex = $planData['enigma']['goodIndex'];
            $answer = $planData['enigma']['answers'][$goodIndex];
            $answer = str_replace(' ', '_', $answer);

            $userScore = isset($_SESSION['user_id']) ? $userManager->getUserScore($_SESSION['user_id']) : null;

            if (isset($_POST[$answer])) {
                $_SESSION['answer']["$scene-$plan"] = true;
                $_SESSION['key'] = true;
                $result = ['success' => true, 'goodIndex' => $goodIndex];
            } else {
                $result = ['success' => false, 'goodIndex' => $goodIndex];
                $this->processIncorrectAnswer($userScore, $scene, $userManager, $progressManager);
            }
        }

        return $result;
    }

    private function processIncorrectAnswer(
        ?int $userScore,
        string $scene,
        UserManager $userManager,
        ProgressManager $progressManager
    ): void {

        if ($userScore !== null) {
            $userScore -= 5;
            $userManager->updateUserScore($_SESSION['user_id'], $userScore);
            $progressManager->recordIncorrectAnswer($_SESSION['user_id'], $scene);
        }
    }

    private function processCorrectAnswer(
        string $scene,
        string $plan,
        ?int &$userScore,
        UserManager $userManager,
        ProgressManager $progressManager
    ): void {

        if (isset($_SESSION['answer']["$scene-$plan"]) && $_SESSION['answer']["$scene-$plan"]) {
            $userScore = $userManager->getUserScore($_SESSION['user_id']);
            $userScore += 5;
            $userManager->updateUserScore($_SESSION['user_id'], $userScore);
            $progressManager->recordCorrectAnswer($_SESSION['user_id']);
            unset($_SESSION['answer']["$scene-$plan"]);
        }
    }
}
