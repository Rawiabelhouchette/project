$(document).ready(function() {
    $('.edit').on('click', function() {

    });


    $('.delete').on('click', function() {
        
        Swal.fire({
        title: "<span style='font-size: 15px;'>TYPE : " + $(this).data('type') + " &nbsp;&nbsp;&nbsp;  NOM : " + $(this).data('nom') + " &nbsp;&nbsp;&nbsp; VALEUR : " + $(this).data('valeur') + "</span> <br>Êtes vous sure de vouloir supprimer cette reference ? <br>",
        icon: 'warning',
        height: '40%',
        width: '40%',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<span style="font-size: 15px;">OUI</span>',
        cancelButtonText: '<span style="font-size: 15px;">NON</span>',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'La reference a été supprimée avec succès',
                    icon: 'success',
                    height: '40%',
                    width: '40%',
                    confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                    timer: 3000,
                });
                $(this).closest('tr').remove();
            }
        });


    });

});
