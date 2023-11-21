/*

// audio.js

// Variable globale pour stocker la position de lecture
var globalAudioPosition;

// Fonction pour initialiser la lecture audio
function initAudio() {
    var audio = document.getElementById("myAudio");

    // Vérifier si la position de lecture est déjà définie globalement
    if (typeof globalAudioPosition !== "undefined" && globalAudioPosition !== null) {
        // Reprendre la lecture à partir de la position globale
        audio.currentTime = parseFloat(globalAudioPosition);
    }

    // Ajouter un écouteur d'événements pour suivre l'état de lecture
    audio.addEventListener("play", function () {
        // Enregistrer la position de lecture globalement lors de la lecture
        globalAudioPosition = audio.currentTime;
    });

    audio.addEventListener("pause", function () {
        // Enregistrer la position de lecture lors de la pause
        globalAudioPosition = audio.currentTime;
    });

    audio.addEventListener("ended", function () {
        // Réinitialiser la position de lecture à la fin de la piste
        globalAudioPosition = null;
    });
}

// Appeler la fonction d'initialisation lorsque la page est chargée
window.addEventListener("load", initAudio);

*/
