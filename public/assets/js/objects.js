document.addEventListener('DOMContentLoaded', function () {
    const keyArea = document.querySelector('#keyArea');
    const inventory = document.querySelector('.inventory');

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
            // const keyImage = '<img src="/assets/images/cle.png" alt="clé" width="50px"/>';
            // inventory.innerHTML = keyImage;

            const inventoryForm = `
                <form method="post" class="inventory">
                    <input type="hidden" name="inventory_item" value="key">
                    <input type="submit" value="🔑">
                </form>
            `;
            inventory.innerHTML = inventoryForm;

            // Stocker les données d'inventaire dans la session
            sessionStorage.setItem('gameInventory', inventoryForm);

            // Requête fetch pour envoyer les données mises à jour au serveur
            updateInventoryOnServer(inventoryForm);
        });
    }
});