@extends('layout.public.app')

@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#de6600';
    @endphp

    <section class="title-transparent page-title"
        style="background:url({{ asset('assets_client/img/banner/image-1.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Ajouter un hotel</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('public.annonces.create') }}">Deposer une annonce</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Hotel</span>
                </div>
            </div>
        </div>
    </section>

    <div class="page-name auberge row">
        <div class="container text-left">
            @livewire('admin.hotel.create')
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mymap);

        var marker;

        mymap.on('click', function (e) {
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

    <script>
        $('.select2').each(function () {
            $(this).select2({
                theme: 'bootstrap-5',
                dropdownParent: $(this).parent(),
            });
        });
    </script>
@endsection