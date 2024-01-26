@extends('layout.public.app')

@section('content')
    <!-- Main Banner Section Start -->
    <div class="banner dark-opacity" style="background-image:url(http://via.placeholder.com/1920x1000);" data-overlay="8">
        <div class="container">
            <div class="banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    {{-- <h1>Vamiyi</h1> --}}
                    <h1 {{-- set the weiht of the text in style attribute --}} style="font-size: 50px; ">Vamiyi, l'aventure commence ici</h1>

                    <p>Explorez les meilleurs endroits, des restaurants et plus encore...</p>
                    <form class="form-verticle" method="GET" action="{{ route('search') }}">
                        <div class="col-md-6 col-sm-5 no-padd">
                            <i class="banner-icon icon-pencil"></i>
                            <input type="text" class="form-control left-radius right-br" placeholder="{{ __('Mot clé ..') }}" name="key">
                        </div>
                        {{-- <div class="col-md-3 col-sm-3 no-padd">
                            <div class="form-box">
                                <i class="banner-icon icon-map-pin"></i>
                                <input type="text" class="form-control right-br" placeholder="Location..">
                            </div>
                        </div> --}}
                        <div class="col-md-4 col-sm-4 no-padd">
                            <div class="form-box">
                                <i class="banner-icon icon-layers"></i>
                                <select class="form-control" name="type">
                                    <option value="" selected data-placeholder="{{ __('Tous les types d\'annonce') }}" class="chosen-select">{{ __('Tous les type d\'annonce') }}</option>
                                    @foreach ($typeAnnonce as $annonce)
                                        <option value="{{ $annonce }}">{{ $annonce }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-3 no-padd">
                            <div class="form-box">
                                <button type="submit" class="btn theme-btn btn-default">
                                    {{-- <i class="ti-search"></i> --}}
                                    {{ __('Rechercher') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="popular-categories">
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
                </div>
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
            <div class="col-md-10 col-md-offset-1">
                <div class="heading">
                    {{-- <h2>Top & Popular <span>Listings</span></h2> --}}
                    <h2>Top & Populaire <span>Annonces</span></h2>
                    <p>Explorez les meilleurs endroits, des restaurants , des hôtels, des auberges et plus encore...</p>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Single List -->
            @foreach ($annonces as $annonce)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="property_item classical-list">
                        <div class="image" style="height: 200px important">
                            <a href="{{ route('show', $annonce->slug) }}" class="listing-thumb">
                                @if ($annonce->image)
                                    <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="latest property" class="img-responsive" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                                @else
                                    <img src="http://via.placeholder.com/1200x800" alt="latest property" class="img-responsive">
                                @endif
                            </a>
                            {{-- <div class="listing-price-info">
                                <span class="pricetag">{{ $annonce->type }}</span>
                            </div> --}}
                        </div>

                        <div class="proerty_content">
                            <div class="author-avater">
                                @if ($annonce->image)
                                    <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="latest property" class="author-avater-img" style="width: 70px; height: 70px;">
                                @else
                                    <img src="http://via.placeholder.com/120x120" class="author-avater-img" alt="">
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
                            <p class="property_add">{{ $annonce->type }}</p>
                            <div class="property_meta">
                                <div class="list-fx-features">
                                    <div class="listing-card-info-icon">
                                        <span class="inc-fleat inc-add">
                                            {{ $annonce->entreprise->adresse_complete }}
                                        </span>
                                    </div>
                                    <div class="listing-card-info-icon">
                                        <span class="inc-fleat inc-call">
                                            <a href="tel:{{ $annonce->entreprise->quartier->ville->pays->indicatif }}{{ str_replace(' ', '', $annonce->entreprise->telephone) }}">
                                                {{ $annonce->entreprise->quartier->ville->pays->indicatif }} {{ $annonce->entreprise->telephone }}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="listing-footer-info">
                            <div class="listing-cat">
                                <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}" class=" cl-1">
                                    <span class="more-cat mrg-l-0" style="">
                                        <i class="fas fa-building"></i>
                                    </span> &nbsp;
                                    {{ $annonce->entreprise->nom }}
                                </a>
                            </div>
                            @if ($annonce->entreprise->est_ouverte)
                                <span class="place-status">Ouvert</span>
                            @else
                                <span class="place-status closed">Fermée</span>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
<!-- End Listings Section -->

<!-- Category Section -->
<section class="bg-image" style="background-image:url(http://via.placeholder.com/1920x1000);" data-overlay="6">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="heading light">
                    <h2>Les types <span>d'annonce </span></h2>
                    <p>Les types d'annonce que les gens visitent le plus, les plus populaires</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="category-slide">
                @foreach ($listAnnonce as $list)
                    <div class="list-slide-box">
                        <div class="category-full-widget">
                            <div class="category-widget-bg" style="background-image: url(http://via.placeholder.com/1200x900);">
                                <i class="bg-{{ $list->bg }} cat-icon {{ $list->icon }}" aria-hidden="true"></i>
                            </div>
                            <div class="cat-box-name">
                                <h4>{{ $list->nom }}</h4>
                                <a href="{{ route('search.key.type', ['', $list->nom]) }}" class="btn-btn-wrowse">Parcourir</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
<!-- End Category Section -->

<!-- Top Places Listing -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="heading">
                    <h2>Les types d'annonce</h2>
                    <p>La liste des types d'annonce</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($statsAnnonce as $key => $stat)
                <div class="col-md-{{ $key % 4 == 0 || $key % 4 == 3 ? '4' : '8' }} col-sm-{{ $key % 4 == 0 || $key % 4 == 3 ? '5' : '7' }}">
                    <a href="{{ route('search.key.type', ['', $stat->type]) }}" class="place-box">
                        <span class="listing-count">{{ $stat->count }} Annonce(s)</span>
                        <div class="place-box-content">
                            <h4>{{ $stat->type }}</h4>
                            <span>Voir les annonces</span>
                        </div>
                        <div class="place-box-bg" style="background-image: url(http://via.placeholder.com/1280x850);"></div>
                    </a>
                </div>
            @endforeach
        </div>

</section>

{{-- @include('cookie-consent::index') --}}
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>
@endsection
