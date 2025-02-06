@extends('layout.public.template')

@section('entreprise', 'active')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-2.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Mon entreprise</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('public.annonces.create') }}">Mon entreprise</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Mon entreprise</span>
                </div>
            </div>
        </div>
    </section>
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                @livewire('admin.entreprise.create')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mymap);

        var marker;

        mymap.on('click', function(e) {
            if (marker) {
                mymap.removeLayer(marker); // Supprimez le marqueur existant s'il y en a un.
            }

            marker = L.marker(e.latlng).addTo(mymap);
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;



            Livewire.dispatch('setLocation', [{
                lon,
                lat
            }]);
        });
    </script>

@endsection
