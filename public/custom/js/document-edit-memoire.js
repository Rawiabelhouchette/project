$(document).ready(function () {

    // Initialisation du select2
    $('.js-example-basic-multiple-single').select2();

    // Previsualisation des documents
    $("#zone-fichier").on('click', '.link', function () {
        var pdfUrl = $(this).data('chemin');
        $("#pdf-container").html('<embed src="' + pdfUrl + '#toolbar=1&navpanes=0&scrollbar=0" type="application/pdf" width = "100%" height = "600px" /> ');
    });

    // Initialisation du select2
    $('.js-example-basic-multiple-single').select2();


    // EDITION DES FICHIERS
    var nombre_pdf = 0;
    var cpt = $("#nbr_fichier").val();
    var cpt_initial = cpt;
    var liste_input = [];
    let liste_exception = [];

    // Previsualisation des documents
    $("#zone-fichier").on('click', '.fichier-link', function () {
        // Recuperer l'id de l'element
        var compteur = $(this).attr('id').match(/fichier-link-(\d+)/)[1];
        // Slectionnoner l'id de l'element precis
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

    $('#add-fichier').click(function () {
        nombre_pdf++;
        const fileInput = $('<input>').attr({
            type: 'file',
            name: 'memoires' + nombre_pdf + '[]',
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
                liste_input.push(files[i]); // Get the name of the file var
                filename = files[i].name; cpt++; var text = ` <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6"
                    data-name="` + filename + `" data-index="` + i + `">
                    <div class="row widget m-h-5 text-center">
                        <a href="#" class="link" data-index="` + (cpt - 1) + `">
                            <h4> Fichier ` + (cpt) + `</h4>
                        </a>
                        <a href="#" class="fichier-link" id="fichier-link-` + (cpt - 1) + `" data-index="` + (cpt - 1) + `"
                            style="font-size:90%;color: red;">x</a>
                    </div>
                    </div>
                `;

                $("#zone-fichier").append(text);
            }

            $("#zone-fichier").on('click', 'div div .link', function () {
                var i = $(this).data('index');
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#pdf-container").html(`<embed style="height: 950px;" src="` + e.target.result + `#toolbar=1&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" /> `);
                }
                reader.readAsDataURL(liste_input[i - cpt_initial]);
            });
        });
    });


    // MODIFICATION DES FICHIERS IMAGES
    var image_default = true;
    var image_default_0 = false
    var tmp = $('#image-default').data('validation');
    $('#btn-edit').click(function () {
        $('#photo').click();
    });

    $('#btn-delete').click(function () {
        console.log($('#image-default').data('link'));
        $('#image-default-0').show();
        $('#image-default').hide();
        $('#image-show').hide();
        $('#photo').val('');
        image_default_0 = true;
        image_default = true;
        tmp = 0;
    });

    $('#btn-show').click(function () {
        if (tmp == 0) {
            Swal.fire({
                title: 'Aucune image sélectionnée',
                text: '',
                icon: 'warning',
                // imageUrl: link_default,
                width: '50%',
                // imageWidth: '250%',
                // imageHeight: '40%',
                imageAlt: 'Custom image',
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
            });

            tmp = 1;
            return;
        }
        if (image_default_0 == true && image_default == true && $('#image-default').data('validation') == '0') {
            Swal.fire({
                title: 'Aucune image sélectionnée',
                text: '',
                icon: 'warning',
                // imageUrl: link_default,
                width: '50%',
                // imageWidth: '250%',
                // imageHeight: '40%',
                imageAlt: 'Custom image',
                confirmButtonText: '<span style="font-size: 15px;">OK</span>',
            });

        }
        else if (image_default == false) {
            const file = $('#photo')[0].files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                Swal.fire({
                    text: ' ',
                    imageUrl: e.target.result,
                    width: '50%',
                    // imageWidth: '100%',
                    // imageHeight: '40%',
                    imageAlt: 'Custom image',
                    confirmButtonText: '<span style="font-size: 15px;">OK</span>',
                });
            };
            reader.readAsDataURL(file);
        } else {
            // var link_default = $('#image-default').data('link');
            const file = $('#image-default').data('link');
            Swal.fire({
                text: ' ',
                imageUrl: file,
                width: '50%',
                // imageWidth: '100%',
                // imageHeight: '40%',
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
            $('#image-default-0').hide();
            $('#image-default').hide();
            $('#image-show').show();
            // $('#preview').show();
            // $('#ico').hide();
        }

        // Lire le contenu de l'image
        reader.readAsDataURL(file);
    });



});
