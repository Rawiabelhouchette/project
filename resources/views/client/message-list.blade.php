@extends('layout_client.app')

{{-- @section('content_class') --}}

@section('css')
    <!-- Common Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <!-- Start Sidebar -->
                    <div class="col-md-3 col-sm-12">
                        <div class="sidebar">
                            <!-- Start: Search By Price -->
                            <div class="widget-boxed facette-color" style="padding-bottom: 0px;">
                                {{-- <div class="widget-boxed-header">
                                    <h4><i class="ti-money padd-r-10"></i>Top Categories</h4>
                                </div> --}}

                                <div class="widget-boxed-body padd-top-10 padd-bot-0">
                                    <div class="side-list">
                                        <ul class="price-range">
                                            @if (auth()->check())
                                                <li>
                                                    <a href="{{ route('profil.index') }}">
                                                        <span class="custom-checkbox d-block" style="font-size: 18px;">
                                                            <i class="fa-solid fa-user"></i> &nbsp;
                                                            Mon profil
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('messages.index') }}">
                                                    <span class="custom-checkbox d-block orange-color" style="font-size: 18px;">
                                                        <i class="fa-solid fa-comment"></i> &nbsp;
                                                        Message
                                                    </span>
                                                </a>
                                            </li>
                                            @if (auth()->check())
                                                <li>
                                                    <a href="{{ route('favoris.index') }}">
                                                        <span class="custom-checkbox d-block" style="font-size: 18px;">
                                                            <i class="fa-solid fa-star"></i> &nbsp;
                                                            Favoris
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Start Sidebar -->
                    <div class="col-md-9 col-sm-12">
                        <div class="card">
                            <div class="card-header facette-color">
                                <div class="col-md-6 text-left">
                                    <h4>
                                        <i class="fa fa-list" style="font-size: 15px;"></i> &nbsp;Liste des messages
                                    </h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('messages.create') }}">
                                        <h4 class="orange-color">
                                            <i class="fa fa-plus orange-color" style="font-size: 15px;"></i>
                                            Ecrire
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            <div class="card-header" style="margin: 0px; padding: 0px;">
                                <div class="col-md-2 text-left" style="margin-top: 10px;">
                                    {{ $messages->total() }} message(s)
                                </div>
                                <div class="col-md-6 text-center">
                                    <input type="text" value="" class="form-control" id="filterInput" placeholder="Afficher la recherche" style="margin-top: 6px; margin-bottom: 6px; height: 35px;">
                                </div>
                                <div class="col-md-4 text-right" style="margin: 0px; padding: 0px;">
                                    {{ $messages->links() }}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Motif</th>
                                                            <th>Date d'envoi</th>
                                                            <th>Date de reponse</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($messages as $message)
                                                            <tr>
                                                                <td>{{ $message->id }}</td>
                                                                <td>
                                                                    @if ($message->motif)
                                                                        {{ $message->getMotif->valeur }}
                                                                    @else
                                                                        {{ $message->autre_motif }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $message->created_at->format('d-m-Y') }}</td>
                                                                <td>
                                                                    @if ($message->reponse == null)
                                                                        <span class="badge badge-danger">Pas de reponse</span>
                                                                    @else
                                                                        {{ $message->updated_at->format('d-m-Y') }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('messages.show', $message->id) }}">
                                                                        <i class="fa fa-eye" style="color: gray; font-size: 17px;"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        <tr id="noResultsRow" style="display: none;">
                                                            <td colspan="5" class="text-center">Aucun résultat trouvé.</td>
                                                        </tr>

                                                        @if ($messages->count() == 0)
                                                            <tr>
                                                                <td colspan="6" class="text-center">
                                                                    <h5>Aucun message</h5>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <!-- ===================== End Login & Sign Up Window =========================== -->

        @include('layout_client.scroller')


    </div>
@endsection

@section('js')
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

    <script>
        $(document).ready(function() {
            $('#filterInput').on('input', function() {
                var filterValue = $(this).val().toLowerCase(); // Obtient la valeur saisie et la convertit en minuscules
                var rows = $('#table tbody tr'); // Sélectionne toutes les lignes du tableau
                var noResultsRow = $('#noResultsRow'); // Sélectionne la ligne pour les résultats vides

                // Parcourt toutes les lignes du tableau et les affiche ou les cache en fonction du filtre
                var foundResults = false;
                rows.each(function() {
                    var message = $(this).find('td').text().toLowerCase(); // Obtient le contenu de la colonne "Message" en minuscules

                    if (message.includes(filterValue)) {
                        $(this).show(); // Affiche la ligne si le message correspond au filtre
                        foundResults = true;
                    } else {
                        $(this).hide(); // Cache la ligne si le message ne correspond pas au filtre
                    }
                });

                // Affiche ou cache la ligne pour les résultats vides en fonction du statut
                if (foundResults) {
                    noResultsRow.hide();
                } else {
                    noResultsRow.show();
                }
            });

        });
    </script>
@endsection
