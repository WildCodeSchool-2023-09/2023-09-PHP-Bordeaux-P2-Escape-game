<?php

// Porte d'entrée de la WCS (lancement du jeu)



//Enigme 1 le tableau électrique (quand on clique sur la pastille)
$scene1_plan1[1.1] = [

    $dialogues => "Oh un tableau électrique ! Je vais pouvoir rallumer la lumière ! Des instructions ont été laissé pour me guider."

];

// Pastille de gauche, innaccessible sans la clé
$scene1_plan2[1.2] = [

    $dialogues => "La porte est verouillée.. je ne peux pas sortir."

];

// bureau de Clothilde
$scene2[2]= [
    
   $dialogues => "Voyons voir ce que je peux trouver par ici. Clothilde ne m'en voudra pas trop si je fouille un peu autour de son bureau",

];

// Post-it instructions
$scene2_plan1[2.1]= [
    $dialogues => "On dirait des instructions à suivre ..."

];

// Enigme 2 armoire de droite / pour récupérer mdp de l'ordi / enigme non résolue
$scene2_plan1[2.2]= [
    $dialogues => " "

];

// Enigme 2 armoire de droite / pour récupérer mdp de l'ordi / enigme résolue
$scene2_plan1[2.3]= [
    $dialogues => "Bravo ! Ce mot va peut être m'être utile pour la suite ..."

];


//ordinateur (code non entré)
$scene2_plan2[2.4] = [
    $dialogues = "On dirait que je peux indiquer un mot de passe ... "

];

// ordinateur - code entré, des chiffres apparaissent sur l'écran de l'ordi
$scene2_plan2[2.5] = [
    $dialogues = "Ca y est bien joué ! Que vais-je pouvoir faire des ces chiffres ? "

];

// armoire de gauche, code non entré
$scene2_plan3[3.1]= [
    $dialogues = "On dirait que je peux etrer un code ... "

];

// armoire de gauche, code entré, clé non cliquée
$scene2_plan3[3.2] = [
    $dialogues = "Super ! Maintenant l'amoire est ouverte et..oh on dirait une clé ! "

];

// clé cliqué
$scene2_plan3[3.3]= [
    $dialogues = "Cette clé devrait m'être grandement utile !"

];






// porte + clé pour sortir 
$scene1_plan3[1.3]= [
    $dialogues = "Je peux utiliser la clé pour sortir ! Ca y est je peux m'en aller d'ici ! "

];
