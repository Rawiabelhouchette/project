$(document).ready(function () {
    // Affichage des echantillons des filtres
    function loadMoreData(list_id, btn_id, zone_id) {
        var listItems = $('#' + list_id + ' li');
        console.log(listItems);
        var numItemsToShow = 5;
        var numItemsToAdd = 5;
        var currentIndex = 0;
        var totalItemsToDisplay = listItems.length - numItemsToShow;

        // Masquer tous les éléments de la liste sauf les premiers à afficher
        listItems.hide();
        listItems.slice(currentIndex, currentIndex + numItemsToShow).show();

        // Gérer le clic sur le bouton "Voir plus"
        $('#' + btn_id).on('click', function () {
            currentIndex += numItemsToShow;
            $(this).empty();
            totalItemsToDisplay = totalItemsToDisplay - numItemsToAdd;
            // Add <h5>Voir plus ({{ count($auteurs) - 5 }}) +</h5>
            $(this).append('<h5>Voir plus (' + (totalItemsToDisplay) + ') +</h5>');

            // Afficher les éléments supplémentaires
            listItems.slice(currentIndex, currentIndex + numItemsToAdd).show();

            // Masquer le bouton "Voir plus" si tous les éléments ont été affichés
            if (currentIndex + numItemsToAdd >= listItems.length) {
                $('#' + zone_id).hide();
            }
        });
    }

    // Afficher les echantillons des filtres
    loadMoreData('list-types', 'voir-plus-btn-type', 'voir-plus-zone-type');
});