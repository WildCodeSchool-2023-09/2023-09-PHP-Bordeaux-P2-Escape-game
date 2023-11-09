function detectOrientation() {
    // Ajouter un écouteur d'événements
    window.addEventListener("orientationchange", orientationChangeHandler);
  }
  
  function orientationChangeHandler() {

    // Obtenir l'orientation de l'écran
    const orientation = window.orientationchange;
  
    // Afficher le message d'erreur approprié
    if (orientation === 0 || orientation === 180) {
      
    // Mode portrait
      document.querySelector(".message-erreur").style.display = "block";
    } else if (orientation !== 0 && orientation !== 180) {
        document.querySelector(".message-erreur").style.display = "none";
    }
  }
  
  // Déclencher la fonction au chargement du document
  window.addEventListener("load", detectOrientation);