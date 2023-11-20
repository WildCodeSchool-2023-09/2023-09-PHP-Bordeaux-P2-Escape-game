<?php

namespace App\Controller;

use App\Model\ScenarioManager;

class ScoreController extends AbstractController
{
    public function showScores()
    {
        $scenarioManager = new ScenarioManager();
        $scores = $scenarioManager->getScores();

        return $this->twig->render('scores.html.twig', [
            'userScore' => $scores['userScores'][0]['score'],
            'globalScores' => $scores['globalScores']
        ]);
    }
}

// 'switchPicture' => $switchPicture,
//             'message' => $message
//             'userScore' => $userScore,
