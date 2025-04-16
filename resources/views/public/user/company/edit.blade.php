@extends('layout.public.app')

@section('title', 'Modifier mon entreprise')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-2.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Modifier mon entreprise</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('public.my-business') }}">Mon entreprise</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Modification</span>
                </div>
            </div>
        </div>
    </section>

    <div class="page-name row">
        <div class="container text-left">
            @livewire('admin.entreprise.edit', ['entreprise' => $entreprise])
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
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

    @if ($entreprise->latitude && $entreprise->longitude)
        <script>
            var latlng = L.latLng({{ $entreprise->latitude }}, {{ $entreprise->longitude }});
            marker = L.marker(latlng).addTo(mymap);
            mymap.setView(latlng, 8); // Set map view to current location
        </script>
    @endif
@endsection
