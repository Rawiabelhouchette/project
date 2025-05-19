@extends('layout.public.app')

@section('title', 'Contactez-nous')

@section('css')
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        .contact-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 24px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .contact-icon-wrapper {
            background-color: #fff5eb;
            color: #ff6b00;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .contact-form {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 32px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            transition: border-color 0.2s ease;
            margin-bottom: 16px;
        }

        .form-control:focus {
            border-color: #ff6b00;
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
        }

        .btn.theme-btn {
            /* background-color: #ff6b00;
                    border: none;
                    border-radius: 8px;
                    padding: 12px 24px;
                    font-weight: 600;
                    transition: background-color 0.2s ease; */
        }

        .btn.theme-btn:hover {
            background-color: #e05e00;
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #333;
        }

        .contact-subtitle {
            color: #666;
            margin-bottom: 40px;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        textarea.form-control {
            min-height: 120px;
        }

        .translateY-60 {
            margin-top: -30px;
        }
    </style>
@endsection

@section('content')
    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Contactez-nous']];
    @endphp

    <x-breadcumb backgroundImage="assets_client/img/banner/image-4.jpg" :showTitle="true" title="Vamiyi" :breadcrumbs="$breadcrumbs" />

    <div class="clearfix"></div>

    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4 text-center">
                    <h2 class="contact-title">Contactez-nous</h2>
                    <p class="contact-subtitle">Nous sommes à votre disposition pour répondre à toutes vos questions.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="contact-form">
                        <h3 class="mb-4">Envoyez-nous un message</h3>
                        <form action="{{ route('contact-us') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom:</label>
                                <input id="name" class="form-control" name="name" type="text" placeholder="Votre nom" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input id="email" class="form-control" name="email" type="email" placeholder="votre@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="objet">Objet:</label>
                                <input id="objet" class="form-control" name="objet" type="text" placeholder="Sujet de votre message" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea id="message" class="form-control" name="message" placeholder="Votre message" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn theme-btn" name="submit">
                                    <i class="ti-send mr-2"></i> Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-column" style="gap: 40px">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="contact-card text-center">
                                <div class="contact-icon-wrapper">
                                    <i class="ti-location-pin font-30"></i>
                                </div>
                                <h4 class="mb-2">Bureau du Togo</h4>
                                <p class="text-muted">Togo - France</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="contact-card text-center">
                                <div class="contact-icon-wrapper">
                                    <i class="ti-email font-30"></i>
                                </div>
                                <h4 class="mb-2">Email</h4>
                                <a href="mailto:{{ env('APP_EMAIL') }}" class="text-primary">{{ env('APP_EMAIL') }}</a>
                            </div>
                        </div>
                    </div>
                    <div id="singleMap">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            // maxZoom: 11
        }).addTo(mymap);

        // var marker;

        // var lon = '0.72143577039242';
        // var lat = '9.6757766943938';
        // if (marker) {
        //     mymap.removeLayer(marker);
        // }

        // marker = L.marker([lat, lon]).addTo(mymap);
        // mymap.setView([lat, lon], 8);
    </script>
@endsection
