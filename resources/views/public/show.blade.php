@extends('layout.public.app')

@section('title', 'Détails d\'une annonce')

@section('content')
    <section class="title-transparent page-title" style="background-image:url({{ asset('storage/' . $annonce->imagePrincipale->chemin) }});">
        <div class="container">
            <div class="title-content">
                <h1>{{ $annonce->titre }}</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('search') }}">{{ $annonce->type }}</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">{{ $annonce->titre }}</span>
                </div>
            </div>
        </div>
    </section>

    <div class="page-name annonce-detail row">

        <!-- ================ Listing Detail Full Information ======================= -->
        <section class="list-detail padd-bot-10 padd-top-30">
            <div class="container">
                <div class="row mrg-bot-40">
                    <div class="col-md-6 col-sm-12 nav-div nav-div-1">
                        <h5>
                            <a href="{{ route('search') }}" title="Revenir à la recherche">
                                <i class="fa fa-fw fa-arrow-left" aria-hidden="true"></i>
                                Revenir à la recherche
                            </a>
                        </h5>
                    </div>
                    <div class="col-md-6 col-sm-12 nav-div" style="text-align: right">
                        <h5>
                            <a class="" href="{{ $pagination->previous }}">
                                <i class="fa fa-fw fa-angle-left"></i>
                                Précédent
                            </a>
                            <span class="padd-l-10 padd-r-10 theme-cl">
                                {{ $pagination->position }}
                            </span>
                            <a class="" href="{{ $pagination->next }}">
                                Suivant
                                <i class="fa fa-fw fa-angle-right"></i>
                            </a>
                        </h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="widget-boxed padd-bot-10">
                            <div class="widget-boxed-header">
                                <div class="listing-title-bar">
                                    <h3> {{ $annonce->titre }}
                                        <span class="listing-shot-info rating p-0">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                            @endfor

                                        </span>
                                    </h3>


                                </div>
                            </div>
                            <div class="widget-boxed-body padd-top-0">
                                <div class="side-list no-border gallery-box">
                                    <div class="row mrg-l-5 mrg-r-10 mrg-bot-5">
                                        <div class="col-xs-12 col-md-12 p-0">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                                                <div class="carousel-inner">
                                                    @foreach ($annonce->galerieAvecImagePrincipale() as $key => $image)
                                                        <div class="carousel-item {{ $key == 0 ? ' active' : '' }}">
                                                            <img class="d-block w-100" style="object-fit: cover;" src="{{ asset('storage/' . $image->chemin) }}" alt="...">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="carousel-indicators">
                                                    @foreach ($annonce->galerieAvecImagePrincipale() as $key => $image)
                                                        <button class="active thumbnail" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" type="button" aria-current="true" aria-label="Slide 1">
                                                            <img class="d-block w-100" style="object-fit: cover;" src="{{ asset('storage/' . $image->chemin) }}" alt="...">
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="side-list share-buttons">
                                    <div class="mrg-r-10">
                                        <button class="buttons padd-10 btn-default share-button" data-toggle="modal" data-target="#share">
                                            <i class="fa fa-share-nodes"></i>
                                            <!-- <span class="hidden-xs">Partager</span> -->
                                        </button>
                                    </div>
                                    <div class="mrg-r-10">
                                        @livewire('public.favoris', [$annonce])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget-boxed padd-bot-10" id="test">
                            <div class="tab style-1 mrg-bot-40" role="tabpanel">
                                {{ $annonce->annonceable->getShowInformationHeader() }}

                                {{ $annonce->annonceable->getShowInformationBody() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12">
                        <div class="widget-boxed padd-bot-10">
                        <div class="annonces row mt-5 gy-4">
                                        <div class="col-md-12">
                                            <div class="contact-item">
                                                <strong>Profile : </strong>
                                                <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}" class="contact-button">
                                                    <i class="fa fa-building fa-lg"></i>
                                                    {{ $annonce->entreprise->nom }}
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="contact-item">
                                                <strong>Contact : </strong>
                                                
                                                @if ($annonce->entreprise->site_web)
                                                    <a href="{{ $annonce->entreprise->site_web }}" target="_blank" class="contact-button">
                                                        <i class="ti-world"></i> {{ $annonce->entreprise->site_web }}
                                                    </a>
                                                @endif
                                                
                                                @if ($annonce->entreprise->email)
                                                    <a href="mailto:{{ $annonce->entreprise->email }}" class="contact-button">
                                                        <i class="ti-email"></i> {{ $annonce->entreprise->email }}
                                                    </a>
                                                @endif
                                            </div>
                                            
                                            <div class="social-links">
                                                <strong>Socials : </strong>
                                                @if ($annonce->entreprise->instagram)
                                                    <a href="{{ $annonce->entreprise->instagram }}" target="_blank" class="social-button instagram">
                                                        <i class="fa-brands fa-instagram"></i> Instagram
                                                    </a>
                                                @endif
                                                
                                                @if ($annonce->entreprise->facebook)
                                                    <a href="{{ $annonce->entreprise->facebook }}" target="_blank" class="social-button facebook">
                                                        <i class="fa-brands fa-facebook"></i> Facebook
                                                    </a>
                                                @endif
                                                
                                                @if ($annonce->entreprise->whatsapp)
                                                    <a href="https://wa.me/{{ $annonce->entreprise->quartier->ville->pays->indicatif ?? '' }}{{ str_replace(' ', '', $annonce->entreprise->whatsapp) }}" target="_blank" class="social-button whatsapp">
                                                        <i class="fa-brands fa-whatsapp"></i> Whatsapp
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            <div class="widget-boxed-header">
                                <h4><i class="ti-location-pin padd-r-10"></i>Localisation</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5">
                                <div class="side-list">
                                    <ul>
                                        <li>{{ $annonce->adresse_complete->pays ?? '-' }} -
                                            {{ $annonce->adresse_complete->ville ?? '-' }},
                                            {{ $annonce->adresse_complete->quartier ?? '-' }}
                                        </li>
                                        <li>
                                            <div id="map" class="full-width" style="height:252px;"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <!-- Start: Opening hour -->
                        <div class="widget-boxed padd-bot-10">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-time padd-r-10"></i>Heures d'ouverture</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list">
                                    <ul>
                                        @foreach ($annonce->entreprise->heure_ouvertures as $key => $ouverture)
                                            @if ($ouverture == 'Fermé')
                                                <li>{{ $key }} <span class="text-danger">{{ $ouverture }}</span></li>
                                            @else
                                                <li>{{ $key }} <span>{{ $ouverture }}</span></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Opening hour -->
                    </div>
                </div>
            </div>

        </section>
        <!-- ================ Listing Detail Full Information ======================= -->

        @include('public.gallery', [
            'galerie' => $annonce->galerie,
            'couverture' => $annonce->imagePrincipale,
        ])

        @include('components.public.share-modal-alt', [
            'title' => 'Partager cette annonce',
            'annonce' => $annonce,
        ])
    @endsection

    @section('js')
        <script>
            var latlng = L.latLng({{ $annonce->latitude }}, {{ $annonce->longitude }});
            var mymap = L.map('map').setView(latlng, 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(mymap);

            var marker;

            var lon = {{ $annonce->longitude }};
            var lat = {{ $annonce->latitude }};
            if (marker) {
                mymap.removeLayer(marker);
            }

            marker = L.marker([lat, lon]).addTo(mymap);
            mymap.setView([lat, lon], 10);
        </script>

        <script>
            $(document).ready(function() {
                $('.image-preview').click(function() {
                    $('#share').hide();
                    var id = $(this).data('id');
                    $('#image-' + id).addClass('pulse');
                    setTimeout(() => {
                        $('#image-' + id).removeClass('pulse');
                    }, 2000);
                });
            });
        </script>
    @endsection


