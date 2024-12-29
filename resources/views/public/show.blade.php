@extends('layout.public.app')


@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp
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
                                        <!-- Listing galery -->
                <div class="widget-boxed padd-bot-10">
                    <div class="widget-boxed-header"> <div class="listing-title-bar">
                        {{-- <h3> {{ $annonce->entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h3> --}}
                        <h3> {{ $annonce->titre }} <span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h3>
                        <div class="annonces">
                            <a href="javascript:void(0)">
                                <i class="fa fa-building fa-lg" ></i>
                                {{ $annonce->entreprise->nom }}
                            </a>
                            @if ($annonce->entreprise->site_web)
                                <a href="{{ $annonce->entreprise->site_web }}" target="_blank">
                                    <i class="ti-world" ></i>{{ $annonce->entreprise->site_web }}
                                </a>
                                
                            @endif

                            @if ($annonce->entreprise->email)
                                {{-- <a href="mailto:{{ $annonce->entreprise->email }}"> --}}
                                <a href="javascript:void(0)">
                                    <i class="ti-email" ></i>
                                    {{ $annonce->entreprise->email }}
                                </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="widget-boxed-body padd-top-0">
                        <div class="side-list no-border gallery-box">
                            <div class="row mrg-l-5 mrg-r-10 mrg-bot-5">
                                <div class="col-xs-12 col-md-12 padd-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                
                  <div class="carousel-inner">
                                          @foreach ($annonce->galerie as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? ' active' : ''  }}">
                      <img src="{{ asset('storage/' . $image->chemin) }}" class="d-block w-100" alt="...">
                    </div>
                                        @endforeach
                  </div>
                  <div class="carousel-indicators">
                                          @foreach ($annonce->galerie as $key => $image)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="active thumbnail" aria-current="true" aria-label="Slide 1">
                      <img src="{{ asset('storage/' . $image->chemin) }}" class="d-block w-100" alt="...">
                    </button>
                                        @endforeach
                  </div>
                </div>
                 </div> 
                </div> 
                            </div> 
                        </div> 
                    </div>
                <!-- End: Listing Gallery --> 
                <div class="tab style-1 mrg-bot-40" role="tabpanel">
                    <!-- Nav tabs -->
                    {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">                        
                            <button class="nav-link active" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Détail</button>
                        </li>
                        <li class="nav-item" role="presentation">                        
                            <button class="nav-link" id="information-tab" data-bs-toggle="tab" data-bs-target="#equipement" type="button" role="tab" aria-controls="equipement" aria-selected="true">Équipements</button>
                        </li>
                    </ul> --}}
                    {{-- @include('components.public.show.information-header') --}}
                    {{ $annonce->annonceable->getShowInformationHeader() }}

                    <!-- Tab panes -->
                    {{-- <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <h2 class="mb-3">{{ $annonce->annonceable->caracteristiques }}</h2>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="equipement"labelledby="equipement-tab">
                            @forelse ($annonce->referenceDisplay() as $key => $value)
                                @if (count($value) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong class="" style="text-transform: uppercase;">{{ $key }}</strong>
                                        </div>
                                        <div class="detail-wrapper-body padd-bot-10">
                                            <ul class="detail-check">
                                                @forelse ($value as $equipement)
                                                    <div class="col-xs-12 col-md-4 padd-l-0">
                                                        <li style="width: 100%;">{{ $equipement }}</li>
                                                    </div>
                                                @empty
                                                    <span class="text-center">
                                                        Aucun équipement disponible
                                                    </span>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-md-12">
                                    Aucun équipement disponible
                                </div>
                            @endforelse
                        </div>
                    </div> --}}
                    {{-- @include('components.public.show.information-body', ['annonce' => $annonce]) --}}
                    {{ $annonce->annonceable->getShowInformationBody() }}
                </div>
                </div>
                <!-- Start: Listing Detail Wrapper -->
                <div class="col-md-8 col-sm-8">     

                

                @livewire('public.comment', [$annonce])

            </div> 
            <!-- End: Listing Detail Wrapper -->
    
            <!-- Sidebar Start -->
            <div class="col-md-4 col-sm-12">
                <div class="sidebar">
                                   
                    
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-location-pin padd-r-10"></i>Informations</h4>
                        </div>
                        <div class="widget-boxed-body padd-top-5">
                            <div class="coordonnees">
                                <div class="cover-buttons mrg-top-15">
                                            <ul>
                                                <li class="mrg-r-10" style="padding-left: 0;">
                                                    <span class="buttons li-btn view padd-10">
                                                        <i class="fa fa-eye hidden-xs"></i>
                                                        <span class="">{{ $annonce->view_count }} vue(s)</span>
                                                    </span>
                                                </li>
                                                <li class="mrg-r-10">
                                                    <span class="buttons li-btn view padd-10">
                                                        <i class="fa fa-comment-o hidden-xs"></i>
                                                        <span class="" id="annonce-commentaire">{{ $annonce->comment_count }}</span> commentaire(s)
                                                    </span>
                                                </li>
                                                <li class="mrg-r-10">
                                                    <div class="inside-rating listing-rating theme-btn li-btn">
                                                        <span class="value" id="annonce-note">{{ $annonce->note }}</span> <sup class="out-of">/ 5</sup>
                                                    </div>
                                                </li>
                                                <li class="mrg-r-10 ">
                                                    @livewire('public.favoris', [$annonce])
                                                </li>
                                                <li class="mrg-r-10">
                                                    <button class="buttons padd-10 li-btn share-button" data-toggle="modal" data-target="#share">
                                                        <i class="fa fa-share"></i>
                                                        <span class="hidden-xs">Partager</span>
                                                    </button>
                                                </li>
                                                @if ($annonce->entreprise->instagram)
                                                    <li>
                                                        <a class="social-network" href="{{ $annonce->entreprise->instagram }}" style="background-color: #FF3A72" target="_blank"><i class="fa-brands fa-instagram" style="font-size: 17px;"></i> Instagram</a>
                                                    </li>
                                                @endif
                                                @if ($annonce->entreprise->facebook)
                                                    <li>
                                                        <a class="social-network" href="{{ $annonce->entreprise->facebook }}" style="background-color: #0866FF" target="_blank"><i class="fa-brands fa-facebook" style="font-size: 17px;"></i> Facebook</a>
                                                    </li>
                                                @endif
                                                @if ($annonce->entreprise->whatsapp)
                                                    <li>
                                                        <a class="social-network" href="https://wa.me/{{ $annonce->entreprise->quartier->ville->pays->indicatif ?? '' }}{{ str_replace(' ', '', $annonce->entreprise->whatsapp) }}" style="background-color: #00A884" target="_blank"><i class="fa-brands fa-whatsapp" style="font-size: 17px;"></i> Whatsapp</a>
                                                    </li>
                                                @endif
                                            </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                   
                    
                    <!-- Start: Listing Location -->
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-location-pin padd-r-10"></i>Localisation</h4>
                        </div>
                        <div class="widget-boxed-body padd-top-5">
                            <div class="side-list">
                                <ul>
                                    <li>Pays<span>{{ $annonce->entreprise->quartier->ville->pays->nom ?? '-' }} </span></li>
                                    <li>Ville<span>{{ $annonce->entreprise->quartier->ville->nom ?? '-' }} </span></li>
                                    <li>Quartier<span>{{ $annonce->entreprise->quartier->nom ?? '-' }} </span></li>
                                    <li>
                                        <div class="full-width" id="map" style="height:200px;"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End: Listing Location -->

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
            <!-- End: Sidebar Start -->
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    var mymap = L.map('map').setView([8.6195, 0.8248], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(mymap);

    var marker;

    var lon = {{ $annonce->entreprise->longitude }};
    var lat = {{ $annonce->entreprise->latitude }};
    if (marker) {
        mymap.removeLayer(marker);
    }

    marker = L.marker([lat, lon]).addTo(mymap);
    mymap.setView([lat, lon], 12);
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
