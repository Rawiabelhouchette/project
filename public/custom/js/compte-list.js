$(document).ready(function () {

    let headers = document.querySelectorAll("#example1 th");
    headers.forEach(header => {
        header.style.border = "1px solid black";
        header.style.backgroundColor = "lightblue";
    });


    var datatable = $('#example1').DataTable({
        "order": [
            [0, "desc"]
        ],
        "pageLength": 50,
        "lengthChange": false,
        // "scrollY": "150vh",
        //"scrollY": "2000px",
        "scrollCollapse": true,
        fixedHeader: {
            header: true,
            footer: true,
            offsetTop: 5000
        },


        "oLanguage": {

            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },

            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
        }

    });
    
    // Supprimer un compte
    $('.delete').on('click', function () {
        Swal.fire({
            title: "Êtes  vous sûr de vouloir supprimer ce compte ?",
            icon: 'question',
            height: '40%',
            width: '40%',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<span style="font-size: 15px;">OUI</span>',
            cancelButtonText: '<span style="font-size: 15px;">NON</span>',
        }).then((result) => {
            if (result.isConfirmed) {
                var link = $(this).data('link');
                var id = $(this).data('id');
                var token = $(this).data('token');
                // Faire une requete ajax pour supprimer le document
                $.ajax({
                    url: link,
                    type: 'DELETE',
                    data: {
                        _token: token,
                    },
                    success: function (response) {
                        // Supprimer la ligne du tableau Avec fadeOut
                        $("#tr-" + id).fadeOut(500, function () {
                            $(this).remove();
                            $("#tr-" + id).remove();
                        });

                        // Code à exécuter en cas de succès
                        Swal.fire({
                            title: "Supprimé!",
                            timer: 4000,
                            icon: 'success',
                            confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                            height: '40%',
                            width: '40%',
                            html: "<p style='font-size: 17px'>" + response.message + "</p>",

                        });

                    },
                    error: function (xhr, status, error) {
                        // Code à exécuter en cas d'erreur                        
                        Swal.fire({
                            title: "Erreur!",
                            timer: 4000,
                            icon: 'error',
                            confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                            height: '40%',
                            width: '40%',
                            html: "<p style='font-size: 17px'>Une erreur s'est produite..</p>",
                        });
                    }
                });
            }
        });
    });

    $('#recherche').on('keyup', function () {
        console.log("recherche");
        var value = $('#recherche').val().toLowerCase();
        datatable.search(value).draw();
    });

});