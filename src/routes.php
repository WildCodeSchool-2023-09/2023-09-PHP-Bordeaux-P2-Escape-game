<?php

session_start();

return [
    '' => ['HomeController', 'index',],
    'login' => ['UserController', 'login',],
    'logout' => ['UserController', 'logout',],
    'inscription' => ['InscriptionController', 'validateInscription',],
    'scenario' => ['ScenarioController', 'scenario',],
    'scene' => ['SceneController', 'sceneEnigme', ['scene', 'message']], // Pour gérer les scènes et les plans
    'plan' => ['SceneController', 'planEnigme', ['scene', 'plan']],
    'scores' => ['ScoreController', 'showScores'],
    'tutorial' => ['HomeController', 'tutorial',],
    'win' => ['HomeController', 'win',],
    'loose' => ['HomeController', 'loose',],
];
