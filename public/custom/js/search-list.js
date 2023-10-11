$(document).ready(function () {
    $('#btn-register').click(function () {
        $('#signin').modal('hide');

        setTimeout(function () {
            $('#register').modal('show');
        }, 500);
    });

    $('#btn-login').click(function () {
        $('#register').modal('hide');

        // Attendre une seconde avant d'afficher le modal
        setTimeout(function () {
            $('#signin').modal('show');
        }, 500);
    });

    // SEND MAIL
    $('#send-email').change(function () {
        var option = $(this).val();
        if (option != '') {
            $.ajax({
                url: '/send-email',
                type: 'post',
                dataType: 'json',
                data: {
                    option: option
                },
                success: function (response) {
                    alert(response.message);
                }
            });
        }
    });


    // Favoris MANAGEMENT
    $(document).on('click', 'a[href="javascript:void(0)"][id="f-0"]', function() {
        var id = $(this).data('id');
        var url = $(this).data('url');
        var token = $(this).data('token');
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: id,
                _token: token
            },
            success: function (data) {
                // remove class "orange-color"
                $('.favoris-' + data.id).removeClass('orange-color');
                if (data.is_favoris == 1) {
                    $('.favoris-' + data.id).css('color', '#EA4F0C');
                } else {
                    $('.favoris-' + data.id).css('color', '#334E6F');
                }
            },
            error: function () {
                alert('Une erreur est survenue.');
            }
        });
    });

    // Affichage des echantillons des filtres
    function loadMoreData(list_id, btn_id, zone_id) {
        var listItems = $('#' + list_id + ' li');
        var numItemsToShow = 5;
        var numItemsToAdd = 5;
        var currentIndex = 0;
        var totalItemsToDisplay = listItems.length - numItemsToShow;

        // Masquer tous les éléments de la liste sauf les premiers à afficher
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
    loadMoreData('list-type-document', 'voir-plus-btn-type-document', 'voir-plus-zone-type-document');
    loadMoreData('list-auteur', 'voir-plus-btn-auteur', 'voir-plus-zone-auteur');
    loadMoreData('list-directeur', 'voir-plus-btn-directeur', 'voir-plus-zone-directeur');
    loadMoreData('list-domaine-formation', 'voir-plus-btn-domaine-formation', 'voir-plus-zone-domaine-formation');
    loadMoreData('list-niveau-etude', 'voir-plus-btn-niveau-etude', 'voir-plus-zone-niveau-etude');
    loadMoreData('list-site-catalogage', 'voir-plus-btn-site-catalogage', 'voir-plus-zone-site-catalogage');
    loadMoreData('list-type-memoire', 'voir-plus-btn-type-memoire', 'voir-plus-zone-type-memoire');
    loadMoreData('list-filiere', 'voir-plus-btn-filiere', 'voir-plus-zone-filiere');
    loadMoreData('list-public-cible', 'voir-plus-btn-public-cible', 'voir-plus-zone-public-cible');
    loadMoreData('list-sujet', 'voir-plus-btn-sujet', 'voir-plus-zone-sujet');


    // FILTRE DE LA FACETTE
    $('.filter-checkbox').on('change', function () {
        $('#tr-loader').show();
         
        //  Recuperer les valeurs des filtres
        var id = $(this).data('id');
        var colonne = $(this).data('colonne');
        var valeur = $(this).data('valeur');
        var type = $(this).data('type');
        var index = $(this).data('index');
        var slug = $(this).data('slug');
        var isChecked = null;

        isChecked = ($(this).is(':checked')) ? 1 : 0;

        $('#filtre').val(JSON.stringify({
            id: id,
            colonne: colonne,
            valeur: valeur,
            type: type,
            index: index,
            isChecked: isChecked,
            slug: slug,
        }));

        // Submit form
        $('#filterForm').submit();
    });

    // TRIER LES DOCUMENTS
    $('#select-order').on('change', function () {
        $('#tr-loader').show();
         
        //  Recuperer les valeurs des filtres
        var type = $(this).find(":selected").attr("data-type");
        var ordre = $(this).find(":selected").attr("data-ordre");
        var colonne = $(this).find(":selected").attr("data-colonne");
        var valeur = $(this).val();

        $('#tri-document').val(JSON.stringify({
            colonne: colonne,
            valeur: valeur,
            type: type,
            ordre: ordre,
        }));

        // Submit form
        $('#filterForm').submit();
    });

    $('#select-order').val($('#tri-document').val());


    // Supprimer un filtre a badge
    $('.filtre').on('click', function() {
        var slug = $(this).data('slug');
        $('#' + slug).trigger('click');
    });

    // Supprimer tous les filtres
    $(document).on('click', '#filtre-reset', function() {
        $('#btn-search-submit').click();
    });

    // Choix d'un sujet sur le document
    $(document).on('click', '.sujet', function() {
        var id = $(this).data('id');
        $('#filtres').val('');
        $('#' + id).trigger('click');
    });

});