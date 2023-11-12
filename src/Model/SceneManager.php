<?php

namespace App\Model;

use PDO;

class SceneManager extends AbstractManager
{
    public const TABLE = 'scene';


    private array $scene = [

        'scene1' => [
            // Porte d'entrée de la WCS (lancement du jeu)
            'dialogues-scene1' => "Il n’y a plus de lumière, je ne vois plus rien! 
            Comment faire ? Il doit bien y avoir une solution pour rallumer la lumière.",
            
            'dialogues-plan6' => "La porte est verouillée.. je ne peux pas sortir.",
            
            'dialogues-winner' => "Je peux utiliser la clé pour sortir ! Ca y est je peux m'en aller d'ici ! ",
            
            'image-off' => '', // Porte d'entrée de la Wild lumière éteinte
            'image-on' => '', //Porte d'entrée de la Wild lumière allumée
            
            'link1-scene1' => '', //lien null quand pas d'objet
            'link2-scene1' => '', //lien Winner
            'link3-scene1' => '', //lien tableau électrique
            'link4-scene1' => '',//lien scene 2 Bureau de Clothilde, null quand pas énigme1 résolue
            'link5-scene1' => '',//lien scene 2 Bureau de Clothilde
            'link-exit' => '', //quitte le jeu en cours, renvoie à la page des scenarios
        ],
        
        'plan1' => [
            //Enigme 1 le tableau électrique
            'dialogues-plan1' => "Oh un tableau électrique ! Je vais pouvoir rallumer la lumière ! 
            Des instructions ont été laissé pour me guider.", // enigme visible

            'dialogues-plan1-success' => "Bien joué, la lumière s'est rallumée !",

            'image' => '', // Tableau électrique

            'link-retour' => '', //fleche retour
            // 'link1-plan2' => '', 
            //     "/scene?scene=1&plan=2"
        ],

        // Porte de la WCS
        // 'plan6' => [
            
        //     'image' => '', //porte d'entrée de la Wild
                
        // ],
        
        'scene2' => [
        // Bureau de Clothilde
            'dialogues-scene2' => "Voyons voir ce que je peux trouver par ici. 
            Clothilde ne m'en voudra pas trop si je fouille un peu autour de son bureau",
            
            'dialogues-scene2-objectget' => "Super ! Cette clé devrait m'être très utile !",

            'image' => '', // Bureau de Clothilde

            'link1-scene2' => '', //lien scene 1 fleche retour
            'link2-scene2' => '', //lien plan 2 post it
            'link3-scene2' => '', //lien plan 3 armoire de droite
            'link4-scene2' => '', //lien plan 4 ordinateur
            'link5-scene2' => '', //lien plan 5 armoire de gauche
        ],

            // Post-it instructions
        'plan2' => [
            'dialogues-plan2' => "On dirait des instructions à suivre ...",

            'image' => ' ', // Post-it
            'link-retour' => '', //lien retour
        ],

            // Enigme 2 armoire de droite
        'plan3' => [

            'dialogues1-plan3' => " ", //L'enigme est affichée pas de dialogue à ajouter
            'dialogues2-plan3' => "Bravo ! Ce mot va peut être m'être utile pour la suite ...",

            'image' => " ",

            'link-retour' => '', //lien retour
        ],

            // Enigme 2 armoire de droite / pour récupérer mdp de l'ordi / enigme résolue
        // 'plan4' => [

        //     'image' => "", // L'énigme est affichée

        // ],

        //Enigme 3 : ordinateur
        'plan4' => [

            'dialogues1-plan4' => "On dirait que je peux indiquer un mot de passe ...",
            'dialogues2-plan4' => "Ca y est bien joué ! Que vais-je pouvoir faire de ces chiffres ?",

            'image1' => "", // Ordinateur demandant le code (formulaire)
            'image2' => " ", // Ordinateur affiche code 

            'link-retour' => '', //lien retour
        ],
        
        //Enigme 4 : armoire de gauche
        'plan5' => [

            'dialogues1-plan5' => "On dirait que je peux entrer un code...",
            'dialogues2-plan5' => "Super ! Maintenant l'amoire est ouverte et..oh on dirait une clé !",
            'dialogues3-plan5' => "Cette clé devrait m'être grandement utile !",

            'image1' => " ", //armoire fermée
            'image2' => " ", // Armoire ouverte avec la clé à cliquer
            'image3' => " ", // Armoire de gauche ouverte sans clé

            'link-retour' => '', //lien retour
        ]
    ];

    public function getScene(string $scene = 'scene1'): array
    {
        if (isset($scene) && isset($this->scene[$scene])) {
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
