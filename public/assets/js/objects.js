document.addEventListener('DOMContentLoaded', function () {
    
    const keyArea = document.querySelector('#keyArea');
    const inventory = document.querySelector('.inventory');

    // Récupérer les données d'inventaire de la session lors du chargement de la page
    const storedInventory = sessionStorage.getItem('gameInventory');

    // Si des données d'inventaire sont stockées, les mettre à jour dans la classe "inventory"
    if (storedInventory) {
        inventory.innerHTML = storedInventory;
        updateInventoryOnServer(storedInventory);
    }

    if (keyArea) {
        keyArea.addEventListener('click', function (event) {
            // Empêche le comportement par défaut du lien
            event.preventDefault();

            // Met à jour le contenu de la classe "inventory"
            // const keyImage = '<img src="/assets/images/cle.png" alt="clé" width="50px"/>';
            // inventory.innerHTML = keyImage;

            // <input type="submit" value="🔑"></input>
            const keyExistsInInventory = inventory.querySelector('[name="inventory_item"][value="key"]');

            if (!keyExistsInInventory) {
                const inventoryForm = `
                    <form method="post" class="inventory">
                        <input type="hidden" name="inventory_item" value="key">
                        <input type="image" src="/assets/images/cle.png" alt="clé" width="50px"></input>
                    </form>
                `;
                inventory.innerHTML = inventoryForm;

                // Stocker les données d'inventaire dans la session
                sessionStorage.setItem('gameInventory', inventoryForm);

                // Requête fetch pour envoyer les données mises à jour au serveur
                updateInventoryOnServer(inventoryForm);
            }
        });
    }
    const logoutButton = document.querySelector('#logoutButton');

    if (logoutButton) {
        logoutButton.addEventListener('click', function () {
            // Remove the inventory data from sessionStorage
            sessionStorage.removeItem('gameInventory');
            // Ajoutez d'autres étapes de déconnexion si nécessaire
        });
    }
});

