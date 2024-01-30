<div class="col-md-9 col-sm-12">
    <div class="card">
        {{-- <div class="card-header facette-color">
            <div class="col-md-6 text-left">
                <h4>
                    <i class="fa fa-list" style="font-size: 15px;"></i> &nbsp;Liste des favoris
                </h4>
            </div>
            <div class="col-md-6 text-right"></div>
        </div> --}}

        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3 text-left" style="margin-top: 10px;">
                        <span id="nbre-favoris">{{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} favori(s)</span>
                    </div>
                    <div class="col-md-7 text-center">
                        <input type="text" value="" class="form-control" id="filterInput" placeholder="Afficher la recherche" style="margin-top: 6px; margin-bottom: 6px; height: 35px;">
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="small-list-wrapper">
                    <ul id="table">
                        @foreach ($annonces as $annonce)
                            <div class="col-md-6 col-sm-6">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-img">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            @if ($annonce->image)
                                                <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="">
                                            @else
                                                <img src="http://via.placeholder.com/800x800" class="img-responsive" alt="">
                                            @endif
                                        </a>
                                        {{-- <span class="approve-listing"><i class="fa fa-check"></i></span> --}}
                                    </div>
                                    <div class="listing-shot-caption">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            <h4>{{ $annonce->titre }}</h4>
                                            <p class="listing-location">{{ $annonce->description_courte }}</p>
                                        </a>
                                        @if (Auth::check())
                                            {{-- @if ($annonce->est_favoris)
                                                <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                                    <span class="like-listing style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                </a>
                                            @else --}}
                                                <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                                    <span class="like-listing @if(!$annonce->est_favoris) alt @endif style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                </a>
                                            {{-- @endif --}}
                                        @else
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#signin" data-toggle="modal" data-target="#signin">
                                                <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="listing-price-info">
                                        <span class="pricetag">{{ $annonce->type }} </span>

                                    </div>
                                    <div class="listing-shot-info">
                                        <div class="row extra">
                                            <div class="col-md-12">
                                                <div class="listing-detail-info">
                                                    <span><i class="fa fa-phone" aria-hidden="true"></i> {{ $annonce->entreprise->contact }}</span>
                                                    <span>
                                                        <i class="fa fa-globe" aria-hidden="true"></i>
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

                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <a href="#">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </a> {{ $annonce->nb_partage }}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $annonce->nb_vue }}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-comment" aria-hidden="true"></i> {{ $annonce->nb_commentaire }}
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                                    @endfor
                                                    &nbsp;&nbsp;
                                                    {{ $annonce->nb_notation }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @empty($annonces->items())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-caption text-center mrg-top-5">
                                        <h4>Aucune annonce trouvée</h4>
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                {{ $annonces->links() }}
            </div>
        </div>
    </div>
</div>