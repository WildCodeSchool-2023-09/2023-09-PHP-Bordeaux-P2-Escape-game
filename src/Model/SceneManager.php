<?php

namespace App\Model;

use PDO;

class SceneManager extends AbstractManager
{
    public const TABLE = 'scene';

    private array $scenes = [

        'scene1' => [
            'name' => "couloir",
            'dialogues' => "Il n’y a plus de lumière, je ne vois plus rien! 
            Comment faire ? Il doit bien y avoir une solution pour rallumer la lumière.",
            'dialoguesSuccess' => "Je vais pouvoir aller dans l'open-space !",
            'image' => '/assets/images/Scene1_light-on.png',
            'image_dark' => '/assets/images/1_Scene1_light-off.png ',
            'href' => "/scene?scene=scene1",
            'alt' => "pièce sombre et non éclairée",
            'linkedPlans' => [
                'plan1' => [
                    'name' => 'Eleccompteur',
                    'coords' => "340,90,10",
                    'href' => "/plan?scene=scene1&plan=plan1",
                    'alt' => "Tableau électrique",
                    'dialogues' => "Oh un tableau électrique ! 
                    Je vais pouvoir rallumer la lumière ! Des instructions ont été laissé pour me guider.",
                    'dialoguesSuccess' => "Bien joué, la lumière s'est rallumée !",
                    'image' => '/assets/images/tableauElectrique.jpg',
                    'linkRetour' => '/scene?scene=scene1',
                    'validated' => "Déjà fait!",
                    'enigma' => [
                        'question' => "Quel fil faut-il reconnecter pour allumer la lumière de sécurité ?",
                        'answers' => [
                            'les fils jaune',
                            'les fils rouge',
                            'les fils rose',
                            'les fils bleu'
                        ],
                        'goodIndex' => 1
                    ]
                ],
                'plan2' => [
                    'name' => 'PorteSortie',
                    'coords' => "205,125,10",
                    'href' => "/plan?scene=scene1&plan=plan2",
                    'alt' => "Porte de sortie",
                    'dialogues' =>  "La porte est verouillée.. je ne peux pas sortir.",
                    'dialoguesSuccess' => "Je peux utiliser la clé pour sortir ! Ca y est je peux m'en aller d'ici ! ",
                    'image' => '/assets/images/doorclosed.png',
                    'linkRetour' => '/scene?scene=scene1',
                    'link1' => '', //lien Winner
                    'link2' => '', //lien null quand pas d'objet
                ],
            ],
            'linkedScene' => 'scene2',
        ],
        'scene2' => [
            'name' => "bureau",
            'dialogues' => "Voyons voir ce que je peux trouver par ici. 
            Clothilde ne m'en voudra pas trop si je fouille un peu autour de son bureau",
            'dialoguesSuccess' => "Super ! Cette clé devrait m'être très utile !",
            'image' => '/assets/images/Scene2_bureau.png',
            'alt' => "Bureau de Clothilde",
            'href' => "/scene?scene=scene2",
            'linkedPlans' => [
                'plan1' => [
                    'name' => 'Post-it',
                    'coords' => "217,46,10",
                    'href' => "/plan?scene=scene2&plan=plan1",
                    'alt' => "un Post-it avec des trucs écrits dessus",
                    'dialogues' => "On dirait des instructions à suivre ...",
                    'image' => '/assets/images/postIt.png',
                    'linkRetour' => '/scene?scene=scene2',
                ],
                'plan2' => [
                    'name' => 'ArmoireDeDroite',
                    'coords' => "349,75,10",
                    'href' => "/plan?scene=scene2&plan=plan2",
                    'alt' => "une armoire fermé",
                    'dialogues' => "", //L'enigme est affichée pas de dialogue à ajouter
                    'dialoguesSuccess' => "Bravo ! Ce mot va peut être m'être utile pour la suite ..." . " Ordinateur ",
                    'image' => '/assets/images/armoireDroite.png ',
                    'linkRetour' => '/scene?scene=scene2',
                    'validated' => "J'ai trouvé le mot : Ordinateur ",
                    'enigma' => [
                        'question' => "Je ne suis pas humain. 
                        Animal non plus, même si une partie de moi en porte le nom. 
                        Je ne dors jamais, mais parfois je peux me reposer. 
                        Je fais ce qu’on me dit de faire, je n’ai pas le choix, 
                        et si je commets une erreur, c’est parce qu’on m’a dit de la faire. Qui suis-je ?",
                        'answers' => [
                            'Télévision ',
                            'Téléphone',
                            'Ordinateur',
                            'Voiture '
                        ],
                        'goodIndex' => 2
                    ]
                ],
                'plan3' => [
                    'name' => 'Ordinateur',
                    'coords' => "220,134,10",
                    'href' => "/plan?scene=scene2&plan=plan3",
                    'alt' => "un Ordinateur portable",
                    'dialogues' => "On dirait que je peux indiquer un mot de passe ...",
                    'dialoguesSuccess' => "Ca y est bien joué ! Que vais-je pouvoir faire des ces chiffres ?",
                    'image' => '/assets/images/ordinateur.png ', // Ordinateur demandant le code (formulaire)
                    'image2' => ' /assets/images/ordinateur-code-affiche.png',
                    'linkRetour' => '/scene?scene=scene2',
                    'validated' => "le code 5426 est apparu à l'écran ",
                    'enigma' => [
                        'question' => "Quel est le mot de passe ?",
                        'answers' => [
                            'Ordinateur ',
                            'My_beers',
                            'Mcdonalds',
                            'Harry_potter'
                        ],
                        'goodIndex' => 0
                    ]
                ],
                'plan4' => [
                    'name' => 'ArmoireDeGauche',
                    'coords' => "122,75,10",
                    'coordsKey' => "268,148,20",
                    'href' => "/plan?scene=scene2&plan=plan4",
                    'alt' => "une armoire fermée par un cadenas",
                    'dialogues' => "On dirait que je peux entrer un code...",
                    'dialoguesSuccess' => "Super ! Maintenant l'amoire est ouverte et..oh on dirait une clé !",
                    'dialoguesObject' =>  "Cette clé devrait m'être grandement utile !",
                    'image' => ' /assets/images/armoireGauche- closed.png',
                    'image2' => ' /assets/images/armoireGauche-openedKey.png',
                    'image3' => ' /assets/images/armoire_gauche_open.jpg',
                    'linkRetour' => '/scene?scene=scene2',
                    'validated' => "j'ai trouvé une clé ici",
                    'enigma' => [
                        'question' => "Quel est le code ?",
                        'answers' => [
                            '8647 ',
                            '3468',
                            '4278',
                            '5426'
                        ],
                        'goodIndex' => 3
                    ]
                ],
            ],
            'linkedScene' => 'scene1',
        ],
    ];

    public function getScene(string $sceneKey = 'scene1'): array
    {
        if (isset($this->scenes[$sceneKey])) {
            $scene = $this->scenes[$sceneKey];
            return $scene;
        }
        return [];
    }

    public function getPlan(string $sceneKey, string $planKey): array
    {
        if (isset($this->scenes[$sceneKey]['linkedPlans'][$planKey])) {
            $plan = $this->scenes[$sceneKey]['linkedPlans'][$planKey];
            return $plan;
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
