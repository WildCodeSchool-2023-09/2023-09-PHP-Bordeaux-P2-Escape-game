<?php

namespace App\Model;

use PDO;

class SceneManager extends AbstractManager
{
    public const TABLE = 'scene';


    private array $scene = [

        'scene1' => [
            // Porte d'entrée de la WCS (lancement du jeu)
            'dialogues' => "Il n’y a plus de lumière, je ne vois plus rien! 
            Comment faire ? Il doit bien y avoir une solution pour rallumer la lumière.",

            'image' => '', // Porte d'entrée de la Wild

            //Enigme 1 le tableau électrique (quand on clique sur la pastille)
            'plan1' => [
                'dialogues' => "Oh un tableau électrique ! Je vais pouvoir rallumer la lumière ! 
                Des instructions ont été laissé pour me guider.",

                'image' => '', // Tableau électrique
                'link' => [
                    "/scene?scene=1&plan=2"
                ]
            ],

            // Pastille de gauche, innaccessible sans la clé
            'plan2' => [
                'dialogues' => "La porte est verouillée.. je ne peux pas sortir."
            ],

            // porte + clé récupérée : sortie autorisée
            'plan3' => [
                'dialogues' => "Je peux utiliser la clé pour sortir ! Ca y est je peux m'en aller d'ici ! ",

                'image' => '', //porte d'entrée de la Wild
            ],
        ],

        'scene2' => [
        // Bureau de Clothilde
            'dialogues' => "Voyons voir ce que je peux trouver par ici. 
            Clothilde ne m'en voudra pas trop si je fouille un peu autour de son bureau",

            'image' => '', // Bureau de Clothilde

            // Post-it instructions
            'plan1' => [
                'dialogues' => "On dirait des instructions à suivre ...",

                'image' => ' ', // Post-it
            ],

            // Enigme 2 armoire de droite / pour récupérer mdp de l'ordi / Enigme non résolue
            'plan2' => [

                'dialogues' => " ", //L'enigme est affichée pas de dialogue à ajouter

                'image' => " ",
            ],

            // Enigme 2 armoire de droite / pour récupérer mdp de l'ordi / enigme résolue
            'plan3' => [

                'dialogues' => "Bravo ! Ce mot va peut être m'être utile pour la suite ...",

                'image' => "", // L'énigme est affichée
            ],

            //ordinateur (code non entré)
            'plan4' => [

                'dialogues' => "On dirait que je peux indiquer un mot de passe ...",

                'image' => "", // Ordinateur demandant le code (formulaire)
            ],

            // ordinateur - code entré, des chiffres apparaissent sur l'écran de l'ordi
            'plan5' => [

                'dialogues' => "Ca y est bien joué ! Que vais-je pouvoir faire des ces chiffres ?",

                'image' => " ", // Ordinateur demandant le code (formulaire)
            ],

            // armoire de gauche, code non entré
            'plan6' => [

                'dialogues' => "On dirait que je peux entrer un code...",

                'image' => " ",
            ],

            // armoire de gauche, code entré, clé non cliquée
            'plan7' => [

                'dialogues' => "Super ! Maintenant l'amoire est ouverte et..oh on dirait une clé !",

                'image' => " ", // Armoire de gauche ouverte avec la clé à cliquer
            ],

            // armoire de gauche, code entré, clé non cliquée
            'plan8' => [

                'dialogues' => "Cette clé devrait m'être grandement utile !",

                'image' => " ", // Armoire de gauche ouverte clé cliquée et est dans l'inventaire
            ],


        ],
    ];


    public function getScene(?string $scene = null, ?string $plan = null): array
    {
        if (isset($scene) && isset($plan) && isset($this->scene[$scene][$plan])) {
            return $this->scene[$scene][$plan];
        } elseif (isset($scene) && isset($this->scene[$scene])) {
            return $this->scene[$scene];
        }
        return [];
    }

    /**
     * Insert new item in database
     */
    public function insert(array $scene): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $scene['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
