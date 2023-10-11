@extends('layout_client.app')

{{-- @section('content_class') --}}

@section('css')
    <!-- Common Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="wrapper">
        <!-- Start Navigation -->
        @include('layout_client.navbar')
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- ================ Start Page Title ======================= -->
        <section class="title-transparent page-title" style="background-image:url(/assets_client/img/bibioteque_1200x680_bibl.jpg);" data-overlay="8">
            <div class="container">
                <div class="banner-caption">
                    <div class="col-md-12 col-sm-12 banner-text">
                        @include('layout_client.search-form')
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- ================ End Page Title ======================= -->

        <!-- ================ Listing In Vertical style with Sidebar ======================= -->
        <section class="show-case">
            <div class="container">
                <div class="row">
                    <!-- End Start Sidebar -->
                    <div class="col-md-1"></div>

                    <div class="col-md-10 col-sm-12">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="#" onclick="window.history.back(); return false;" title="Revenir à la recherche">
                                    <i class="fa fa-fw fa-undo" aria-hidden="true" style="font-size: 25px;"></i>
                                </a>
                            </div>
                            <div class="col-md-8">
                                <h4 class="text-center">Détail de document</h4>
                            </div>
                            <div class="col-md-1">
                                <a href="#" title="Document précédent">
                                    <i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 25px;"></i>
                                </a>
                            </div>
                            <div class="col-md-1">
                                <a href="#" title="Document suivant">
                                    <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 25px;"></i>
                                </a>
                            </div>

                        </div>

                        <style>
                            .facette-color {
                                background-color: #DFF3FE;
                            }
                        </style>

                        <div class="row">
                            <div class="verticleilist listing-shot facette-color">
                                <a class="listing-item" href="javascript:void(0)">
                                    <div class="listing-shot-img">
                                        @if ($document->image)
                                            <img src="{{ asset($document->image->chemin) }}" width="800px" height="700px" class="img-responsive" height="90%" alt="">
                                        @else
                                            <img src="http://via.placeholder.com/800x800" class="img-responsive" height="90%" alt="">
                                        @endif
                                    </div>
                                </a>
                                <div class="verticle-listing-caption">
                                    <div class="listing-shot-caption">
                                        <h4>{{ $document->titre }}</h4>
                                        <span>
                                            <strong>Par </strong>: {{ $document->auteur }}
                                        </span>
                                    </div>
                                    <div class="listing-shot-info">
                                        <div class="row extra" style="height: 110px;">
                                            <div class="col-md-12">
                                                <div class="listing-detail-info">
                                                    <span style="font-weight: bold;">
                                                        @if ($document->memoire->ref_niveau_etude)
                                                            {{ $document->memoire->ref_niveau_etude->valeur }}
                                                        @endif
                                                    </span>
                                                    <span>
                                                        <p class="listing-description">
                                                            {{-- <strong>Resume</strong> : --}}
                                                            {{ $document->resume }}
                                                        </p>
                                                    </span>
                                                    <span>
                                                        <strong>Date de soutenance</strong>: {{ date('d/m/Y', strtotime($document->date_soutenance)) }}
                                                    </span>
                                                    <span>
                                                        <strong>Sujet</strong>:
                                                        @foreach ($document->ref_sujet as $ref_sujet)
                                                            {{ $ref_sujet->sujet->valeur }} ,
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">Fichier et aperçu</h5>
                                </div>
                                {{-- <div class="verticleilist listing-shot" style="height: 1000px;"> --}}
                                @if (!$document->fichiers->isEmpty())
                                    <iframe style="height: 1000px;" src="{{ asset($document->fichiers[0]->fichier->chemin) }}" width="100%" height="500px"></iframe>
                                @else
                                    <h4 style="margin: 20px; margin-top: 40px;">PAS DE FICHIER</h4>
                                @endif
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1"></div>


                </div>
            </div>
        </section>
        <!-- ================ End Listing In Vertical style with Sidebar ======================= -->

        <!-- ================ Start Footer ======================= -->
        @include('layout_client.footer')
        <!-- ================ End Footer Section ======================= -->

        @include('layout.connexion_modal')

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

    <script>
        $(document).ready(function() {
            $('#btn-register').click(function() {
                $('#signin').modal('hide');

                setTimeout(function() {
                    $('#register').modal('show');
                }, 500);
            });

            $('#btn-login').click(function() {
                $('#register').modal('hide');

                // Attendre une seconde avant d'afficher le modal
                setTimeout(function() {
                    $('#signin').modal('show');
                }, 500);
            });
        });
    </script>


    {{--   <script>
    $(document).ready(function() {
        // Détecter les changements d'état des cases à cocher
        $('input[type="checkbox"]').on('change', function() {
            // Récupérer les valeurs des cases à cocher sélectionnées
            var filters = [];
            $('input[type="checkbox"]:checked').each(function() {
                filters.push($(this).data('nom'));


            });

            // Envoyer une requête AJAX pour récupérer les résultats filtrés
            $.ajax({
                url: '/filtereAnnonce/'+filters,
                method: 'GET',
                /* data: {
                    filters: filters
                    alert(filters);

                }, */

            dataType: 'json',
                success: function(data) {
                    alert(data);
                    // Mettre à jour la section pour afficher les résultats filtrés
                    $('#filtered-results').html(data);
                }
            });
        });
    });
</script> --}}

    <script>
        $(document).ready(function() {
            $('.element_checkbox').on('change', function() {

                if ($(this).is(':checked')) {
                    var filters = $(this).data('nom');
                    //var element_id = $(this).data('nom');
                    //alert(element_id);
                    $.ajax({
                        url: '/filtereAnnonce/' + filters,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            //  for(var i = 0; i < data.details.length; i++)
                            //  {

                            //alert(textdetail);
                            /*  $('#element_details').html(data.details + data.detailsboites +data.detailslogements+ data.detailsbars+
                             data.detailslocations+data.detailsfastfoods+data.detailspatisseries+data.detailsauberges); */

                            // }
                            $('#filtered-results').html(data);

                            //alert(data.detailsboites);
                        },
                        error: function() {
                            alert('Une erreur est survenue.');
                        }
                    });
                } else {
                    $('#filtered-results').empty();
                }
            });
        });
    </script>
@endsection
