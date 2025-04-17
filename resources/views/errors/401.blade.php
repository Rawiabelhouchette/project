@extends('layout.public.app')

@section('title', 'Unauthorized')

@section('content')
    <section class="detail-section" data-overlay="6" style="background:url({{ asset('assets_client/img/banner/image-4.jpg') }});">
        <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
        <div class="profile-cover-content">
            <div class="container">
                <div class="center">
                    <h3 style="color: white;">401</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

    <section>
        <div class="container">
            <div class="booking-confirm padd-top-10 padd-bot-10">
                <h1 class="mrg-top-15 mrg-bot-0 cl-theme font-100 font-bold">401</h1>
                <h2 class="mrg-top-15 cl-theme">Accès non autorisé</h2>
                <p>Vous n'êtes pas autorisé à accéder à cette page</p>
                <a class="btn theme-btn-trans mrg-top-20" href="{{ route('accueil') }}">Retourner à l'accueil</a>
            </div>
        </div>
    </section>
@endsection
