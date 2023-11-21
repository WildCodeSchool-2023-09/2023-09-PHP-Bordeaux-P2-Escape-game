// gameover.js

// Récupérer le score depuis le stockage local
/* const score = localStorage.getItem('score');

// Mettre à jour le score sur la page
const scoreElement = document.getElementById('score');
scoreElement.textContent = score; */

// Gérer le bouton "Rejouer"
const replayButton = document.getElementById('replayButton');
replayButton.addEventListener('click', () => {
    // Rediriger vers la page du jeu ou réinitialiser le jeu
    window.location.href = 'scenario'; // Remplacez 'game.html' par le nom de votre page de jeu
});


//script chrono
/* let timer;
let minutes = 0;

function startGame() {
    timer = 
   
setInterval(updateChrono, 1000);
}

function updateChrono() {
    minutes++;
    
    minutes++;
   

   
const minutes = Math.floor(minutes / 60);
    
   
const remainingSeconds = minutes % 60;

    

   
document.getElementById('chrono').innerHTML = `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
}
 */