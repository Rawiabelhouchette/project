$('#type').on('change',function () {
    $.ajax({
        url: '/staff/references/nom/' + $('#type').val(),
        type: "GET",
        success: function (data) {
            $('#nom').empty();
            
            $('#nom').append('<option value="" selected disabled>Nom de référence</option>')

            for (var i = 0; i < data.length; i++) {
                $('#nom').append('<option value="'+data[i].nom+'">'+data[i].nom+'</option>')
            }

        }, 
        error: function (data) {
            Alert("Une erreur est survenue")
        },
    });
});