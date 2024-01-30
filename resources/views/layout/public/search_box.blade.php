@props(['detail' => false])

@php
    $typeAnnonce = App\Models\Annonce::pluck('type')
        ->unique()
        ->toArray();

    $search = new App\Utils\CustomSession();
    $key = $search->key;
    $type = $search->type;
@endphp

<!-- ================ Start Page Title ======================= -->
<section class="title-transparent page-title" style="background:url(http://via.placeholder.com/1920x850);">
    <div class="container">
        <div class="title-content">
            <h1>Vamiyi</h1>
            <div class="breadcrumbs">
                <a href="{{ route('accueil') }}">Accueil</a>
                <span class="gt3_breadcrumb_divider"></span>
                @if ($detail)
                    {{-- <a href="#" style="color: white;" onclick="event.preventDefault(); history.back();">Résultat</a> --}}
                    <span class="current">Résultat</span>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Détail</span>
                @else
                    <span class="current">Résultat</span>
                @endif
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<!-- ================ End Page Title ======================= -->

<!-- ================ Listing In Grid Style ======================= -->
<section class="padd-top-0 padd-bot-0 overlap">
    <div class="container">
        <!-- Searc Filter -->
        <div class="row">
            <div class="white-box white-shadow padd-top-30 padd-bot-30 translateY-60">
                <h3 class="text-center">Recherche</h3>
                <form class="form-verticle" method="GET" action="{{ route('search') }}">
                    <div class="col-md-5 col-sm-5 no-padd">
                        <input type="text" class="form-control left-radius" placeholder="Mot clé .." name="key" value="{{ $key }}">
                    </div>
                    <div class="col-md-4 col-sm-4 no-padd">
                        <select class="selectpicker form-control" data-live-search="true" name="type" value="{{ $type }}">
                            <option value="" selected>Tous les types d'annonce</option>
                            @foreach ($typeAnnonce as $annonce)
                                <option value="{{ $annonce }}" {{ $annonce == $type ? 'selected' : '' }}>{{ $annonce }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 no-padd">
                        <button type="submit" class="btn theme-btn normal-height full-width">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
