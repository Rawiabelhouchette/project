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
                                                        <span class="custom-checkbox d-block orange-color" style="font-size: 18px;">
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
                        <div class="card" style="margin-bottom: 0px;">
                            <div class="card-header facette-color">
                                <div class="col-md-6 text-left">
                                    <h4>
                                        <i class="fa fa-user" style="font-size: 15px;"></i> &nbsp;Mon compte
                                    </h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    {{-- <a href="{{ route('messages.create') }}">
                                        <h4 class="orange-color">
                                            <i class="fa fa-plus orange-color" style="font-size: 15px;"></i>
                                            Ecrire
                                        </h4>
                                    </a> --}}
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-md-12" style="padding: 0px;">
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>Erreur !</strong>
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>Ok !</strong>
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('profil.store') }}" method="POST">
                                    @csrf
                                    <div class="col-md-12" style="padding: 0px;">
                                        <div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
                                            <div class="listing-box-header">
                                                <i class="ti-user theme-cl" style="color: #EA4F0C;"></i>
                                                <h3>Informations personnelles</h3>
                                            </div>
                                            {{-- <div class="listing-box-header">
                                                <div class="avater-box">
                                                    <img src="{{ asset('assets_client/img/avatar.jpg') }}" class="img-responsive img-circle edit-avater" alt="">
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn theme-btn" style="background-color: #EA4F0C; color: white;">Change Avatar</button>
                                                        <input type="file" name="myfile">
                                                    </div>
                                                </div>
                                                <h3>{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</h3>
                                            </div> --}}
                                            {{-- <form> --}}
                                            <div class="row mrg-r-10 mrg-l-10">
                                                <div class="col-sm-6">
                                                    <label>Nom</label>
                                                    <input type="text" name="nom" class="form-control" value="{{ $user->nom }}" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Prénom</label>
                                                    <input type="text" name="prenom" class="form-control" value="{{ $user->prenom }}" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>E-mail</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Nom d'utilisateur</label>
                                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                                                </div>
                                                @if (!Auth::user()->is_admin)
                                                    <div class="col-sm-6">
                                                        <label>Téléphone</label>
                                                        <input type="text" name="telephone" class="form-control" value="{{ $user->compte->telephone }}" required>
                                                    </div>
                                                @endif
                                            </div>


                                            {{-- </form> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="padding: 0px;">
                                        <div class="add-listing-box opening-day mrg-bot-25 padd-bot-30 padd-top-25">
                                            <div class="listing-box-header">
                                                <i class="ti-lock theme-cl" style="color: #EA4F0C;"></i>
                                                <h3>Mot de passe</h3>
                                            </div>
                                            {{-- <form> --}}
                                            <div class="row mrg-r-10 mrg-l-10">
                                                <div class="col-sm-6">
                                                    <label>Ancien mot de passe</label>
                                                    <input type="password" name="password1" class="form-control" placeholder="*********" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Nouveau mot de passe</label>
                                                    <input type="password" name="password" class="form-control" placeholder="*********">
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Retaper le nouveau mot de passe</label>
                                                    <input type="password" name="password-confirmation" class="form-control" placeholder="*********">
                                                    {{-- <p>feferfer</p> --}}
                                                </div>
                                            </div>
                                            {{-- </form> --}}
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn theme-btn" id="update-btn" style="background-color: #EA4F0C;" title="Submit Listing">Mettre a jour</button>
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
        });
    </script>
@endsection
