@extends('layout.public.app')

@section('title', 'Ajouter une Auberge')

@section('content')

    <style>
        /* Smartphones (portrait) */
        @media (max-width: 480px) {
            .desktop-breadcumb {
                display: none !important
            }

            .mobile-breadcumb {
                display: block !important
            }

            .breadcrumb {
                background-color: #006064;
            }

            .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
                font-size: 2.2rem !important;
                color: white !important;
            }
        }

        @media (min-width: 481px) and (max-width: 767px) {
            .desktop-breadcumb {
                display: none !important
            }

            .breadcrumb {
                background-color: #006064;
                color: white !important;
            }

            .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
                font-size: 2.2rem !important;
            }

            .mobile-breadcumb {
                display: block !important
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .desktop-breadcumb {
                display: none !important
            }

            .breadcrumb {
                background-color: #006064;
            }

            .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
                font-size: 2.2rem !important;
                color: white !important;
            }

            .mobile-breadcumb {
                display: block !important
            }
        }

        .mobile-breadcumb {
            display: none
        }

        .custom-breadcrumb {

            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .custom-breadcrumb .breadcrumb-item a {
            color: #FF9800;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .custom-breadcrumb .breadcrumb-item a:hover {
            color: #FFC107;
            text-decoration: underline;
        }

        .custom-breadcrumb .breadcrumb-item.active {
            color: white;
            font-weight: 600;
        }

        .custom-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #B0BEC5;
            font-size: 1.2rem;
            line-height: 1;
            padding: 0 8px;
        }
    </style>
    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-2.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Ajouter une auberge</h1>
                <div class="breadcrumbs d-none d-md-block desktop-breadcumb">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('public.annonces.create') }}">Déposer une annonce</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Auberge </span>
                </div>
                <div class="mobile-breadcumb mt-4">
                    <nav aria-label="breadcrumb" class="custom-breadcrumb d-block d-md-none">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('accueil') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('public.annonces.create') }}">Déposer une annonce </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Auberge</li>
                        </ol>
                    </nav>
                </div>

                <div class="breadcrumbs d-block d-md-none desktop-breadcumb">
                    <div>
                        <a href="{{ route('accueil') }}">Accueil</a>
                        <span class="gt3_breadcrumb_divider"></span>
                    </div>
                    <div>
                        <a href="{{ route('public.annonces.create') }}">Déposer une annonce</a>
                        <span class="gt3_breadcrumb_divider"></span>
                    </div>
                    <div>
                        <span class="current">Auberge 12</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-name auberge row">
        <div class="container text-left">
            @livewire('admin.auberge.create')
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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

    <script>
        $('.select2').each(function() {
            $(this).select2({
                theme: 'bootstrap-5',
                dropdownParent: $(this).parent(),
            });
        });
    </script>
@endsection
