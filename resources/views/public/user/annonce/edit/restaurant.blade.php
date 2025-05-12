@extends('layout.public.app')

@section('title', 'Modifier un Restaurant')

@section('content')


    @php
        $breadcrumbs = [
            ['route' => 'accueil', 'label' => 'Accueil'],
            ['route' => 'public.annonces.list', 'label' => 'Mes annonces'],
            ['label' => 'Restaurant'],
        ];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true"
        title="Modifier un Restaurant" :breadcrumbs="$breadcrumbs" />

    <div class="page-name auberge row">
        <div class="container text-left p-0">
            @livewire('admin.restaurant.edit', ['restaurant' => $restaurant])
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mymap);

        var marker;
        var lat = {{ $restaurant->annonce->latitude ?? 'null' }};
        var lon = {{ $restaurant->annonce->longitude ?? 'null' }};

        if (lat !== null && lon !== null) {
            var latlng = L.latLng(lat, lon);
            marker = L.marker(latlng).addTo(mymap);
            mymap.setView(latlng, 8); // Set map view to current location
        }

        mymap.on('click', function(e) {
            if (marker) {
                mymap.removeLayer(marker); // Supprimez le marqueur existant s'il y en a un.
            }

            marker = L.marker(e.latlng).addTo(mymap);
            lat = e.latlng.lat;
            lon = e.latlng.lng;

            Livewire.dispatch('setLocation', [{
                lon,
                lat
            }]);
        });
    </script>

    <script>
        $('.select2').each(function() {
            $(this).select2({
                theme: 'bootstrap-5',
                dropdownParent: $(this).parent(),
            });
        });
    </script>
@endsection
