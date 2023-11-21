// exitGame.js

function quitterJeu() {
    // Vérifiez si le joueur a cliqué sur "Quitter le jeu"
    const quitterJeuClicked = localStorage.getItem("quitterJeuClicked");
  
    if (quitterJeuClicked === "true") {
      // Si oui, supprimez le temps du localStorage
      localStorage.removeItem("countdownTime");
    }
  
    // Réinitialisez la variable
    localStorage.setItem("quitterJeuClicked", "false");
  
    // Redirigez vers la page de sortie souhaitée
    window.location.href = "pageDeSortie";
  }
  
  // Appeler la fonction quitterJeu lorsque le joueur quitte le jeu
  window.onbeforeunload = quitterJeu;
  
  // Ajoutez un gestionnaire d'événements pour le bouton "Quitter le jeu"
  const exitZoneButton = document.getElementById("exitZone");
  exitZoneButton.addEventListener("click", function() {
    // Marquez que le joueur a cliqué sur "Quitter le jeu"
    localStorage.setItem("quitterJeuClicked", "true");
  });
  