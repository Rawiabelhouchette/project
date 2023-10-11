$(document).ready(function () {

    // Verifcation de la confirmation de mot de passe
    var password = $("#mot_de_passe");
    var confirm_password = $("#confirmer_mot_de_passe");
    var error_message = $("#error_message");

    function validatePassword() {
        if (password.val() != confirm_password.val()) {
            confirm_password[0].setCustomValidity("Mot de passe non identique");
            error_message.html("Mot de passe non identique");
        } else {
            confirm_password[0].setCustomValidity("");
            error_message.html("");
        }
    }

    password.on("change", validatePassword);
    confirm_password.on("keyup", validatePassword);


    // Initialisation du select2
    $('.js-example-basic-multiple-single').select2();


    // Previsualisation de document
    $("#input-pdf").change(function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#pdf-container").html('<embed src="' + e.target.result + '#toolbar=1&navpanes=0&scrollbar=0" type="application/pdf" width = "100%" height = "600px" / > ');
        }
        reader.readAsDataURL(file);
    });


    // Ajout de nouveau fichier pdf
    var nombre_pdf = 0;
    var cpt = 0;
    var liste_input = [];
    let liste_exception = [];

    $('#add-fichier').click(function () {
        nombre_pdf++;
        const fileInput = $('<input>').attr({
            type: 'file',
            name: 'memoires' + nombre_pdf + '[]',
            // name: 'memoires' + nombre_pdf,
            id: "memoires-" + nombre_pdf,
            style: "display:none;",
            class: "dy-fichier",
            multiple: "multiple",
            accept: "application/pdf"
        });

        $("#zone-fichier").append(fileInput);

        $("#memoires-" + nombre_pdf).show().focus().click().hide();

        $("#memoires-" + nombre_pdf).change(function () {
            var files = this.files;
            for (var i = 0; i < files.length; i++) {
                liste_input.push(files[i]);
                // Get the name of the file
                var filename = files[i].name;

                cpt++;
                var text = `
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" data-name="` + filename + `" data-index="` + i + `">
                        <div class="row widget m-h-5 text-center">
                            <a href="#" class="link" data-index="` + (cpt - 1) + `">
                                <h4> Fichier ` + (cpt) + `</h4>
                            </a>
                            <a href="#" class="fichier-link" id="fichier-link-` + (cpt - 1) + `" data-index="` + (cpt - 1) + `" style="font-size:90%;color: red;">x</a>
                        </div>
                    </div>
                `;

                $("#zone-text").append(text);
            }

            $("#zone-text").on('click', 'div div .link', function () {
                var i = $(this).data('index');
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#pdf-container").html(`<embed style="height: 950px;" src="` + e.target.result + `#toolbar=1&navpanes=0&scrollbar=0" type = "application/pdf" width = "100%" height = "600px" / > `);
                }
                reader.readAsDataURL(liste_input[i]);
            });

            $("#zone-text").on('click', 'div div [id^="fichier-link-"]', function () {
                // Recuperer l'id de l'element
                var compteur = $(this).attr('id').match(/fichier-link-(\d+)/)[1];
                // Slectionnoner l'id de  l'element precis
                var element_courant = $("#fichier-link-" + compteur);
                // Ajouter l'element a la liste des exceptions
                liste_exception.push(element_courant.parent().parent().data('name'));
                // Supprimer les doublons
                liste_exception = [...new Set(liste_exception)];
                // Supprimer l'element de la liste (sur le front)
                $(this).parent().parent().remove();
                // Attribuer la liste des exceptions a l'input
                $("#element_supp").val(liste_exception);
                // Vider l'affichage du pdf
                $("#pdf-container").html('<h4>Aucun fichier sélectionné</h4>');
            });

        });
    });

    var image_default = true;
    $('#btn-edit').click(function () {
        $('#photo').click();
    });

    $('#btn-delete').click(function () {
        $('#image-default').show();
        $('#image-show').hide();
        $('#photo').val('');
        image_default = true;
    });

    $('#btn-show').click(function () {
        if (image_default == false) {
            const file = $('#photo')[0].files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                Swal.fire({
                    text: ' ',
                    imageUrl: e.target.result,
                    width: '50%',
                    imageAlt: 'Custom image',
                    confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                });
            };
            reader.readAsDataURL(file);
        } else {
            Swal.fire({
                title: 'Aucune image sélectionnée',
                text: '',
                icon: 'warning',
                width: '50%',
                imageAlt: 'Custom image',
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
            });
        }
    });


    // Surveiller les changements dans le champ de fichier
    $('#photo').change(function () {
        image_default = false;
        var file = this.files[0];
        var reader = new FileReader();

        // Créer un objet FileReader pour lire le contenu de l'image
        reader.onload = function (e) {

            $('#image-show').attr('src', e.target.result);
            $('#image-default').hide();
            $('#image-show').show();
        }

        // Lire le contenu de l'image
        reader.readAsDataURL(file);
    });


});
