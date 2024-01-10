@extends('layout.public.app')

@section('content')
    <!-- Main Banner Section Start -->
    <div class="banner dark-opacity" style="background-image:url(http://via.placeholder.com/1920x1000);" data-overlay="8">
        <div class="container">
            <div class="banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <h1>Vamiyi</h1>
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
                                    <option value="" data-placeholder="{{ __('Choisir le type d\'annonce') }}" class="chosen-select">{{ __('Choisir le type d\'annonce') }}</option>
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
                        <div class="image">
                            <a href="{{ route('show', $annonce->slug) }}" class="listing-thumb">
                                <img src="http://via.placeholder.com/1200x800" alt="latest property" class="img-responsive">
                            </a>
                            <div class="listing-price-info">
                                {{-- <span class="pricetag">Featured</span>
                                    <span class="pricetag">$25 - $65</span> --}}
                            </div>
                            {{-- <a href="#" class="tag_t"><i class="ti-heart"></i>Save</a>
                                <span class="list-rate good">4.2</span> --}}
                        </div>

                        <div class="proerty_content">
                            <div class="author-avater">
                                <img src="http://via.placeholder.com/120x120" class="author-avater-img" alt="">
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
                                <a href="{{ route('entreprise.show', $annonce->entreprise->slug) }}" class="cat-icon cl-1">
                                    <i class="fas fa-building"></i> {{ $annonce->entreprise->nom }}
                                </a>
                                <span class="more-cat" style="">+{{ $annonce->entreprise->nombre_annonces }}</span>
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
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>
@endsection
