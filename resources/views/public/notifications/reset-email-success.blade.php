@extends('layout.public.app')

@section('title', env('APP_NAME') . ' - Réinitialiser le mot de passe')

@section('content')
    <section class="detail-section" data-overlay="6"
        style="background:url({{ asset('assets_client/img/banner/image-4.jpg') }});">
        <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
        <div class="profile-cover-content">
            <div class="container">
                <div class="center">
                    <h3 style="color: white;">Message</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

    <section>
        <div class="container">
            <div class="booking-confirm padd-top-30 padd-bot-30">
                <i class="fa fa-check" aria-hidden="true"></i>
                <h2 class="mrg-top-15">Opération réussie !</h2>
                <p>Un lien de réinitialisation de mot de passe a été envoyé à votre adresse e-mail</p>
                <a href="{{ route('accueil') }}" class="btn theme-btn-trans mrg-top-20">Retourner à l'accueil</a>
            </div>
        </div>
    </section>
@endsection