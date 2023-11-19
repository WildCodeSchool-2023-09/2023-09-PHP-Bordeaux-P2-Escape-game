function updateInventoryOnServer(inventoryData) {
    
    fetch('/update-inventory', {
        method: 'POST',
        body: JSON.stringify({ inventory: inventoryData }),
        headers: {
            'Content-Type': 'application/json',
        },
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function () {
    const keyArea = document.querySelector('#keyArea');
    const inventory = document.querySelector('.inventory');
    const inventoryKey = document.getElementById('inventoryKey');

    // Récupérer les données d'inventaire de la session lors du chargement de la page
    const storedInventory = sessionStorage.getItem('gameInventory');

    // Si des données d'inventaire sont stockées, les mettre à jour dans la classe "inventory"
    if (storedInventory) {
        inventory.innerHTML = storedInventory;
        // Requête fetch pour envoyer les données au serveur
        updateInventoryOnServer(storedInventory);
    }

    if (keyArea) {
        keyArea.addEventListener('click', function (event) {
            // Empêche le comportement par défaut du lien
            event.preventDefault();

            // Met à jour le contenu de la classe "inventory"
            const keyImage = '<img src="/assets/images/cle.png" alt="clé" width="50px"/>';
            inventory.innerHTML = keyImage;

            // Stocker les données d'inventaire dans la session
            sessionStorage.setItem('gameInventory', keyImage);

            // Requête fetch pour envoyer les données mises à jour au serveur
            updateInventoryOnServer(keyImage);
        });
    }

    if (inventoryKey) {
        inventoryKey.addEventListener('click', function (event) {
            event.preventDefault();
            // Vérifier si le joueur est dans le plan2 scene1
            if (scene2 && plan1) {
                window.location.href = '/win';
            }
        });
    }
});