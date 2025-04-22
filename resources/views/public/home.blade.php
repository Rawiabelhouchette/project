@extends('layout.public.app')

@section('css')
    <style>
        #banner {
            transition: background 2s ease-in-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .form-verticle-mobile {
            display: none;
        }

        @media (max-width: 480px) {
            .form-verticle {
                display: none !important;
            }

            .form-verticle-mobile {
                display: block !important;
            }
        }

        @media (min-width: 481px) and (max-width: 767px) {
            .form-verticle {
                display: none !important;
            }

            .form-verticle-mobile {
                display: block !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .form-verticle {
                display: none !important;
            }

            .form-verticle-mobile {
                display: block !important;
            }
        }

        .form-verticle-mobile {
            display: none;
        }

        :root {
            --primary-color: #de6600;
            --secondary-color: #de6600;
            --accent-color: #de6600;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --transition-speed: 0.3s;
        }


        .search-container {
            max-width: 600px;
            margin: 50px auto;
        }

        .search-bar {
            border-radius: 30px;
            padding: 15px 20px;
            cursor: pointer;
            color: white;
            background-color: #de6600;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .search-bar:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .modal-fullscreen {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .modal-fullscreen .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0;
            background-color: rgba(255, 255, 255, 0.98);
        }

        .modal-header {
            border-bottom: none;
            padding: 15px 20px;
            justify-content: flex-end;
        }

        .btn-close {
            transition: transform var(--transition-speed);
        }

        .btn-close:hover {
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 0 20px;
            overflow-y: auto;
        }

        /* Custom accordion styling */
        .search-accordion {
            margin-bottom: 20px;
        }

        .search-accordion-item {
            margin-bottom: 20px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all var(--transition-speed);
        }

        .search-accordion-item.active {
            box-shadow: 0 8px 24px rgba(67, 97, 238, 0.15);
            transform: translateY(-3px);
        }

        .search-accordion-header {
            background-color: white;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .search-accordion-button {
            width: 100%;
            padding: 20px;
            background: none;
            border: none;
            text-align: left;
            position: relative;
            display: flex;
            align-items: center;
            font-weight: 600;
            color: var(--dark-color);
            border-radius: 16px;
            transition: all var(--transition-speed);
        }

        .search-accordion-button .icon-container {
            background-color: #f1f3f9;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-right: 15px;
            transition: all var(--transition-speed);
        }

        .search-accordion-button:hover .icon-container,
        .search-accordion-item.active .search-accordion-button .icon-container {
            background-color: var(--primary-color);
            color: white;
        }

        .search-accordion-button .toggle-icon {
            margin-left: auto;
            transition: transform var(--transition-speed);
            font-size: 1.5rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .search-accordion-item.active .search-accordion-button .toggle-icon {
            transform: rotate(180deg);
            color: var(--primary-color);
        }

        .search-accordion-button .title {
            font-size: 1.1rem;
            margin-right: 8px;
        }

        .search-accordion-button .counter {
            background-color: var(--accent-color);
            color: white;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            opacity: 0;
            transition: all var(--transition-speed);
            transform: scale(0.8);
        }

        .search-accordion-button .counter.active {
            opacity: 1;
            transform: scale(1);
        }

        .search-accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
            padding: 0 20px;
        }

        .search-accordion-item.active .search-accordion-content {
            max-height: 500px;
        }

        .search-accordion-body {
            padding: 20px 0;
        }

        /* Input Styling */
        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container input {
            width: 100%;
            padding: 16px 16px 16px 50px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            font-size: 1rem;
            transition: all var(--transition-speed);
            background-color: white;
        }

        .input-container input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .input-container .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: all var(--transition-speed);
        }

        .input-container input:focus+.input-icon {
            color: var(--primary-color);
        }

        /* Chips Styling */
        .chips-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
            padding-bottom: 10px;
            max-height: 200px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
        }

        .chips-container::-webkit-scrollbar {
            width: 6px;
        }

        .chips-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .chips-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 6px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #f1f3f9;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .chip:hover {
            background-color: #e6e9f0;
            transform: translateY(-2px);
        }

        .chip.active {
            background-color: rgba(67, 97, 238, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 500;
        }

        .chip.active::before {
            content: '';
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--primary-color);
            width: 20px;
            height: 20px;
            transform: rotate(45deg);
        }

        .chip.active::after {
            content: '✓';
            position: absolute;
            top: 2px;
            right: 2px;
            color: white;
            font-size: 8px;
        }

        /* Footer Styling */
        .modal-footer {
            justify-content: space-between;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: sticky;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .clear-btn {
            background: none;
            border: none;
            color: var(--dark-color);
            text-decoration: underline;
            font-weight: 500;
            transition: all var(--transition-speed);
        }

        .clear-btn:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        .search-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 24px;
            padding: 12px 24px;
            font-weight: 600;
            width: 100%;
            max-width: 200px;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }

        .search-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(67, 97, 238, 0.3);
        }

        .search-btn i {
            font-size: 1.1rem;
        }

        /* Progress Bar */
        .progress-container {
            height: 4px;
            width: 100%;
            background-color: #f1f3f9;
            border-radius: 2px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 0;
            background-color: var(--accent-color);
            border-radius: 2px;
            transition: width var(--transition-speed) ease;
        }

        /* Animation for accordion opening */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-accordion-item.active .search-accordion-body {
            animation: fadeIn 0.3s ease forwards;
        }

        /* Pulse animation for search button */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(67, 97, 238, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(67, 97, 238, 0);
            }
        }
    </style>
