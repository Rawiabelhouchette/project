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
    //  SORT TABLE
    function sortTable(data, order, type) {
        // const order = selectOrder.val();
        const tbody = $("tbody").eq(0);
        const rows = Array.from(tbody.find("tr"));
        rows.sort((row1, row2) => {
            var cell1, cell2;
            if (type == "date") {
                cell1 = getDateValue($(row1).find("td").eq(0).attr(data));
                cell2 = getDateValue($(row2).find("td").eq(0).attr(data));
            } else {
                cell1 = $(row1).find("td").eq(0).attr(data).toLowerCase();
                cell2 = $(row2).find("td").eq(0).attr(data).toLowerCase();
            }
            if (cell1 < cell2) {
                return order === "asc" ? -1 : 1;
            } else if (cell1 > cell2) {
                return order === "asc" ? 1 : -1;
            } else {
                return 0;
            }
        });
        tbody.empty();
        rows.forEach((row) => {
            tbody.append(row);
        });
    }

    function getDateValue(dateString) {
        var year, month, day;
        if (dateString.indexOf("/") != -1) {
            parts = dateString.split("/");
            year = parseInt(parts[2], 10);
            month = parseInt(parts[1], 10);
            day = parseInt(parts[0], 10);
        } else {
            parts = dateString.split("-");
            year = parseInt(parts[0], 10);
            month = parseInt(parts[1], 10);
            day = parseInt(parts[2], 10);
        }
        const date = new Date(year, month - 1, day);
        return date.toISOString();
    }

    $("#select-order").on("change", function () {
        const value = $(this).val();
        const donnee = $(this).find(":selected").attr("data-donnee");
        const type = $(this).find(":selected").attr("data-type");
        sortTable(donnee, value, type);
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
    var filters = [];
    var indexes  = [];
    var same_type = true;
    var url = $('#metaData').data('url');
    var type_document = $('#metaData').data('type');
    var cle = $('#metaData').data('cle');
    // Prise en charge des elements dynamiques
    $(document).on('change', 'input[class="filter-checkbox"]', function() {
    // $('.filter-checkbox').on('change', function () {'
    // return;
        // Vider la section des résultats
        // $('#filtered-results').empty();

        // $('#tr-empty').hide();
        // Afficher le loader
        $('#tr-loader').show();

        //  Recuperer les valeurs des filtres
        var id = $(this).data('id');
        var colonne = $(this).data('colonne');
        var valeur = $(this).data('valeur');
        var type = $(this).data('type');
        var index = $(this).data('index');
        if (colonne == 'all') {
            // tout dechocher
            $('.filter-checkbox').prop('checked', false);
            // on coche celui qui a été cliqué
            $(this).prop('checked', true);
            // on vide le tableau
            filters = [];
            indexes = [];
        } else {
            if ($(this).is(':checked')) {
                // decocher le all
                $('#memoire-all').prop('checked', false);
                // retirer all du tableau
                filters = filters.filter(function (item) {
                    return item.colonne !== 'all';
                });
                // ajouter le nouveau filtre
                filters.push({
                    id: id,
                    colonne: colonne,
                    valeur: valeur,
                    type: type,
                });

                indexes.push({
                    id: id,
                    index: index,
                });
                // verifier si les types sont les memes
                if (indexes.length > 1) {
                    same_type = true;
                    indexes.forEach(function (item) {
                        if (item.index != index) {
                            same_type = false;
                        }
                    });
                }
            } else {
                filters = filters.filter(function (item) {
                    return item.id !== id && item.valeur !== valeur;
                });

                indexes = indexes.filter(function (item) {
                    return item.id !== id;
                });

                // Compare the first element to the rest
                if (indexes.length > 1) {
                    var tmp_index = indexes[0].index;
                    same_type = true;
                    indexes.forEach(function (item) {
                        if (item.index != tmp_index) {
                            same_type = false;
                        }
                    });
                }

                // si le tableau est vide, on coche le all
                if (filters.length == 0) {
                    $('#memoire-all').prop('checked', true);
                }
            }
        }

        // Cacher la pagination
        $('#pagination-resultat').hide();

        $('#filtre').val(JSON.stringify(filters));

        // Submit form
        $('#filterForm').submit();

        console.log(filters);

        return;

        $.ajax({
            url: '/rechercheAnnonce',
            type: 'GET',
            data: {
                filters: filters,
                type_document: type_document,
                cle: cle,
                same_type: same_type,
            },
            // success: function (data) {

            //     // console.log(data);
            //     // return;


            //     $('#tr-empty').hide();

            //     // Remettre le select order à sa valeur par défaut
            //     $('#select-order').val('');

            //     // Modifier le nombre de résultats
            //     if (data.all_data == 1) {
            //         $('#nbre-resultat').html(data.nbre_all_data + ' résultat(s)');
            //     } else {
            //         $('#nbre-resultat').html(data.documents.length + ' résultat(s)');
            //     }

            //     // Afficher la pagination si all est coche
            //     if ($('#memoire-all').is(':checked')) {
            //         $('#pagination-resultat').show();
            //     }

            //     // Verifier si le tableau est vide
            //     if (data.documents.length == 0) {
            //         $('#tr-loader').hide();
            //         $('#tr-empty').show();
            //         return;
            //     }

            //     // console.log(data);
            //     // return;

            //     // console.log(data.facettes);
            //     // Afficher les filtres tries
            //     // console.log(data.facettes[2].data);
            //     // return;

            //     // $('#facette-zone').empty();
            //     // data.facettes.forEach(function (facette) {
            //     //     // console.log(facette);
            //     //     var header = '', body = '', lign = '', footer = '';
            //     //     hasData = (Array.isArray(facette.data) && facette.data.length !== 0) ? true : false;
            //     //     header = `
            //     //         <div class="widget-boxed-header">
            //     //             <h4><i class="ti-file padd-r-10"></i>${facette['nom']}</h4>
            //     //         </div>
            //     //     `;

            //     //     if (hasData) {
            //     //         cpt = 1;
            //     //         facette.data.forEach(function (elt) {
            //     //             lign += `
            //     //                 <li style="padding: 0px; ${cpt > 5 ? 'display: none;' : ''}">
            //     //                     <span class="custom-checkbox custom-checkbox-2 d-block">
            //     //                         <input type="checkbox" id="${elt['id']}" class="filter-checkbox" data-index="${facette['index']}" data-type="${facette['type']}" data-colonne="${facette['colonne']}" data-id="${elt['id']}" data-valeur="${elt['valeur']}">
            //     //                         <label></label>
            //     //                         ${elt['valeur']} (${elt['nbre']})
            //     //                     </span>
            //     //                 </li>
            //     //             `;
            //     //             cpt++;
            //     //         });
            //     //     }

            //     //     body = `
            //     //         <div class="widget-boxed-body padd-top-10 padd-bot-0" id="facette-sub-{{ $facette['id'] }}">
            //     //             <div class="side-list">
            //     //                 <ul class="price-range" id="list-{{ $facette['id'] }}">
            //     //                     ${lign}
            //     //                 </ul>
            //     //             </div>
            //     //         </div>
            //     //     `;

            //     //     if (hasData && facette.data.length > 5) {
            //     //         footer = `
            //     //             <div class="widget-boxed-header text-center padd-top-5 padd-bot-5" id="voir-plus-zone-${facette['id']}">
            //     //                 <a href="javascript:void(0)" id="voir-plus-btn-${facette['id']}">
            //     //                     <h5>Voir plus (${facette.data.length - 5}) +</h5>
            //     //                 </a>
            //     //             </div>
            //     //         `;
            //     //     }

            //     //     element = `
            //     //         <div class="widget-boxed facette-color" id="facette-${facette['id']}" style="padding-bottom: 0px; margin-bottom: 10px;">
            //     //             ${header} ${body} ${footer}
            //     //         </div>
            //     //     `;

            //     //     if (hasData) {
            //     //         $('#facette-zone').append(element);
            //     //     }

            //     //     $(document).on('click', 'a[href="javascript:void(0)"][id="voir-plus-btn-'+ facette['id'] +'"]', function() {
            //     //         // function loadMoreData(list_id, btn_id, zone_id) {
            //     //         // loadMoreData('list-' + facette['id'], 'voir-plus-btn-' + facette['id'], 'voir-plus-zone-' + facette['id']);

            //     //     });

            //     // });



            //     data.facettes.forEach(function (facette) {
            //         // console.log(facette);
            //         $('#list-' + facette.id).empty();
            //         $('#voir-plus-zone-' + facette.id).empty();

            //         var cpt = 0;
            //         // console.log(facette.data);
            //         // return;
            //         for (var i = 0; i < facette.data.length; i++) {
            //         // facette.data.forEach(function (elt) {
            //             // console.log(elt);
            //             // console.log(elt);
            //             // console.log(cpt);

            //             var span_elt;
            //             if (cpt < 5) {
            //                 span_elt = '<li style="padding: 0px;">';
            //             } else {
            //                 span_elt = '<li style="padding: 0px; display: none;">';
            //             }

            //             isChecked = false;
            //             find = false;
            //             if(data.filtres) {
            //                 for(var j = 0; j < data.filtres.length; j++) {
            //                     // console.log("++++++++++++++" + data.filtres[j].id);
            //                     // console.log("==============" + facette.data[0].valeur);
            //                     for (var k = 0; k < facette.data.length; k++) {
            //                         if(data.filtres[j].id == facette.data[k].valeur) {
            //                             isChecked = true;
            //                             find = true;
            //                             break;
            //                         }
            //                     }

            //                     if (find) {
            //                         break;
            //                     }
            //                 }
            //             }

            //             var element = null;
            //             if (isChecked) {
            //                 element = span_elt + `
            //                     <span class="custom-checkbox custom-checkbox-2 d-block">
            //                         <input type="checkbox" checked id="` + facette.data[i].id + `" class="filter-checkbox" data-index="` + facette.index + `" data-type="` + facette.type + `" data-colonne="` + facette.colonne + `" data-id="` + facette.data[i].id + `" data-valeur="` + facette.data[i].valeur + `">
            //                             <label></label>
            //                             ` + facette.data[i].valeur + `  (` + facette.data[i].nbre + `)
            //                         </span>
            //                     </li>
            //                 `; 
            //             } else {
            //                 element = span_elt + `
            //                         <span class="custom-checkbox custom-checkbox-2 d-block">
            //                             <input type="checkbox" id="` + facette.data[i].id + `" class="filter-checkbox" data-index="` + facette.index + `" data-type="` + facette.type + `" data-colonne="` + facette.colonne + `" data-id="` + facette.data[i].id + `" data-valeur="` + facette.data[i].valeur + `">
            //                             <label></label>
            //                             ` + facette.data[i].valeur + `  (` + facette.data[i].nbre + `)
            //                         </span>
            //                     </li>
            //                 `;
            //             }
            //             // console.log(element);
                        
            //             if(i==2) {
            //                 console.log(element);
            //             }

            //             $('#list-' + facette.id).append(element);
            //             cpt++;
            //         }


            //         var voir_plus = '';
            //         if (facette.data.length > 5) {
            //             voir_plus = `
            //                 <a href="javascript:void(0)" id="voir-plus-btn-` + facette['id'] + `">
            //                     <h5>Voir plus (` + (facette.data.length - 5) + `) +</h5>
            //                 </a>                        
            //             `;
            //             $('#voir-plus-zone-' + facette.id).append(voir_plus);
            //         } else {
            //             $('#voir-plus-zone-' + facette.id).hide();

            //         }
                    
            //         cpt = 1;
            //     });


            //     data.documents.forEach(function (document) {
            //         var valeurs = [];
            //         document.sujets.forEach(function (sujet) {
            //             valeurs.push(sujet.valeur + ' ');
            //         });

            //         var favori = '';

            //         if (document.connected == 1) {
            //             if (document.favori == 1) {
            //                 favori = `
            //                     <a href="javascript:void(0)" id="f-0" class="favoris orange-color favoris-` + document.id + `" data-id="` + document.id + `" data-url="` + document.url + `" data-token="` + document.token + `">
            //                         <i class="favoris fa fa-heart orange-color favoris-` + document.id + `" aria-hidden="true"></i>
            //                         Favoris
            //                     </a>
            //                 `;
            //             } else {
            //                 favori = `
            //                     <a href="javascript:void(0)" id="f-0" class="favoris favoris-` + document.id + `" data-id="` + document.id + `" data-url="` + document.url + `" data-token="` + document.token + `">
            //                         <i class="favoris fa fa-heart favoris-` + document.id + `" aria-hidden="true"></i>
            //                         Favoris
            //                     </a>
            //                 `;
            //             }
            //         } else {
            //             favori = `
            //                 <a href="javascript:void(0)" data-toggle="modal" data-target="#signin">
            //                     <i class="color fa fa-heart"aria-hidden="true"></i>
            //                     Favoris
            //                 </a>
            //             `;
            //         }

            //         var filter_element = `
            //             <tr id="row-` + document.id + `">
            //                 <td style="background-color: white; padding: 0px;" data-titre="` + document.titre + `" data-auteur="` + document.auteur + `" data-date="` + document.date_soutenance + `">
            //                     <div class="verticleilist listing-shot facette-color" style="margin: 0px; margin-bottom: 15px; border-color: #BDD8DC;">
            //                         <a class="listing-item" href="` + document.lien_detail + `">
            //                             <div class="listing-shot-img">
            //                                 <img src="` + document.chemin_image + `" width="200" height="200" class="img-responsive" height="90%" alt="">
            //                             </div>
            //                         </a>
            //                         <div class="verticle-listing-caption">
            //                             <div class="listing-shot-caption">
            //                                 <a href="` + document.lien_detail + `">
            //                                     <h4>` + document.titre + `</h4>
            //                                 </a>
            //                                 <span>
            //                                     <strong>Par </strong>: ` + document.auteur + `
            //                                 </span>
            //                             </div>
            //                             <div class="listing-shot-info">
            //                                 <div class="row extra">
            //                                     <div class="col-md-12">
            //                                         <div class="listing-detail-info">
            //                                             <span style="font-weight: bold;">
            //                                                 ` + document.niveau_etude + `
            //                                             </span>
            //                                             <span>
            //                                                 <p class="listing-description">
            //                                                     ` + document.resume.substring(0, 100) + ` ...
            //                                                 </p>
            //                                             </span>
            //                                             <span>
            //                                                 <strong>Date de soutenance</strong>: ` + document.date_soutenance + `
            //                                             </span>
            //                                             <span>
            //                                                 <strong>Sujet</strong>: ` + valeurs + `
            //                                             </span>
            //                                         </div>
            //                                     </div>
            //                                 </div>
            //                             </div>

            //                             <div class="listing-shot-info rating">
            //                                 <div class="row extra">
            //                                     <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important;">
            //                                         ` + favori + `
            //                                     </div>
            //                                     <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important;">
            //                                         <a href="javascript:void(0)" class="">
            //                                             <i class="color fa fa-share" aria-hidden="true"></i>
            //                                             Exporter
            //                                         </a>
            //                                     </div>
            //                                     <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important;">
            //                                         <a href="javascript:void(0)" class="">
            //                                             <i class="color fa fa-share-alt" aria-hidden="true"></i>
            //                                             Partager
            //                                         </a>
            //                                     </div>
            //                                     <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important; padding: 0px !important;">
            //                                         <a href="javascript:void(0)" class="">
            //                                             <i class="color fa fa-star" style="" aria-hidden="true"></i>
            //                                             Demander
            //                                         </a>
            //                                     </div>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </td>
            //                 <td style="vertical-align: middle; padding: 0px;">
            //                     <span class="custom-checkbox custom-checkbox-1" style="width: 5px; margin: 0px;">
            //                         <input type="checkbox" class="checkbox_table text-right" name="options[]" value="1" style=" margin-left: 5px;">
            //                         <label class="text-center" for="checkbox1" style="margin: 0px; margin-left: 5px;"></label>
            //                     </span>
            //                 </td>
            //             </tr>
            //         `;

                    
            //         // append avec animation
            //         $('#filtered-results').append(filter_element).hide().fadeIn(500);
            //         // Cacher le loader
                    
            //         $('#tr-loader').hide();
            //     });
            // },
            // error: function () {
            //     $('#tr-loader').hide();

            //     alert('Une erreur est survenue.');
            // }
        });
    });

});
