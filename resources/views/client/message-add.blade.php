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
                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-xs-12">
                        {{-- <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Erreur ! </strong> ewwwe
                        </div> --}}

                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row">
                    <!-- Start Sidebar -->

                    <h4 class="text-center"></h4>
                    <div class="col-md-3 col-sm-12">
                        <div class="sidebar">
                            <!-- Start: Search By Price -->
                            <div class="widget-boxed facette-color" style="padding-bottom: 0px;">
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
                                        <i class="fa fa-comment-alt"></i> &nbsp;Nouveau message
                                    </h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    {{-- Ecrire --}}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-md-12">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>OK !</strong> {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>Erreur !</strong> {{ session()->get('error') }}
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('messages.store') }}" method="POST">
                                    @csrf
                                    @if (!auth()->check())
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Nom
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="nom" required type="text" style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Prénom
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="prenom" required type="text" style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Email
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" required name="email" type="email" style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    N° Tél
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" required name="telephone" type="text" style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Nom
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" value="{{ auth()->user()->nom }}" disabled style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Prénom
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" value="{{ auth()->user()->prenom }}" disabled style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Email
                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" value="{{ auth()->user()->email }}" disabled style="height: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    N° Tél
                                                </div>
                                                <div class="col-md-9">
                                                    @if (auth()->user()->compte)
                                                        <input class="form-control" value="{{ auth()->user()->nom }}" disabled style="height: 40px;">
                                                    @else
                                                        <input class="form-control" value="-" disabled style="height: 40px;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Motif
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="motif" id="motif" style="height: 40px;" required>
                                                    @if ($motifs->reference_valeurs)
                                                        @foreach ($motifs->reference_valeurs as $motif)
                                                            <option value="{{ $motif->id }}">{{ $motif->valeur }}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="0">Autre</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Autre
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" name="autre_motif" disabled id="autre_motif" type="text" style="height: 40px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                Message <br>
                                                <textarea class="form-control" minlength="20" name="message" style="height: 150px;" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary orange-color-bg" style="width: 100px;">Envoyer</button>
                                    </div>
                                </form>
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

            // Activer ou desactiver autre_motif si motif est autre
            $('#motif').change(function() {
                if ($(this).val() == '0') {
                    $('#autre_motif').prop('disabled', false);
                    $('#autre_motif').prop('required', true);
                } else {
                    $('#autre_motif').prop('disabled', true);
                    $('#autre_motif').val('');
                    $('#autre_motif').prop('required', false);
                }
            });
        });
    </script>
@endsection