@endsection

@section('content')
    @include('components.default-value')

    <!-- Main Banner Section Start -->
    <div id="banner" class="banner dark-opacity" data-overlay="8"
        style="background-image:url(assets_client/img/banner/image-1.jpg);">
        <div class="container">
            <div class="banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <div class="logo-home col-md-4" style="background-image:url(assets/img/logo-vamiyi-vacances-white.svg);">
                    </div>

                    <div class="search-home col-md-12">
                        <!-- <h1>Vamiyi</h1> -->
                        <h2>L'aventure commence ici</h2>
                        <p>Explorez les meilleurs hébergements, des restaurants et plus encore...</p>
                    </div>
                    <div class="form-home col-md-12">
                        <!-- Search form for desktop -->
                        <form class="form-verticle" method="GET" action="{{ route('search') }}">
                            <input name="form_request" type="hidden" value="1">
                            <div class="col-md-4 col-sm-4 no-padd">
                                <i class="banner-icon icon-pencil"></i>
                                <input class="form-control left-radius right-br" name="key" type="text"
                                    placeholder="Mot clé...">
                            </div>
                            <div class="col-md-3 col-sm-3 no-padd">
                                <div class="form-box">
                                    <i class="banner-icon icon-map-pin"></i>
                                    <input id="myInput" class="form-control right-br" name="location" type="text"
                                        placeholder="Localisation...">
                                    <div id="autocomplete-results" class="autocomplete-items"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 no-padd">
                                <div class="form-box">
                                    <i class="banner-icon icon-layers"></i>
                                    <select class="form-control" name="type[]">
                                        <option class="chosen-select" data-placeholder="{{ __('Types d\'annonce') }}"
                                            value="" selected>{{ __('Types d\'annonce') }}</option>
                                        @foreach ($typeAnnonce as $annonce)
                                            <option value="{{ $annonce }}">{{ $annonce }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-3 no-padd">
                                <div class="form-box">
                                    <button class="btn theme-btn btn-default" type="submit">
                                        {{-- <i class="ti-search"></i> --}}
                                        {{ __('Rechercher') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Search form for mobile -->
                        <div class="form-verticle-mobile">
                            <!-- Main Search Bar -->
                            <div class="search-container">
                                <div class="search-bar d-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#searchModal">
                                    <i class="bi bi-search me-2"></i>
                                    <span>Commencer ma recherche</span>
                                </div>
                            </div>

                            <!-- Full Screen Search Modal -->
                            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="search-accordion" id="searchAccordion">
                                                <!-- Mot clé Accordion -->
                                                <div class="search-accordion-item active" id="motCleSection">
                                                    <div class="search-accordion-header">
                                                        <button class="search-accordion-button" type="button"
                                                            data-section="motCle">
                                                            <div class="icon-container">
                                                                <i class="bi bi-search"></i>
                                                            </div>
                                                            <span class="title">Mot clé</span>
                                                            <span class="selection-text" id="motCleSelection"></span>
                                                            <div class="toggle-icon">
                                                                <i class="bi bi-chevron-down"></i>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    <div class="search-accordion-content" style="max-height: 500px;">
                                                        <div class="search-accordion-body">
                                                            <div class="input-container">
                                                                <input type="text" id="motCleInput"
                                                                    placeholder="Rechercher par mot clé">
                                                                <i class="bi bi-search input-icon"></i>
                                                            </div>
                                                            <div class="progress-container">
                                                                <div class="progress-bar" id="motCleProgress"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Localisation Accordion -->
                                                <div class="search-accordion-item" id="localisationSection">
                                                    <div class="search-accordion-header">
                                                        <button class="search-accordion-button" type="button"
                                                            data-section="localisation">
                                                            <div class="icon-container">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                            <span class="title">Localisation</span>
                                                            <span class="selection-text"
                                                                id="localisationSelection"></span>
                                                            <div class="toggle-icon">
                                                                <i class="bi bi-chevron-down"></i>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    <div class="search-accordion-content">
                                                        <div class="search-accordion-body">
                                                            <div class="input-container">
                                                                <input type="text" id="localisationInput"
                                                                    placeholder="Rechercher une localisation">
                                                                <i class="bi bi-geo-alt input-icon"></i>
                                                            </div>
                                                            <div class="chips-container" id="localisationChips">
                                                                @foreach ($quartiers as $quartier)
                                                                    <div class="chip" data-section="localisation">
                                                                        {{ $quartier }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="progress-container">
                                                                <div class="progress-bar" id="localisationProgress"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Types d'annonce Accordion -->
                                                <div class="search-accordion-item" id="typesAnnonceSection">
                                                    <div class="search-accordion-header">
                                                        <button class="search-accordion-button" type="button"
                                                            data-section="typesAnnonce">
                                                            <div class="icon-container">
                                                                <i class="bi bi-tag"></i>
                                                            </div>
                                                            <span class="title">Types d'annonce</span>
                                                            <span class="selection-text"
                                                                id="typesAnnonceSelection"></span>
                                                            <div class="toggle-icon">
                                                                <i class="bi bi-chevron-down"></i>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    <div class="search-accordion-content">
                                                        <div class="search-accordion-body">
                                                            <div class="input-container">
                                                                <input type="text" id="typesAnnonceInput"
                                                                    placeholder="Rechercher un type d'annonce">
                                                                <i class="bi bi-tag input-icon"></i>
                                                            </div>
                                                            <div class="chips-container" id="typesAnnonceChips">
                                                                @foreach ($typeAnnonce as $annonce)
                                                                    <div class="chip" data-section="typesAnnonce">
                                                                        {{ $annonce }}</div>
                                                                @endforeach
                                                            </div>
                                                            <div class="progress-container">
                                                                <div class="progress-bar" id="typesAnnonceProgress"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="clear-btn" id="clearBtn">Tout effacer</button>
                                            <button type="button" class="search-btn" id="searchBtn">
                                                <i class="bi bi-search"></i>
                                                <span>{{ __('Rechercher') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="popular-categories">
                        <ul class="popular-categories-list">
                            @foreach ($listAnnonce as $key => $annonce)
                                <li>
                                    <a href="{{ route('search.key.type', ['', $annonce->nom]) }}">
                                        <div class="pc-box">
                                            <i class="{{ $annonce->icon }} {{ $annonce->color }}"></i>
                                            <p>{{ $annonce->nom }} <br></p>
                                        </div><br>
                                    </a>
                                </li>
                                @if ($key >= 5)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <!-- Main Banner Section End -->

    <!-- Listings Section -->
    <section class="sec-bt">
        <div class="container">

            <div class="row">
                <div class="col-md-10">
                    <div class="heading">
                        {{-- <h2>Top & Popular <span>Listings</span></h2> --}}
                        <h2>Top <span>Annonces</span></h2>
                        <p>Les plus populaires</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single List -->
                @foreach ($annonces as $annonce)
                    <div class="col-lg-4 col-md-6 col-xs-6">
                        <div class="property_item classical-list">
                            <div class="image" style="height: 200px important">
                                <a class="listing-thumb" href="{{ route('show', $annonce->slug) }}">
                                    @if ($annonce->image)
                                        <img class="img-responsive"
                                            src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}"
                                            alt="latest property"
                                            style="object-fit: cover; object-position: center; width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                    @else
                                        <img class="img-responsive" src="http://via.placeholder.com/1200x800"
                                            alt="latest property">
                                    @endif
                                </a>
                                {{-- <div class="listing-price-info">
                                <span class="pricetag">{{ $annonce->type }}</span>
                            </div> --}}
                            </div>

                            <div class="proerty_content">
                                <div class="author-avater">
                                    @if ($annonce->image)
                                        <img class="author-avater-img"
                                            src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}"
                                            alt="latest property"
                                            style="width: 70px; height: 70px; object-fit: cover; object-position: center;">
                                    @else
                                        <img class="author-avater-img" src="http://via.placeholder.com/120x120"
                                            alt="">
                                    @endif
                                </div>
                                <div class="proerty_text">
                                    <h3 class="captlize">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            {{ $annonce->titre }}
                                        </a>
                                        {{-- <span class="veryfied-author"></span> --}}
                                    </h3>
                                </div>
                                <p class="property_add btn-theme">{{ $annonce->type }}</p>
                                <div class="property_meta">
                                    <div class="list-fx-features">
                                        <div class="listing-card-info-icon">
                                            <span>
                                            <i class="ti-location-pin"></i>
                                            </span>
                                            <span class="inc-fleat inc-add mrg-0">
                                                @if ($annonce->ville_id)
                                                    {{ $annonce->adresse_complete->pays }},
                                                    {{ $annonce->adresse_complete->ville }},
                                                    {{ $annonce->adresse_complete->quartier }}
                                                @else
                                                    {{ $annonce->entreprise->adresse_complete }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="listing-card-info-icon">
                                                <i class="ti-mobile"></i> 
                                            <span class="inc-fleat inc-call mrg-0">
                                                @if ($annonce->entreprise->telephone)
                                                    <a href="tel:{{ str_replace(' ', '', $annonce->entreprise->telephone) }}">
                                                        {{ $annonce->entreprise->telephone }}
                                                    </a>
                                                @else
                                                    <a
                                                        href="tel:{{ $annonce->entreprise->quartier->ville->pays->indicatif }}{{ str_replace(' ', '', $annonce->entreprise->telephone) }}">
                                                        {{ $annonce->entreprise->quartier->ville->pays->indicatif }}
                                                        {{ $annonce->entreprise->telephone }}
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="listing-footer-info">
                                <div class="listing-cat">
                                    <a class="cl-1" href="{{ route('entreprise.show', $annonce->entreprise->slug) }}">
                                        <div class=" d-flex justify-content-center align-items-center">
                                            <span class="more-cat mrg-l-0" style="">
                                                <i class="fas fa-building"></i>
                                            </span>
                                        </div>
                                        <div class=" text-center">
                                        {{ $annonce->entreprise->nom }}
                                        
                                    </a>
                                    <div class="col-md-12 text-center">
                                    @if ($annonce->entreprise->est_ouverte)
                                    <span class="place-status">Ouvert</span>
                                @else
                                    <span class="place-status closed">Fermée</span>
                                @endif
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- End Listings Section -->

    <!-- Category Section -->
    <section class="bg-image" data-overlay="6" style="background:url(assets_client/img/image-stat.JPEG);">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="heading light">
                        <h2>Top <span>Catégories</span></h2>
                        <p>Les plus populaires</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="category-slide">
                    @foreach ($listAnnonce as $list)
                        <div class="list-slide-box">
                            <div class="category-full-widget">
                                <div class="category-widget-bg" style="background-image: url({{ $list->image }});">
                                    <i class="bg-{{ $list->bg }} cat-icon {{ $list->icon }}"
                                        aria-hidden="true"></i>
                                </div>
                                <div class="cat-box-name">
                                    <h4 style="font-size: 16px;">{{ $list->libelle }}</h4>
                                    <a class="btn-btn-wrowse" href="{{ route('search.key.type', ['', $list->nom]) }}">Parcourir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
    <!-- End Category Section -->

    <section class="company-state theme-overlap" style="background:url(assets_client/img/image-stat.JPEG);">
        <div class="container-fluid">
            <div class="col-md-3 col-sm-6">
                <div class="work-count">
                    <span class="theme-cl icon fa fa-briefcase"></span>
                    <span class="counter">
                        {{ $nbAnnonces }}
                    </span>
                    {{-- <span class="counter-incr">+</span> --}}
                    <p>Annonces</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="work-count">
                    <span class="theme-cl icon ti-layers"></span>
                    <span class="counter">
                        {{ $nbTypesAnnonces }}
                    </span>
                    {{-- <span class="counter-incr">+</span> --}}
                    <p>Types d'annonce</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="work-count">
                    <span class="theme-cl icon fa fa-building"></span>
                    <span class="counter">
                        {{ $nbEntreprises }}
                    </span>
                    {{-- <span class="counter-incr">+</span> --}}
                    <p>Entreprises</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="work-count">
                    <span class="theme-cl icon ti-user"></span>
                    <span class="counter">
                        {{ $nbUtilisateurs }}
                    </span>
                    {{-- <span class="counter-incr">+</span> --}}
                    <p>Utilisateurs</p>
                </div>
            </div>
        </div>

        <style>
            .autocomplete {
                position: relative;
                display: inline-block;
            }

            .autocomplete-items {
                position: absolute;
                border: 1px solid #d4d4d4;
                border-bottom: none;
                border-top: none;
                z-index: 99;
                top: 100%;
                left: 0;
                right: 0;
                border-radius: 5px;
                margin-top: 5px;
            }

            .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff;
                border-bottom: 1px solid #d4d4d4;
                text-align: left;
                /*  */
                color: #90969e;
            }

            .autocomplete-items div:hover {
                background-color: #f6f6f6;
                /* background-color: #de6600; */
                /* color: #fff; */
                color: #90969e;
            }

            .autocomplete-items div:first-child {
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }

            .autocomplete-items div:last-child {
                border-bottom-left-radius: 5px;
                border-bottom-right-radius: 5px;
            }
        </style>

        @push('scripts')
            <script>
                let countries = @json($quartiers);
                console.log(" countries = ", countries)
                let myInput = document.getElementById('myInput');

                myInput.addEventListener('focus', function(e) {
                    let a, b, val = this.value;
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    this.parentNode.appendChild(a);
                    if (!val) {
                        for (let i = 0; i < countries.length; i++) {
                            b = document.createElement("DIV");
                            b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i];
                            b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                            b.addEventListener("click", function(e) {
                                document.getElementById('myInput').value = this.getElementsByTagName("input")[0]
                                    .value;
                                closeAllLists();
                            });
                            a.appendChild(b);

                        }
                        return;

                    }

                    for (let i = 0; i < countries.length; i++) {
                        let country = normalize(countries[i]).toUpperCase();
                        let searchVal = normalize(val).toUpperCase();

                        if (country.includes(searchVal)) {
                            let startIdx = country.indexOf(searchVal);
                            let endIdx = startIdx + searchVal.length;

                            b = document.createElement("DIV");
                            b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i].substr(0, startIdx) +
                                "<strong>" + countries[i].substr(startIdx, searchVal.length) + "</strong>" +
                                countries[i].substr(endIdx);
                            b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                            b.addEventListener("click", function(e) {
                                document.getElementById('myInput').value = this.getElementsByTagName("input")[0]
                                    .value;
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });


                myInput.addEventListener('input', function(e) {
                    let a, b, val = this.value;
                    closeAllLists();
                    if (!val) {
                        return false;
                    }
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    this.parentNode.appendChild(a);
                    for (let i = 0; i < countries.length; i++) {
                        let country = normalize(countries[i]).toUpperCase();
                        let searchVal = normalize(val).toUpperCase();

                        if (country.includes(searchVal)) {
                            let startIdx = country.indexOf(searchVal);
                            let endIdx = startIdx + searchVal.length;

                            b = document.createElement("DIV");
                            b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i].substr(0, startIdx) +
                                "<strong>" + countries[i].substr(startIdx, searchVal.length) + "</strong>" +
                                countries[i].substr(endIdx);
                            b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                            b.addEventListener("click", function(e) {
                                document.getElementById('myInput').value = this.getElementsByTagName("input")[0]
                                    .value;
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });

                function normalize(str) {
                    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                }

                function closeAllLists(elmnt) {
                    let x = document.getElementsByClassName("autocomplete-items");
                    for (let i = 0; i < x.length; i++) {
                        if (elmnt != x[i] && elmnt != document.getElementById('myInput')) {
                            x[i].parentNode.removeChild(x[i]);
                        }
                    }
                }

                document.addEventListener("click", function(e) {
                    closeAllLists(e.target);
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('select').niceSelect();
                });
            </script>
        @endpush
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var images = ['image-1.jpg', 'image-2.jpg', 'image-3.JPEG', 'image-4.jpg'];
            var index = 0;
            var interval;

            var banner = document.getElementById('banner');
            var form = document.querySelector('.form-verticle');

            // Function to change image
            function changeImage() {
                index = (index + 1) % images.length;
                banner.style.backgroundImage = "url('assets_client/img/banner/" + images[index] + "')";
            }

            // Set image change interval
            function setImageChangeInterval() {
                interval = setInterval(changeImage, 5000);
            }

            setImageChangeInterval();

            // Change image on click
            banner.addEventListener('click', function(event) {
                if (event.target === form || form.contains(event.target)) {
                    // If the click event originated from the form, stop the event propagation
                    // event.stopPropagation();
                } else {
                    clearInterval(interval); // Clear the interval
                    changeImage(); // Change the image immediately
                    setImageChangeInterval(); // Set the interval again
                }
            });
        });
    </script>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track selections for each section
            const selections = {
                motCle: '',
                localisation: '',
                typesAnnonce: ''
            };

            // Get accordion sections
            const accordionSections = document.querySelectorAll('.search-accordion-item');
            const accordionButtons = document.querySelectorAll('.search-accordion-button');

            // Toggle accordion sections
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const section = this.getAttribute('data-section');
                    const parent = document.getElementById(section + 'Section');

                    // Close all other sections
                    accordionSections.forEach(item => {
                        if (item !== parent) {
                            item.classList.remove('active');
                            item.querySelector('.search-accordion-content').style
                                .maxHeight = null;
                        }
                    });

                    // Toggle current section
                    parent.classList.toggle('active');

                    // Set max-height for animation
                    const content = parent.querySelector('.search-accordion-content');
                    if (parent.classList.contains('active')) {
                        content.style.maxHeight = '500px';
                    } else {
                        content.style.maxHeight = null;
                    }
                });
            });

            // Handle chips selection (single select)
            const chips = document.querySelectorAll('.chip');
            chips.forEach(chip => {
                chip.addEventListener('click', function() {
                    const section = this.getAttribute('data-section');
                    const value = this.textContent;

                    // Deselect all chips in this section
                    document.querySelectorAll(`.chip[data-section="${section}"]`).forEach(c => {
                        c.classList.remove('active');
                    });

                    // Select this chip
                    this.classList.add('active');

                    // Update selection
                    selections[section] = value;

                    // Update UI
                    updateSelectionText(section, value);
                    updateProgress(section);

                    // Auto-close section after selection (optional)
                    // setTimeout(() => {
                    //     const nextSection = getNextSection(section);
                    //     if (nextSection) {
                    //         document.querySelector(`[data-section="${nextSection}"]`).click();
                    //     }
                    // }, 500);
                });
            });

            // Handle keyword input
            const motCleInput = document.getElementById('motCleInput');
            motCleInput.addEventListener('input', function() {
                selections.motCle = this.value;
                updateSelectionText('motCle', this.value);
                updateProgress('motCle');
            });

            // Filter chips based on input
            const filterInputs = document.querySelectorAll('#localisationInput, #typesAnnonceInput');
            filterInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const section = this.id.replace('Input', '');
                    const searchTerm = this.value.toLowerCase();
                    const chipsContainer = document.getElementById(section + 'Chips');
                    const chips = chipsContainer.querySelectorAll('.chip');

                    let visibleCount = 0;

                    chips.forEach(chip => {
                        const text = chip.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            chip.style.display = 'inline-flex';
                            visibleCount++;
                        } else {
                            chip.style.display = 'none';
                        }
                    });

                    // Add "no results" message if no chips match
                    const noResults = chipsContainer.querySelector('.no-results');
                    if (visibleCount === 0 && searchTerm !== '') {
                        if (!noResults) {
                            const message = document.createElement('div');
                            message.classList.add('no-results');
                            message.textContent = 'Aucun résultat trouvé';
                            message.style.padding = '10px';
                            message.style.color = '#666';
                            chipsContainer.appendChild(message);
                        }
                    } else if (noResults) {
                        noResults.remove();
                    }
                });
            });

            // Clear all selections
            const clearBtn = document.getElementById('clearBtn');
            clearBtn.addEventListener('click', function() {
                // Clear chips
                document.querySelectorAll('.chip.active').forEach(chip => {
                    chip.classList.remove('active');
                });

                // Clear inputs
                document.querySelectorAll('input').forEach(input => {
                    input.value = '';
                });

                // Reset chip visibility
                document.querySelectorAll('.chip').forEach(chip => {
                    chip.style.display = 'inline-flex';
                });

                // Remove "no results" messages
                document.querySelectorAll('.no-results').forEach(el => el.remove());

                // Reset selections
                selections.motCle = '';
                selections.localisation = '';
                selections.typesAnnonce = '';

                // Update UI
                updateSelectionText('motCle', '');
                updateSelectionText('localisation', '');
                updateSelectionText('typesAnnonce', '');
                updateProgress('motCle');
                updateProgress('localisation');
                updateProgress('typesAnnonce');
            });

            // Search button animation
            const searchBtn = document.getElementById('searchBtn');
            searchBtn.addEventListener('click', function() {
                // Add pulse animation
                this.style.animation = 'pulse 0.8s';

                // Remove animation after completion
                setTimeout(() => {
                    this.style.animation = '';
                    let searchUrl = "/search";
                    let params = [];

                    if (selections.motCle) {
                        params.push(`key=${encodeURIComponent(selections.motCle)}`);
                    }

                    if (selections.localisation) {
                        params.push(`location=${encodeURIComponent(selections.localisation)}`);
                    }

                    if (selections.typesAnnonce) {
                        // If it's an array, map it to multiple type[]=value entries
                        if (Array.isArray(selections.typesAnnonce)) {
                            selections.typesAnnonce.forEach(type => {
                                params.push(`type[]=${encodeURIComponent(type)}`);
                            });
                        } else {
                            params.push(`type[]=${encodeURIComponent(selections.typesAnnonce)}`);
                        }
                    }

                    if (params.length > 0) {
                        searchUrl += "?" + params.join("&");
                    }

                    window.location.href = searchUrl
                }, 800);
            });

            // Update selection text in accordion header
            function updateSelectionText(section, value) {
                const selectionText = document.getElementById(section + 'Selection');

                if (value) {
                    selectionText.textContent = value;
                    selectionText.classList.add('active');
                } else {
                    selectionText.textContent = '';
                    selectionText.classList.remove('active');
                }
            }

            // Update progress bar
            function updateProgress(section) {
                const progress = document.getElementById(section + 'Progress');
                let percentage = 0;

                if (selections[section]) {
                    percentage = 100;
                }

                progress.style.width = percentage + '%';
            }

            // Get next section (for auto-advancing)
            function getNextSection(currentSection) {
                const sections = ['motCle', 'localisation', 'typesAnnonce'];
                const currentIndex = sections.indexOf(currentSection);

                if (currentIndex < sections.length - 1) {
                    return sections[currentIndex + 1];
                }

                return null;
            }

            // Focus on the first input when modal opens
            const searchModal = document.getElementById('searchModal');
            searchModal.addEventListener('shown.bs.modal', function() {
                document.getElementById('motCleInput').focus();
            });
        });
    </script>
@endsection
