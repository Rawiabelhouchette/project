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
                                                    <span class="custom-checkbox d-block" style="font-size: 18px;">
                                                        <i class="fa-solid fa-comment"></i> &nbsp;
                                                        Message
                                                    </span>
                                                </a>
                                            </li>
                                            @if (auth()->check())
                                                <li>
                                                    <a href="{{ route('favoris.index') }}">
                                                        <span class="custom-checkbox d-block orange-color" style="font-size: 18px;">
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
                                        <i class="fa fa-list" style="font-size: 15px;"></i> &nbsp;Liste des favoris
                                    </h4>
                                </div>
                                <div class="col-md-6 text-right"></div>
                            </div>
                            <div class="card-header" style="margin: 0px; padding: 0px;">
                                <div class="col-md-2 text-left" style="margin-top: 10px;">
                                    <span id="nbre-favoris">{{ $favoris->total() }}</span> favoris
                                </div>
                                <div class="col-md-6 text-center">
                                    <input type="text" value="" class="form-control" id="filterInput" placeholder="Afficher la recherche" style="margin-top: 6px; margin-bottom: 6px; height: 35px;">
                                </div>
                                <div class="col-md-4 text-right" style="margin: 0px; padding: 0px;">
                                    {{ $favoris->links() }}
                                </div>
                            </div>

                            <div class="card-body padd-l-0 padd-r-0">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="small-list-wrapper">
                                                <ul id="table">
                                                    @foreach ($favoris as $favori)
                                                        <li id="element-{{ $favori->document->id }}">
                                                            <div class="small-listing-box light-gray">
                                                                <div class="small-list-img">
                                                                    <a href="{{ route('detailMemoire', ['id' => $favori->document_id]) }}">
                                                                        @if ($favori->document->image_id)
                                                                            <img src="{{ asset($favori->document->image->chemin) }}" class="img-responsive" alt="" />
                                                                        @else
                                                                            <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="" />
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="small-list-detail">
                                                                    <a href="{{ route('detailMemoire', ['id' => $favori->document_id]) }}">
                                                                        <h5 title="{{ $favori->document->titre }}">{{ strlen($favori->document->titre) > 70 ? substr($favori->document->titre, 0, 70) . '...' : $favori->document->titre }}</h5>
                                                                    </a>
                                                                    <p class="mrg-bot-0">Par : <a href="javascript:void(0)">{{ $favori->document->auteur }}</a></p>
                                                                    <p>Sujet :
                                                                        <a href="#" title="Food & restaurant">
                                                                            @foreach ($favori->document->ref_sujet as $key => $sujet)
                                                                                {{ $sujet->sujet->valeur }} ,
                                                                                @php
                                                                                    if ($key == 2) {
                                                                                        echo '...';
                                                                                        break;
                                                                                    }
                                                                                @endphp
                                                                            @endforeach
                                                                        </a> | <span>{{ $favori->created_at->format('d-m-Y') }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="small-list-action">
                                                                    <a href="{{ route('detailMemoire', ['id' => $favori->document_id]) }}" class="light-gray-btn btn-square"><i class="ti-eye"></i></a>
                                                                    <a href="javascript:void(0)" class="light-red-btn btn-square" data-id="{{ $favori->document->id }}" data-url="{{ route('favoris.store') }}" data-token="{{ csrf_token() }}"><i class="ti-trash"></i></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                    @if ($favoris->count() == 0)
                                                        <li class="text-center">
                                                            <h5>Aucun élément</h5>
                                                        </li>
                                                    @endif
                                                </ul>
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
        // TRIER LES RESULTATS
        $(document).ready(function() {
            $('#filterInput').on('input', function() {
                var searchValue = $(this).val().toLowerCase();
                $('#table li').each(function() {
                    var title = $(this).find('h5').text().toLowerCase();
                    var lien = $(this).find('a').text().toLowerCase();
                    var span = $(this).find('span').text().toLowerCase();
                    if (title.includes(searchValue) || lien.includes(searchValue) || span.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

    <script>
        // Favoris MANAGEMENT
        $(document).ready(function() {
            $('.light-red-btn').on('click', function() {
                var id = $(this).data('id');
                var url = $(this).data('url');
                var token = $(this).data('token');
                var element = $(this);
                // Demander confirmation avant suppression
                if (!confirm('Voulez-vous vraiment supprimer cet élément ?')) {
                    return false;
                }
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        // remove class "orange-color"
                        $('#element-' + data.id).remove();
                        // recupperer le nombre de favoris avec l'id nbre-favoris - 1
                        var nbreFavoris = parseInt($('#nbre-favoris').text()) - 1;
                        $('#nbre-favoris').text(nbreFavoris);


                        // $('.favoris-' + data.id).removeClass('orange-color');
                        // if (data.is_favoris == 1) {
                        //     $('.favoris-' + data.id).css('color', '#EA4F0C');
                        // } else {
                        //     $('.favoris-' + data.id).css('color', '#334E6F');
                        // }
                    },
                    error: function() {
                        alert('Une erreur est survenue.');
                    }
                });
            });
        });
    </script>
@endsection
