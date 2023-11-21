// countdown.js

const timerElement = document.getElementById("timer");

function initCountdown() {
  // Vérifiez si le temps est déjà stocké dans le localStorage
  const temps = localStorage.getItem("countdownTime");

  if (temps === null) {
    // Si le temps n'est pas dans le localStorage, initialisez le compte à rebours
    const departMinutes = 15;
    let tempsInitial = departMinutes * 60;

    setInterval(() => {
      let minutes = parseInt(tempsInitial / 60, 10);
      let secondes = parseInt(tempsInitial % 60, 10);

      minutes = minutes < 10 ? "0" + minutes : minutes;
      secondes = secondes < 10 ? "0" + secondes : secondes;

      timerElement.innerText = `${minutes}:${secondes}`;
      tempsInitial = tempsInitial <= 0 ? 0 : tempsInitial - 1;

      // Enregistrez le temps restant dans le stockage local
      localStorage.setItem("countdownTime", tempsInitial);

      if (tempsInitial === 0) {
        // Redirection vers la page "loose" après le compte à rebours
        setTimeout(() => {
          window.location.href = "loose";
        }, 1000);
      }
    }, 1000);
  } else {
    // Si le temps est déjà dans le localStorage, utilisez-le
    let tempsStored = parseInt(temps, 10);

    setInterval(() => {
      let minutes = parseInt(tempsStored / 60, 10);
      let secondes = parseInt(tempsStored % 60, 10);

      minutes = minutes < 10 ? "0" + minutes : minutes;
      secondes = secondes < 10 ? "0" + secondes : secondes;

      timerElement.innerText = `${minutes}:${secondes}`;
      tempsStored = tempsStored <= 0 ? 0 : tempsStored - 1;

      // Enregistrez le temps restant dans le stockage local
      localStorage.setItem("countdownTime", tempsStored);

      if (tempsStored === 0) {
        // Redirection vers la page "loose" après le compte à rebours
        setTimeout(() => {
          window.location.href = "loose";
        }, 1000);
      }
    }, 1000);
  }
}

// Appelez la fonction d'initialisation au chargement de la page
window.onload = initCountdown;
