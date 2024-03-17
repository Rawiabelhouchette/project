@extends('layout.public.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    <section class="detail-section-1" style="background:url({{ asset('storage/' . $annonce->imagePrincipale->chemin) }});" data-overlay="6">
        <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
        <div class="profile-cover-content">
            <div class="container">
                <div class="cover-buttons">
                    {{-- <ul>
                        <li>
                            <div class="buttons medium button-plain "><i class="fa fa-phone"></i>+91 528 578 5458</div>
                        </li>
                        <li>
                            <div class="buttons medium button-plain "><i class="fa fa-map-marker"></i>#2852, SCO 20 Chandigarh</div>
                        </li>
                        <li>
                            <div class="inside-rating buttons listing-rating theme-btn button-plain"><span class="value">9.7</span> <sup class="out-of">/10</sup></div>
                        </li>
                        <li><a href="#add-review" class="buttons btn-outlined medium add-review"><i class="fa fa-comments-o"></i><span class="hidden-xs">Add review</span></a></li>
                        <li><a href="#" data-listing-id="74" data-nonce="01a769d424" class="buttons btn-outlined"><i class="fa fa-heart-o"></i><span class="hidden-xs">Bookmark</span> </a></li>
                    </ul> --}}
                </div>
                <div class="listing-owner hidden-xs hidden-sm">
                    {{-- <div class="detail-wrapper">
                        <div class="detail-wrapper-body" style="text-align: left !important;">
                            <h4>{{ $annonce->entreprise->nom }}<span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h4>
                            <h4>Pizza Prizm House</h4>

                        </div>
                    </div> --}}
                    {{-- <div class="listing-owner-avater">
                        <h3> {{ $annonce->entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $annonce->entreprise->quartier->ville->pays->nom }}</span></h3>
                    </div>
                    <div class="listing-owner-detail">
                        <h3> {{ $annonce->entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $annonce->entreprise->quartier->ville->pays->nom }}</span></h3>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <!-- ================ Listing Detail Full Information ======================= -->
    <section class="list-detail">
        <div class="container">
            <div class="row">
                <!-- Start: Listing Detail Wrapper -->
                <div class="col-md-8 col-sm-8">
                    <div class="detail-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                                <h3> {{ $annonce->entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h3>
                                <div>
                                    @if ($annonce->entreprise->site_web)
                                        <a href="{{ $annonce->entreprise->site_web }}" target="_blank">
                                            <i class="ti-world"></i>&nbsp;
                                            {{ $annonce->entreprise->site_web }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($annonce->entreprise->email)
                                        {{-- <a href="mailto:{{ $annonce->entreprise->email }}"> --}}
                                        <a href="javascript:void(0)">
                                            <i class="ti-email"></i>&nbsp;
                                            {{ $annonce->entreprise->email }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($annonce->entreprise->whatsapp)
                                        {{-- <a href="https://api.whatsapp.com/send?phone={{ $annonce->entreprise->quartier->ville->pays->indicatif }}{{ str_replace(' ', '', $annonce->entreprise->whatsapp) }}" target="_blank"> --}}
                                        <a href="javascript:void(0)">
                                            <i class="fa-brands fa-whatsapp"></i>&nbsp;
                                            {{ $annonce->entreprise->whatsapp }}
                                        </a>
                                        <br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start: Listing Gallery -->
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-gallery padd-r-10"></i>Galérie</h4>
                        </div>
                        <div class="widget-boxed-body padd-top-0">
                            <div class="side-list no-border gallery-box">
                                <div class="row mrg-l-5 mrg-r-10 mrg-bot-5">
                                    <div data-toggle="modal" data-id="{{ $annonce->imagePrincipale->chemin }}" data-target="#modal-gallery" class="col-xs-12 col-md-12 padd-0 image-preview" style="margin-bottom: -20px !important; margin-top: -10px !important; padding-left : 3px; padding-right : 3px;">
                                        <div class="listing-shot grid-style">
                                            <div class="" style="display: flex; justify-content: center; align-items: center; height: 220px; background:url({{ asset('storage/' . $annonce->imagePrincipale->chemin) }}); background-size: cover; background-position: center;">
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($annonce->galerie as $key => $image)
                                        @if ($key < 5)
                                            <div data-toggle="modal" data-id="{{ $image->id }}" data-target="#modal-gallery" class="col-xs-6 col-md-3 padd-0 padd-5 image-preview">
                                                <div class="listing-shot grid-style">
                                                    <div class="" style="display: flex; justify-content: center; align-items: center; height: 120px; background:url({{ asset('storage/' . $image->chemin) }}); background-size: cover; background-position: center;">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($key == 5)
                                            <div data-toggle="modal" data-id="{{ $image->id }}" data-target="#modal-gallery" class="col-xs-6 col-md-3 padd-0 padd-5 image-preview">
                                                <div class="listing-shot grid-style">
                                                    <div style="position: relative; display: flex; justify-content: center; align-items: center; height: 120px; background:url({{ asset('storage/' . $image->chemin) }}); background-size: cover; background-position: center;">
                                                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
                                                            <div style="color: white; font-size: 20px;">
                                                                +{{ count($annonce->galerie) - 4 }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                        @break
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Listing Gallery -->

                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4><i class="ti-info-alt padd-r-10"></i>Description
                        </h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <p>
                            {{ $annonce->description ?? 'Aucune description disponible' }}
                        </p>
                    </div>
                </div>

                <div class="tab style-1 mrg-bot-40" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab" data-toggle="tab">Information</a></li>
                        <li role="presentation"><a href="#equipement" aria-controls="equipement" role="tab" data-toggle="tab">Equipements</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs">
                        <div role="tabpanel" class="tab-pane fade in active" id="information">
                            <div class="row">
                                @forelse ($annonce->annonceable->caracteristiques as $key => $value)
                                    <div class="col-md-4 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                                        {{ strtoupper($key) }} <br>
                                        <strong>{{ $value }}</strong>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        Aucune information disponible
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="equipement">
                            @forelse ($annonce->referenceDisplay() as $key => $value)
                                @if (count($value) > 0)
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <strong class="" style="text-transform: uppercase;">{{ $key }}</strong>
                                        </div>
                                        <div class="detail-wrapper-body padd-bot-10">
                                            <ul class="detail-check">
                                                @forelse ($value as $equipement)
                                                    <div class="col-xs-12 col-md-4">
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
                    </div>
                </div>
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>24 Reviews</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <ul class="review-list">
                            <li>
                                <div class="reviews-box">
                                    <div class="review-body">
                                        <div class="review-avatar">
                                            <img alt="" src="http://via.placeholder.com/80x80" class="avatar avatar-140 photo">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-info">
                                                <div class="review-comment">
                                                    <div class="review-author">
                                                        Cole Harris
                                                    </div>
                                                    <div class="review-comment-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-comment-date">
                                                    <div class="review-date">
                                                        <span>4 weeks ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="reviews-box">
                                    <div class="review-body">
                                        <div class="review-avatar">
                                            <img alt="" src="http://via.placeholder.com/80x80" class="avatar avatar-140 photo">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-info">
                                                <div class="review-comment">
                                                    <div class="review-author">
                                                        Mariya Merry
                                                    </div>
                                                    <div class="review-comment-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-comment-date">
                                                    <div class="review-date">
                                                        <span>3 weeks ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="reviews-box">
                                    <div class="review-body">
                                        <div class="review-avatar">
                                            <img alt="" src="http://via.placeholder.com/80x80" class="avatar avatar-140 photo">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-info">
                                                <div class="review-comment">
                                                    <div class="review-author">
                                                        Wadden Will
                                                    </div>
                                                    <div class="review-comment-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-comment-date">
                                                    <div class="review-date">
                                                        <span>5 weeks ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis Praesentium Voluptatum Deleniti Atque Corrupti Quos Dolores Et Quas Molestias Excepturi Sint Occaecati Cupiditate Non Provident.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Rate & Write Reviews</h4>
                    </div>
                    <div class="detail-wrapper-body">

                        <div class="row mrg-bot-10">
                            <div class="col-md-12">
                                <div class="rating-opt">
                                    <div class="jr-ratenode jr-nomal"></div>
                                    <div class="jr-ratenode jr-nomal "></div>
                                    <div class="jr-ratenode jr-nomal "></div>
                                    <div class="jr-ratenode jr-nomal "></div>
                                    <div class="jr-ratenode jr-nomal "></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Your Name*">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" placeholder="Email Address*">
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form-control height-110" placeholder="Tell us your experience..."></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" class="btn theme-btn">Submit your review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End: Listing Detail Wrapper -->

            <!-- Sidebar Start -->
            <div class="col-md-4 col-sm-12">
                <div class="sidebar">
                    <!-- Start: Listing Location -->
                    <div class="widget-boxed padd-bot-10">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-location-pin padd-r-10"></i>Localisation</h4>
                        </div>
                        <div class="widget-boxed-body padd-top-5">
                            <div class="side-list no-border">
                                <ul>
                                    <li>Pays : <strong>{{ $annonce->entreprise->quartier->ville->pays->nom }} </strong></li>
                                    <li>Ville : <strong>{{ $annonce->entreprise->quartier->ville->nom }} </strong></li>
                                    <li>Quartier : <strong>{{ $annonce->entreprise->quartier->nom }} </strong></li>
                                    <li>
                                        <div id="map" class="full-width" style="height:200px;"></div>
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
                                        <li>{{ $key }} <span>{{ $ouverture }}</span></li>
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

@include('public.gallery', ['galerie' => $annonce->galerie])

<style>
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
        }
    }

    .pulse {
        animation: pulse 1s infinite;
    }
</style>
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
            var id = $(this).data('id');
            $('#image-' + id).addClass('pulse');
            setTimeout(() => {
                $('#image-' + id).removeClass('pulse');
            }, 2000);
        });
    });
</script>
@endsection
