@props(['annonce'])

<div class="row bott-wid">

    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Prévisualisation de l'annonce</h4>
            </div>
        </div>
    </div>

    <!-- Single Listing -->
    <div class="col-md-4 col-sm-6">
        <div class="listing-shot grid-style">
            <a href="{{ route('show', $annonce->slug) }}" target="_blank">
                <div class="listing-shot-img">
                    <img src="http://via.placeholder.com/800x600" class="img-responsive" alt="">
                </div>
                <div class="listing-shot-caption">
                    <h4>{{ $annonce->titre }}</h4>
                    <p class="listing-location">{{ $annonce->entreprise->adresse_complete }}</p>
                </div>
            </a>
            <div class="listing-shot-info">
                <div class="row extra">
                    <div class="col-md-12">
                        <div class="listing-detail-info">
                            <span><i class="fa fa-phone" aria-hidden="true"></i> {{ $annonce->entreprise->contact }}</span>
                            <span><i class="fa fa-globe" aria-hidden="true"></i>
                                @if ($annonce->entreprise->site_web)
                                    {{ $annonce->entreprise->site_web }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listing-shot-info rating">
                <div class="row extra">
                    <div class="col-md-7 col-sm-7 col-xs-6">
                        {{ $annonce->type }}
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-6 pull-right">
                        <a href="{{ route('show', $annonce->slug) }}" target="_blank" class="detail-link">Ouvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
