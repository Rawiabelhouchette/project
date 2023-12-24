@extends('layout.public.app')

@section('content')

    <!-- ================ Listing Detail Basic Information ======================= -->
    <section class="detail-section" style="background:url(http://via.placeholder.com/1920x850);" data-overlay="6">
        <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
        <div class="profile-cover-content">
            <div class="container">
                <div class="center">
                    <h3 style="color: white;">Détail d'une entreprise</h3>
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
                                <h3> {{ $entreprise->nom }} <span class="mrg-l-5 category-tag">{{ $entreprise->quartier->ville->pays->nom }}</span></h3>
                                <div>
                                    <a href="javascript:void(0)" class="listing-address">
                                        <i class="ti-location-pin mrg-r-5"></i>
                                        {{ $entreprise->adresse_complete }}
                                    </a>
                                    <br>
                                    @if ($entreprise->telephone)
                                        <a href="tel:{{ $entreprise->telephone }}">
                                            <i class="ti-mobile"></i>&nbsp;
                                            {{ $entreprise->telephone }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->email)
                                        <a href="mailto:{{ $entreprise->email }}">
                                            <i class="ti-email"></i>&nbsp;
                                            {{ $entreprise->email }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->whatsapp)
                                        <a href="https://api.whatsapp.com/send?phone={{ $entreprise->quartier->ville->pays->indicatif }}{{ str_replace(' ', '', $entreprise->whatsapp) }}" target="_blank">
                                            <i class="fa-brands fa-whatsapp"></i>&nbsp;
                                            {{ $entreprise->whatsapp }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->instagram)
                                        <a href="https://www.instagram.com/{{ $entreprise->instagram }}" target="_blank">
                                            <i class="fa-brands fa-instagram"></i>&nbsp;
                                            {{ $entreprise->instagram }}
                                        </a>
                                        <br>
                                    @endif

                                    @if ($entreprise->facebook)
                                        <a href="https://www.facebook.com/{{ $entreprise->facebook }}" target="_blank">
                                            <i class="fa-brands fa-facebook"></i>&nbsp;
                                            {{ $entreprise->facebook }}
                                        </a>
                                        <br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-wrapper">
                        <div class="detail-wrapper-header">
                            <h4>Description</h4>
                        </div>
                        <div class="detail-wrapper-body">
                            @if ($entreprise->description)
                                <p>{{ $entreprise->description }}</p>
                            @else
                                <p>Aucune description n'est disponible pour cette entreprise.</p>
                            @endif
                        </div>
                    </div>

                    <div class="detail-wrapper">
                        <div class="detail-wrapper-header">
                            <h4>Localisation</h4>
                        </div>
                        <div class="detail-wrapper-body">
                            <div id="map" class="full-width" style="height:400px;"></div>
                        </div>
                    </div>
                </div>
                <!-- End: Listing Detail Wrapper -->

                <!-- Sidebar Start -->
                <div class="col-md-4 col-sm-12">
                    <div class="sidebar">

                        <!-- Start: Opening hour -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-time padd-r-10"></i>Opening Hours</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list">
                                    <ul>
                                        <li>Monday <span>9 AM - 5 PM</span></li>
                                        <li>Tuesday <span>9 AM - 5 PM</span></li>
                                        <li>Wednesday <span>9 AM - 5 PM</span></li>
                                        <li>Thursday <span>9 AM - 5 PM</span></li>
                                        <li>Friday <span>9 AM - 5 PM</span></li>
                                        <li>Saturday <span>9 AM - 3 PM</span></li>
                                        <li>Sunday <span>Closed</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Opening hour -->

                        <!-- Start: Listing Gallery -->
                        {{-- <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-gallery padd-r-10"></i>Gallery</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list no-border gallery-box">
                                    <ul class="gallery-list">
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                        <li>
                                            <a data-fancybox="gallery" href="http://via.placeholder.com/1200x850">
                                                <img src="http://via.placeholder.com/100x80" class="img-responsive" alt="" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End: Listing Gallery -->

                        <!-- Start: Latest Listing -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-check-box padd-r-10"></i>Latest Listing</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5">
                                <div class="side-list">
                                    <ul class="listing-list">
                                        <li>
                                            <a href="#">
                                                <div class="listing-list-img">
                                                    <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                                </div>
                                            </a>
                                            <div class="listing-list-info">
                                                <h5><a href="#" title="Listing">Freel Documentry</a></h5>
                                                <div class="listing-post-meta">
                                                    <span class="updated">Nov 26, 2017</span> | <a href="#" rel="tag">Documentry</a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="listing-list-img">
                                                    <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                                </div>
                                            </a>
                                            <div class="listing-list-info">
                                                <h5><a href="#" title="Listing">Preez Food Rock</a></h5>
                                                <div class="listing-post-meta">
                                                    <span class="updated">Oct 10, 2017</span> | <a href="#" rel="tag">Food</a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="listing-list-img">
                                                    <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                                </div>
                                            </a>
                                            <div class="listing-list-info">
                                                <h5><a href="#" title="Listing">Cricket Buzz High</a></h5>
                                                <div class="listing-post-meta">
                                                    <span class="updated">Oct 07, 2017</span> | <a href="#" rel="tag">Sport</a>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="listing-list-img">
                                                    <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                                </div>
                                            </a>
                                            <div class="listing-list-info">
                                                <h5><a href="#" title="Listing">Tour travel Tick</a></h5>
                                                <div class="listing-post-meta">
                                                    <span class="updated">Sep 27, 2017</span> | <a href="#" rel="tag">Travel</a>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Latest Listing -->
                    </div>
                </div>
                <!-- End: Sidebar Start -->
            </div>
        </div>
    </section>
    <!-- ================ Listing Detail Full Information ======================= -->
@endsection


@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    var mymap = L.map('map').setView([8.6195, 0.8248], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(mymap);

    var marker;

    var lon = {{ $entreprise->longitude }};
    var lat = {{ $entreprise->latitude }};
    if (marker) {
        mymap.removeLayer(marker);
    }

    marker = L.marker([lat, lon]).addTo(mymap);
    mymap.setView([lat, lon], 12);
</script>
@endsection