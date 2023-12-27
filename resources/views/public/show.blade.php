@extends('layout.public.app')

@section('content')
    @include('layout.public.search_box', [
        'key' => $key,
        'type' => $type,
        'detail' => true,
    ])

    {{-- @livewire('public.search', [
        'key' => $key,
        'type' => $type,
        'filter' => $filter ?? [],
    ]) --}}

    <!-- ================ Listing Detail Full Information ======================= -->
    <section class="list-detail mrg-0 padd-0">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Détail d'une annonce</h3> <br>
                <!-- Start: Listing Detail Wrapper -->
                <div class="col-md-8 col-sm-8">
                    <div class="detail-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                                <h3>{{ $annonce->titre }} <span class="mrg-l-5 category-tag">{{ $annonce->type }}</span></h3>
                                <div>
                                    <a href="#listing-location" class="listing-address">
                                        <i class="ti-location-pin mrg-r-5"></i>
                                        {{ $annonce->entreprise->adresse_complete }}
                                    </a>

                                    <div class="rating-box">
                                        <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}" class="listing-address">
                                            <i class="fas fa-building mrg-r-5"></i> &nbsp;
                                            {{ $annonce->entreprise->nom }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="detail-wrapper">
                        <div class="detail-wrapper-header">
                            <h4>Caractéristiques</h4>
                        </div>
                        <div class="detail-wrapper-body">
                            <p>
                                @foreach ($annonce->annonceable->getCaracteristiquesAttribute() as $key => $value)
                                    <h5>{{ ucfirst($key) }} : <span class="badge badge-primary">{{ $value }}</span></h5>
                                    <br>
                                @endforeach
                                @foreach ($annonce->referenceDisplay() as $slug => $values)
                                    <h5>{{ ucfirst($slug) }} :
                                        @foreach ($values as $value)
                                            <span class="badge badge-primary">{{ $value }}</span>
                                        @endforeach
                                    </h5>
                                    <br>
                                @endforeach
                            </p>

                        </div>
                    </div> --}}

                    <div class="detail-wrapper">
                        <div class="detail-wrapper-header">
                            <h4><i class="ti-layers-alt padd-r-10"></i>Description</h4>
                        </div>
                        <div class="detail-wrapper-body">
                            @if ($annonce->description)
                                <p>{{ $annonce->description }}</p>
                            @else
                                <p>Aucune description n'est disponible pour cette entreprise.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Start: Listing Gallery -->
                    <div class="widget-boxed">
                        <div class="widget-boxed-header">
                            <h4><i class="ti-gallery padd-r-10"></i>Galérie ({{ $annonce->galerie->count() }})</h4>
                        </div>
                        <div class="widget-boxed-body">
                            <div class="side-list no-border gallery-box">
                                <ul class="gallery-list">
                                    @foreach ($annonce->galerie as $image)
                                        <li>
                                            <a data-fancybox="gallery" href="{{ asset('storage/' . $image->chemin) }}">
                                                <img src="{{ asset('storage/' . $image->chemin) }}" class="img-responsive" alt="">
                                            </a>
                                        </li>
                                    @endforeach
                                    @empty($annonce->galerie->count())
                                        <p class="text-center">
                                            Aucune image n'est disponible pour cette annonce
                                        </p>
                                    @endempty
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End: Listing Gallery -->
                </div>
                <!-- End: Listing Detail Wrapper -->

                <!-- Sidebar Start -->
                <div class="col-md-4 col-sm-12">
                    <div class="sidebar">

                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-eye padd-r-10"></i>Caractéristiques</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="side-list">
                                    <ul>
                                        @foreach ($annonce->annonceable->getCaracteristiquesAttribute() as $key => $value)
                                            <li>{{ ucfirst($key) }} <span>{{ $value }}</span></li>
                                        @endforeach
                                        @foreach ($annonce->referenceDisplay() as $slug => $values)
                                            <li>{{ ucfirst($slug) }} :
                                                @foreach ($values as $value)
                                                    <span>{{ $value }}</span> <br>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Start: Latest Listing -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-check-box padd-r-10"></i>Derniéres annonces</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5">
                                <div class="side-list">
                                    <ul class="listing-list">
                                        @foreach ($annonces as $annonce)
                                            <li>
                                                <a href="{{ route('show', $annonce->slug) }}" title="Listing">
                                                    <div class="listing-list-img">
                                                        <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                                <div class="listing-list-info">
                                                    <h5><a href="{{ route('show', $annonce->slug) }}" title="Listing">{{ $annonce->titre }}</a></h5>
                                                    <div class="listing-post-meta">
                                                        <span class="updated">{{ date('d-m-Y', strtotime($annonce->created_at)) }}</span> | <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}" rel="tag">{{ $annonce->type }}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        @empty($annonces)
                                            <p>
                                                Aucune annonce n'est disponible pour cette entreprise.
                                            </p>
                                        @endempty
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
