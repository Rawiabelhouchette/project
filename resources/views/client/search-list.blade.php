@extends('layout_client.app')

{{-- @section('content_class') --}}

@section('css')
    <!-- Common Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />


    <style>
        .custom-checkbox-1 input[type="checkbox"]:checked+label:after {
            left: 11px;
        }

        .custom-checkbox-2 input[type="checkbox"]:checked+label:after {
            top: 5px;
        }

        .facette-color {
            background-color: #DFF3FE;
        }

        /* Spinner */
        .lds-dual-ring {
            display: inline-block;
            width: 40px;
            height: 40px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 24px;
            height: 24px;
            margin: 8px;
            border-radius: 50%;
            border: 4px solid #EA4F0C;
            border-color: #EA4F0C transparent #EA4F0C transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        @include('layout_client.navbar')
        <div class="clearfix"></div>

        <section class="title-transparent page-title" style="background-image:url(/assets_client/img/bibioteque_1200x680_bibl.jpg);" data-overlay="8" style="padding-bottom: 0px;">
            <div class="container">
                <div class="banner-caption">
                    <div class="col-md-12 col-sm-12 banner-text">
                        @include('layout_client.search-form')
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="clearfix"></div>

    <input type="hidden" id="metaData" data-url="{{ route('document.search') }}" data-type="{{ $type }}" data-cle="{{ $cle }}">
    <section class="show-case">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <h4 class="text-center mrg-bot-15">Filtrer vos recherches</h4>
                    @if ($filtres_list)
                        <a href="javascript:void(0)" id="filtre-reset">
                            <h4 class="text-center mrg-bot-10">
                                <span class="badge height-25" style="background-color: #EA4F0C">
                                    x Effacer tous les filtres
                                </span>
                            </h4>
                        </a>
                    @endif

                    <div class="sidebar" id="facette-zone">
                        <form style="padding: 0px; margin: 0px;" id="filterForm" method="GET" action="{{ route('rechercheAnnonce') }}">
                            @foreach ($facettes as $facette)
                                @if ($facette['data'])
                                    <div class="widget-boxed facette-color" id="facette-{{ $facette['id'] }}" style="padding-bottom: 0px; margin-bottom: 10px;">
                                        <div class="widget-boxed-header">
                                            <h4><i class="{{ $facette['icon'] }} padd-r-10"></i>{{ $facette['nom'] }}</h4>
                                        </div>
                                        <div class="widget-boxed-body padd-top-10 padd-bot-0" id="facette-sub-{{ $facette['id'] }}">
                                            <div class="side-list">
                                                <ul class="price-range" id="list-{{ $facette['id'] }}">
                                                    @foreach ($facette['data'] as $key => $data)
                                                        <li style="padding: 0px; display: none;">
                                                            <span class="custom-checkbox custom-checkbox-2 d-block">
                                                                <input type="checkbox" {{ $data['isChecked'] ? 'checked' : '' }} id="{{ $data['slug'] }}" data-slug={{ $data['slug'] }} class="filter-checkbox" data-index="{{ $facette['index'] }}" data-type="{{ $facette['type'] }}" data-colonne="{{ $facette['colonne'] }}" data-id="{{ $data['id'] }}" data-valeur="{{ $data['valeur'] }}">
                                                                <label></label>
                                                                {{ $data['valeur'] }} ({{ $data['nbre'] }})
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        @if (count($facette['data']) > 5)
                                            <div class="widget-boxed-header text-center padd-top-5 padd-bot-5" id="voir-plus-zone-{{ $facette['id'] }}">
                                                <a href="javascript:void(0)" id="voir-plus-btn-{{ $facette['id'] }}">
                                                    <h5>Voir plus ({{ count($facette['data']) - 5 }}) +</h5>
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                @endif
                            @endforeach
                            <input type="hidden" name="type_document" id="type_document" value="{{ $type }}">
                            <input type="hidden" name="mot_cle" id="mot_cle" value="{{ $cle }}">
                            <input type="hidden" name="filtres" id="filtres" value="{{ $filtres }}">
                            <input type="hidden" name="filtre" id="filtre">
                            <input type="hidden" name="tri" id="tri-document" value="{{ $tri }}">
                        </form>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="card">
                        @if ($filtres_list)
                            <div class="card-header">
                                <div class="col-md-12" style="margin-left: 0px; padding-left: 0px;">
                                    Recherche :
                                    @foreach ($filtres_list as $element)
                                        <span class="badge height-25" style="background-color: #EA4F0C">
                                            {{ $element['valeur'] }}
                                            <a href="javascript:void(0)" class="filtre" data-slug="{{ $element['slug'] }}" style="color: #35434E"> x </a>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="card-header" style="padding: 0px;">
                            <div class="col-md-4" style=" margin-top: 10px !important;">
                                <span style="font-size: 15px;" id="nbre-resultat">
                                    {{ $nbreResultat }} résultats
                                </span>
                            </div>
                            <div class="col-md-8 text-right" id="pagination-resultat">
                                {{ $paginator->appends(['filtre' => '', 'filtres' => $filtres])->links() }}
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="col-md-3" style="margin-left: 0px; padding-left: 0px;">
                                <select class="form-control" id="select-order" style="height: 35px !important; margin-bottom: 0px;" tabindex="-98">
                                    <option value="">Trier</option>
                                    <option value="titre-asc" data-type="document" data-colonne="titre" data-ordre="asc">Titre: A à Z</option>
                                    <option value="titre-desc" data-type="document" data-colonne="titre" data-ordre="desc">Titre: Z à A</option>
                                    <option value="auteur-asc" data-type="document" data-colonne="auteur" data-ordre="asc">Auteur: A à Z</option>
                                    <option value="auteur-desc" data-type="document" data-colonne="auteur" data-ordre="desc">Auteur: Z à A</option>
                                    <option value="date-asc" data-type="memoire" data-colonne="date_soutenance" data-ordre="asc">Date de soutenance: A à Z</option>
                                    <option value="date-desc" data-type="memoire" data-colonne="date_soutenance" data-ordre="desc">Date de soutenance: Z à A</option>
                                </select>
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-3" style="margin-right: 0px;">
                                <form id="action-form" action="{{ route('effectuer-action') }}" method="POST">
                                    @csrf
                                <select class="form-control" name="action" id="send-email" style="height: 35px !important; margin-bottom: 0px;" tabindex="-98">
                                    <option value=" ">Action</option>
                                    <option value="export-pdf">Exporter la liste des résultats en pdf</option>
                                    <option value="25">Mettre dans les favoris</option>
                                    <option value="imprimer">Imprimer</option>
                                    <option value="envoi-mail" >Envoyer par mail</option>
                                </select></form>

                            </div>
                            <div class="col-md-1 text-right" style="vertical-align: middle; margin-right: 0px;">
                                <span class="custom-checkbox" style="">
                                    <input type="checkbox" class="checkbox_table" name="options[]" value="1">
                                    <label for="checkbox1"></label>
                                </span>
                            </div>
                        </div>

                        <div class="card-body" style="padding-right: 0px;">
                            <div class="table-responsive">

                                <h5 id="tr-loader" class="text-center" style="display: none;">
                                    <div class="lds-dual-ring"></div>
                                </h5>
                                <h5 id="tr-empty" style="display: none;" class="text-center">Aucun résultat trouvé</h5>

                                <table id="datatable">

                                    <tbody id="filtered-results">
                                        @foreach ($documents as $document)
                                            <tr id="row-{{ $document->id }}">
                                                <td style="background-color: white; padding: 0px;" data-titre="{{ $document->titre }}" data-auteur="{{ $document->auteur }}" data-date="{{ $document->memoire->date_soutenance }}">
                                                    <div class="verticleilist listing-shot facette-color" style="margin: 0px; margin-bottom: 15px; border-color: #BDD8DC;">
                                                        <a class="listing-item" href="{{ route('detailMemoire', ['id' => $document->id]) }}">
                                                            <div class="listing-shot-img">
                                                                @if ($document->image_id)
                                                                    <img src="{{ asset($document->image->chemin) }}" width="200" height="200" class="img-responsive" height="90%" alt="">
                                                                @else
                                                                    <img src="http://via.placeholder.com/800x850" class="img-responsive" height="90%" alt="">
                                                                @endif
                                                            </div>
                                                        </a>
                                                        <div class="verticle-listing-caption">
                                                            <div class="listing-shot-caption">
                                                                <a href="{{ route('detailMemoire', ['id' => $document->id]) }}">
                                                                    <h4>{{ $document->titre }}</h4>
                                                                </a>
                                                                <span>
                                                                    <strong>Par </strong>: {{ $document->auteur }}
                                                                </span>
                                                            </div>
                                                            <div class="listing-shot-info">
                                                                <div class="row extra">
                                                                    <div class="col-md-12">
                                                                        <div class="listing-detail-info">
                                                                            <span style="font-weight: bold;">
                                                                                @if ($document->memoire->niveau_etude)
                                                                                    {{ $document->memoire->ref_niveau_etude->valeur }}
                                                                                @endif
                                                                            </span>
                                                                            <span>
                                                                                <p class="listing-description">
                                                                                    {{ substr($document->resume, 0, 100) }}...
                                                                                </p>
                                                                            </span>
                                                                            <span>
                                                                                @if ($document->type == 'Mémoire')
                                                                                    <strong>Date de soutenance</strong>: {{ date('d/m/Y', strtotime($document->memoire->date_soutenance)) }}
                                                                                @endif
                                                                            </span>
                                                                            <style>
                                                                                a.sujet:hover {
                                                                                    color: #EA4F0C;
                                                                                }
                                                                            </style>
                                                                            <span>
                                                                                <strong>Sujet</strong>:
                                                                                @foreach ($document->ref_sujet as $sujet)
                                                                                    <a href="javascript:void(0)" class="sujet" data-id="{{ $sujet->sujet->id }}">
                                                                                        {{ $sujet->sujet->valeur }}
                                                                                    </a> ,
                                                                                @endforeach
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="listing-shot-info rating">
                                                                <div class="row extra">
                                                                    <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important;">
                                                                        @if (Auth::check())
                                                                            @if ($document->favori)
                                                                                <a href="javascript:void(0)" id="f-0" class="favoris orange-color favoris-{{ $document->id }}" data-id="{{ $document->id }}" data-url="{{ route('favoris.store') }}" data-token="{{ csrf_token() }}">
                                                                                    <i class="color fa fa-heart" class="orange-color favoris-{{ $document->id }}" aria-hidden="true"></i>
                                                                                    Favoris
                                                                                </a>
                                                                            @else
                                                                                <a href="javascript:void(0)" id="f-0" class="favoris favoris-{{ $document->id }}" data-id="{{ $document->id }}" data-url="{{ route('favoris.store') }}" data-token="{{ csrf_token() }}">
                                                                                    <i class="color fa fa-heart" class="favoris-{{ $document->id }}" aria-hidden="true"></i>
                                                                                    Favoris
                                                                                </a>
                                                                            @endif
                                                                        @else
                                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#signin">
                                                                                <i class="favoris color fa fa-heart"aria-hidden="true"></i>
                                                                                Favoris
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important;">
                                                                        <a href="javascript:void(0)" class="">
                                                                            <i class="color fa fa-share" aria-hidden="true"></i>
                                                                            Exporter
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important;">
                                                                        <a href="javascript:void(0)" class="">
                                                                            <i class="color fa fa-share-alt" aria-hidden="true"></i>
                                                                            Partager
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 col-xs-6" style="margin: 0px !important; padding: 0px !important;">
                                                                        <a href="javascript:void(0)" class="">
                                                                            <i class="color fa fa-star" style="" aria-hidden="true"></i>
                                                                            Demander
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle; padding: 0px;">
                                                    <span class="custom-checkbox custom-checkbox-1" style="width: 5px; margin: 0px;">
                                                        <input type="checkbox" class="checkbox_table text-right" name="options[]" value="1" style=" margin-left: 5px;">
                                                        <label class="text-center" for="checkbox1" style="margin: 0px; margin-left: 5px;"></label>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if ($documents->isEmpty())
                                            <h5 class="text-center">Aucun résultat trouvé</h5>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- <div class="col-md-6">
                    {{ $documents->appends(['type_document' => $type, 'mot_cle' => $cle])->links(null, ['onEachSide' => 1, 'paginatorRange' => 2]) }}
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ================ End Listing In Vertical style with Sidebar ======================= -->

    <!-- ================ Start Footer ======================= -->
    @include('layout_client.footer')
    <!-- ================ End Footer Section ======================= -->

    <!-- ================== Login & Sign Up Window ================== -->
    @include('layout.connexion_modal')
    <!-- ===================== End Login & Sign Up Window =========================== -->

    @include('layout_client.scroller')


    </div>
@endsection

@section('js')
    @error('username')
        <script>
            $(document).ready(function() {
                $('#signin').modal('show');
            });
        </script>
    @enderror
    <script src="{{ asset('custom/js/search-list.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>

    {{-- <script>
        // Attendre que la page soit complètement chargée
        document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner l'élément select
            var printOptionSelect = document.getElementById('send-email');

            // Écouter les changements de sélection
            printOptionSelect.addEventListener('change', function() {
                // Obtenir la valeur sélectionnée
                var selectedValue = printOptionSelect.value;

                // Soumettre automatiquement le formulaire lorsque l'option est sélectionnée
                if (selectedValue !== '') {
                    document.getElementById('datatable-form').submit();
                }
            });
        });
    </script> --}}

    <script>
        document.getElementById('send-email').addEventListener('change', function() {
            var selectedAction = this.value;

            if (selectedAction === 'imprimer') {
                window.print();
            } else if (selectedAction === 'envoi-mail') {
                // Code pour envoyer par courrier électronique
                var documents = []; // Récupérez les données du datatable
                var dataTable = document.getElementById('datatable');
var dataTableData = [];

// Parcours des lignes du tableau
for (var i = 0; i < dataTable.rows.length; i++) {
    var row = dataTable.rows[i];
    var rowData = [];

    // Parcours des cellules de chaque ligne
    for (var j = 0; j < row.cells.length; j++) {
        var cell = row.cells[j];
        rowData.push(cell.textContent);
    }

    dataTableData.push(rowData);
}

//console.log(dataTableData);

                //var dataTable = $('#datatable').DataTable();
                //alert('dataTable');
           // var documents = dataTable.rows().data().toArray();
 alert(dataTableData);

            var form = document.getElementById('action-form');
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'data';
            input.value = JSON.stringify(dataTableData);
            form.appendChild(input);
            form.submit();
            } else if (selectedAction === 'export-pdf') {
                var documents = []; // Récupérez les données du datatable
                var dataTable = $('#datatable').DataTable();
                var documents = dataTable.rows().data().toArray();
                var form = document.getElementById('action-form');
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'data';
                input.value = JSON.stringify(documents);
                form.appendChild(input);
                form.submit();
            }
        });
    </script>
        {{-- <script>
            document.getElementById('send-email').addEventListener('change', function() {
                var selectedValue = this.value;
                //alert('sertt')

                // Vérifiez si une option de fichier a été sélectionnée
                if (selectedValue == 'pdf') {
                    // Créez un élément d'ancrage (lien) dynamique
                    var link = document.createElement('a');
                    link.href = '/download/' + selectedValue; // Remplacez cette URL par celle correspondant à votre route de téléchargement
                    link.target = '_blank'; // Optionnel : ouvrez le lien dans un nouvel onglet
                    link.download = selectedValue + '.pdf'; // Nom du fichier de téléchargement

                    // Ajoutez l'élément d'ancrage à la page
                    document.body.appendChild(link);

                    // Cliquez sur l'élément d'ancrage pour déclencher le téléchargement
                    link.click();

                    // Supprimez l'élément d'ancrage de la page (facultatif)
                    document.body.removeChild(link);

                    // Réinitialisez la sélection du <select>
                    this.value = '';
                }
            });
        </script> --}}
{{-- <script>
    document.getElementById('option').addEventListener('change', function() {
        if (this.value === 'envoyer-email') {
            document.getElementById('send-email').submit();
        }
    });
</script> --}}

    <script>
        const select = document.getElementById('choix');
        select.addEventListener('change', (event) => {
            const selectedOption = event.target.value;
            // Effectuer l'action souhaitée avec la valeur sélectionnée
            // Par exemple, envoyer un e-mail en utilisant AJAX
            // Vous pouvez appeler une fonction JavaScript ou effectuer une requête AJAX ici
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            var selectedAction = '';

            // Initialisation du DataTable
            var datatable = $('#datatable').DataTable();
            alert('allo');
            // Événement de changement du sélecteur d'action
            $('#send-email').change(function() {
                selectedAction = $(this).val();
            });

            // Événement de clic sur le bouton du DataTable
            $('#datatable tbody').on('click', 'tr', function() {
                // Vérifie si une action est sélectionnée
                if (selectedAction !== '') {
                    var data = datatable.row(this).data();
                    var element = data[0]; // Modifier l'indice si nécessaire

                    if (selectedAction === 'envoyer-email') {
                        // Envoi de l'élément par e-mail
                        envoyerElementParEmail(element);
                    }

                    selectedAction = ''; // Réinitialise l'action sélectionnée
                }
            });

            // Fonction d'envoi de l'élément par e-mail
            function envoyerElementParEmail(element) {
                $.ajax({
                    url: '/envoyer-email',
                    method: 'POST',
                    data: {
                        element: element
                    },
                    success: function(response) {
                        alert(response.message);

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script> --}}
@endsection
