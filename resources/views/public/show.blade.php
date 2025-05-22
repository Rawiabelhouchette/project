@extends('layout.public.app')

@section('title', 'Détails d\'une annonce')

@section('content')


    @php
        $breadcrumbs = [
            ['route' => 'accueil', 'label' => 'Accueil'],
            ['route' => 'search', 'label' => $annonce->type],
        ];
    @endphp

    @php
        $typeList = $typeAnnonce ?? [];
    @endphp
    <x-breadcumb backgroundImage="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" :showSearchButton="true" :showTitle="false"
     :breadcrumbs="$breadcrumbs" :typeList="$typeList" />



    <div class="page-name annonce-detail row">

        <!-- ================ Listing Detail Full Information ======================= -->
        <section class="list-detail p-0">
            <div class="container">
                <!-- Start: Pagination Wrapper -->
                <div class="row">
                    <div class="col-sm-12 nav-div nav-div-1">
                        <h5 style="text-align: left; border-bottom: 1px silver solid;" class="py-4 px-1">
                            <a href="{{ route('search') }}" title="Revenir à la recherche">
                                <i class="fa fa-fw fa-arrow-left" aria-hidden="true"></i>
                                Revenir à la recherche
                            </a>
                        </h5>
                    </div>
                    <div class="col-sm-12 nav-div" style="text-align: right">
                        <div class="d-flex px-4 py-1" style="justify-content: space-between; align-items: center;border-bottom: 1px silver solid;">
                            <a class="" href="{{ $pagination->previous }}">
                                <i class="fa fa-fw fa-angle-left"></i>
                                Précédent
                            </a>
                            <span class="padd-l-10 padd-r-10 position-cl">
                                {{ $pagination->position }}
                            </span>
                            <a class="" href="{{ $pagination->next }}">
                                Suivant
                                <i class="fa fa-fw fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End: Pagination Wrapper -->

                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="widget-boxed padd-bot-10">
                            <div class="widget-boxed-header">
                                <div class="listing-title-bar">
                                    
                                    <h3> {{ $annonce->titre }} 
                                         
                                    </h3>
                                    <span class="mrg-l-5 category-tag"> {{ $annonce->type }} </span>   

                                </div>
                            </div>
                            <div class="widget-boxed-body padd-top-0">
                            <div class="annonces row gy-4">
                                
                                    <div class="contact-item">
                                        <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}">
                                            <i class="fa fa-building fa-lg" style="color: #de6600"></i>
                                            {{ $annonce->entreprise->nom }}
                                        </a>
                                    </div>
                                

                               
                                    <div class="contact-item">

                                        @if ($annonce->entreprise->site_web)
                                            <a href="{{ $annonce->entreprise->site_web }}" target="_blank">
                                                <i class="ti-world" style="color: #de6600"></i> {{ $annonce->entreprise->site_web }}
                                            </a>
                                        @endif

                                        @if ($annonce->entreprise->email)
                                            <a href="mailto:{{ $annonce->entreprise->email }}">
                                                <i class="ti-email" style="color: #de6600"></i> {{ $annonce->entreprise->email }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="counter-container" style="margin-right: 1rem;">
                                        <div class="counter-item-alt">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <span style="white-space: nowrap;">{{ $annonce->view_count }} vue(s)</span>
                                        </div>
                                        <div class="counter-item-alt">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                            <span style="white-space: nowrap;">{{ $annonce->favorite_count }} favori(s)</span>
                                        </div>
                                        <div class="counter-item-alt">
                                            <i class="fa fa-comment" aria-hidden="true"></i>
                                            <span style="white-space: nowrap;">{{ $annonce->comment_count }} commentaire(s)</span>
                                        </div>
                                        <div class="counter-item-alt theme-btn text-white border-0">
                                            <span style="white-space: nowrap;">{{ $annonce->note }}/5</span>
                                        </div>

                                    </div>
                                    <div class="social-links d-flex">
                                        
                                        <div class="d-flex justify-content-between" style="width: 100%;">
                                            <div class="d-flex">
                                                @if ($annonce->entreprise->instagram)
                                                    <a href="{{ $annonce->entreprise->instagram }}" target="_blank"
                                                        class="social-button instagram me-2">
                                                        <i class="fa-brands fa-instagram"></i>
                                                    </a>
                                                @endif
                                                @if ($annonce->entreprise->facebook)
                                                    <a href="{{ $annonce->entreprise->facebook }}" target="_blank"
                                                        class="social-button facebook me-2">
                                                        <i class="fa-brands fa-facebook"></i>
                                                    </a>
                                                @endif
                                                @if ($annonce->entreprise->whatsapp)
                                                    <a href="https://wa.me/{{ $annonce->entreprise->quartier->ville->pays->indicatif ?? '' }}{{ str_replace(' ', '', $annonce->entreprise->whatsapp) }}"
                                                        target="_blank" class="social-button whatsapp me-2">
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="side-list share-buttons">
                                                <div class="mrg-r-10">
                                                    <button class="buttons padd-10 btn-default share-button"  data-toggle="modal" data-target="#share" onclick="shareAnnonce('{{ route('show', $annonce->slug) }}', '{{ $annonce->titre }}', '{{ asset('storage/' . ($annonce->image ? $annonce->image : 'placeholder.jpg')) }}', '{{ $annonce->type }}')">
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

                               
                            </div>
                            </div>
                        </div>
                        <div class="widget-boxed padd-bot-10">
                            <div class="widget-boxed-header">
                                <div class="listing-title-bar">
                                    
                                    <h4 style="padding: 14px 0;border-bottom: 1px solid #eaeff5;"> 
                                        <i class="ti ti-gallery"></i>
                                        Galérie
                                    </h4>
                                </div>
                            </div>
                            <div class="widget-boxed-body padd-top-0">
                                <div class="side-list no-border gallery-box">
                                    <div class="row mrg-l-5 mrg-r-10 mrg-bot-5">
                                        <div class="col-xs-12 col-md-12 p-0">
                                            <div id="carouselExampleIndicators" class="carousel slide"
                                                data-bs-ride="carousel">

                                                <div class="carousel-inner">
                                                    @foreach ($annonce->galerieAvecImagePrincipale() as $key => $image)
                                                        <div class="carousel-item {{ $key == 0 ? ' active' : '' }}">
                                                            <a href="{{ asset('storage/' . $image->chemin)}}" data-fancybox="gallery">
                                                                <img class="d-block w-100" style="object-fit: cover;"
                                                                    src="{{ asset('storage/' . $image->chemin)}}"
                                                                    alt="{{ $annonce->titre }}"
                                                                    onerror="this.onerror=null; this.src='https://placehold.co/600';">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="carousel-indicators">
                                                    @foreach ($annonce->galerieAvecImagePrincipale() as $key => $image)
                                                        <button class="active thumbnail"
                                                            data-bs-target="#carouselExampleIndicators"
                                                            data-bs-slide-to="{{ $key }}" type="button"
                                                            aria-current="true" aria-label="Slide 1">
                                                            <a href="{{ asset('storage/' . $image->chemin)}}" data-fancybox="gallery-thumbs">
                                                                <img class="d-block w-100" style="object-fit: cover;"
                                                                    src="{{ asset('storage/' . $image->chemin)}}"
                                                                    alt="{{ $annonce->titre }}"
                                                                    onerror="this.onerror=null; this.src='https://placehold.co/600';">
                                                            </a>
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-boxed padd-bot-10" id="test">
                            <div class="tab style-1 mrg-bot-40" role="tabpanel">
                                {{ $annonce->annonceable->getShowInformationHeader() }}

                                {{ $annonce->annonceable->getShowInformationBody() }}
                            </div>
                            
                            <!-- Comments Section -->
                            <div class="widget-boxed padd-bot-10">
                                <div class="widget-boxed-header">
                                    <h4><i class="fa fa-comments padd-r-10"></i>Commentaires</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    @livewire('public.comment', [$annonce])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <!-- Start: Localisation -->
                        <div class="widget-boxed padd-bot-10">

                            <div class="widget-boxed-header">
                                <h4><i class="ti-location-pin padd-r-10"></i>Localisation</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5">
                                <div class="side-list">
                                    <ul>
                                        <li>Pays : <b>{{ $annonce->adresse_complete->pays ?? '-' }}</b></li>
                                        <li>Ville : <b>{{ $annonce->adresse_complete->ville ?? '-' }}</b></li>
                                        <li>Quartier : <b>{{ $annonce->adresse_complete->quartier ?? '-' }}</b></li>
                                        
                                        <li>
                                            <div id="map" class="full-width" style="height:252px;"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Localisation -->

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
                                                <li>{{ $key }} <span
                                                        class="text-danger">{{ $ouverture }}</span></li>
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
                    <div class="col-md-4 col-sm-12">

                    </div>

                </div>
            </div>

        </section>
        <!-- ================ Listing Detail Full Information ======================= -->

        @include('public.gallery', [
            'galerie' => $annonce->galerie,
            'couverture' => $annonce->imagePrincipale,
        ])


        @include('components.public.share-modal', [
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


            // Initialize Fancybox for gallery images
            $(document).ready(function() {
                $('[data-fancybox="gallery"]').fancybox({
                    buttons: [
                        "zoom",
                        "fullScreen",
                        "close"
                    ],
                    animationEffect: "fade",
                    transitionEffect: "fade",
                    loop: true,
                    protect: true,
                    modal: false,
                    idleTime: 3,
                    clickContent: function(current, event) {
                        return current.type === "image" ? "zoom" : false;
                    }
                });
                
                $('[data-fancybox="gallery-thumbs"]').fancybox({
                    buttons: [
                        "zoom",
                        "fullScreen",
                        "close"
                    ],
                    animationEffect: "fade",
                    transitionEffect: "fade",
                    loop: true,
                    protect: true
                });
            });

            function shareAnnonce(url, titre, image, type) {
                console.log("share function called with:", url, titre, image, type);
                var text = "Salut!%0AJette un œil à l'annonce que j'ai trouvé sur Vamiyi%0ATitre : " + titre + "%0ALien : " + url + " ";
                var subject = titre;

                // Set content
                $('#annonce-titre').text(subject);
                $('#annonce-image-url').attr('src', image);
                $('#annonce-type').text(type);

                // Set share links
                $('#annonce-email').attr('href', 'mailto:?subject=' + subject + '&body=' + text);
                $('#annonce-url').data('url', url);
                $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
                $('#annonce-whatsapp').attr('href', 'whatsapp://send?text=' + text);

                // Hide page zone and show modal
                $('#share-page-zone').hide();

                // Properly open Bootstrap modal
                $('#share').modal('show');
            }
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

    @section('css')
    <style>
        /* Fancybox customization */
        .fancybox-bg {
            background: #000;
        }
        
        .fancybox-is-open .fancybox-bg {
            opacity: 0.9;
        }
        
        .fancybox-caption {
            font-size: 16px;
        }
        
        /* Make carousel images clickable */
        .carousel-item a {
            cursor: zoom-in;
            display: block;
        }
        
        /* Fix for thumbnail buttons */
        .carousel-indicators button a {
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
    @endsection







