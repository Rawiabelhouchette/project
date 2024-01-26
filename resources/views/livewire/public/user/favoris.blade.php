<div class="col-md-9 col-sm-12">
    <div class="card">
        <div class="card-header facette-color">
            <div class="col-md-6 text-left">
                <h4>
                    <i class="fa fa-list" style="font-size: 15px;"></i> &nbsp;Liste des favoris
                </h4>
            </div>
            <div class="col-md-6 text-right"></div>
        </div>
        <div class="card-header" style="margin: 0px; padding: 0px;">
            <div class="col-md-2 text-left" style="margin-top: 10px;">
                {{-- <span id="nbre-favoris">{{ $favoris->total() }}</span> favoris --}}
            </div>
            <div class="col-md-6 text-center">
                <input type="text" value="" class="form-control" id="filterInput" placeholder="Afficher la recherche" style="margin-top: 6px; margin-bottom: 6px; height: 35px;">
            </div>
            <div class="col-md-4 text-right" style="margin: 0px; padding: 0px;">
                {{-- {{ $favoris->links() }} --}}
            </div>
        </div>

        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="small-list-wrapper">
                            <ul id="table">
                                <div class="row mrg-0">
                                    @foreach ($favoris as $annonce)
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
                                                    @if (Auth::check() && Auth::user()->hasRole('Usager'))
                                                        @if ($annonce->est_favoris)
                                                            <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                                                <span class="like-listing style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                                                <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                            </a>
                                                        @endif
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
            
                                                            {{-- <i class="color fa fa-star" aria-hidden="true"></i>
                                                            <i class="color fa fa-star" aria-hidden="true"></i>
                                                            <i class="color fa fa-star" aria-hidden="true"></i>
                                                            <i class="color fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i> --}}
                                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                                                @endfor
                                                                &nbsp;&nbsp;
                                                                {{ $annonce->nb_notation }}
                                                            </div>
                                                            {{-- <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= intval($annonce->note))
                                                                        <i class="color fa fa-star" aria-hidden="true"></i>
                                                                    @elseif ($i == intval($annonce->note) + 1 && $annonce->note - intval($annonce->note) > 0)
                                                                        <i class="color fa fa-star-half-o" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    @endif
                                                                @endfor
                                                            </div> --}}
                                                        </div>
                                                        {{-- <div class="col-md-5 col-sm-5 col-xs-6 pull-right text-right">
                                                            <i class="fa fa-eye" aria-hidden="true"></i> 1233,43k
                                                            &nbsp;
                                                            <i class="fa fa-comment" aria-hidden="true"></i> 1233,43k
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        {{-- <div class="col-md-6 col-sm-6">
                                            <div class="listing-shot grid-style">
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    <div class="listing-shot-img">
                                                        <img src="http://via.placeholder.com/800x800" class="img-responsive" alt="">
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
                                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                                            {{ $annonce->type }}
                                                        </div>
                                                        <div class="col-md-5 col-sm-5 col-xs-6 pull-right">
                                                            <a href="{{ route('show', $annonce->slug) }}" class="detail-link">Ouvrir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    @endforeach
                                    @empty($favoris->items())
                                        <div class="col-md-12 col-sm-12">
                                            <div class="listing-shot grid-style">
                                                <div class="listing-shot-caption text-center mrg-top-5">
                                                    <h4>Aucune annonce trouvée</h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endempty
                                </div>
                                {{ $favoris->links() }}
                                {{-- {{ $favoris->appends(['key' => $link_key, 'type' => $link_type])->links() }} --}}
            
                                {{-- @foreach ($favoris as $favori)
                                    <li id="element-{{ $favori->document->id }}">
                                        <div class="small-listing-box light-gray">
                                            <div class="small-list-img">
                                                <a href="{{ route('detailMemoire', ['id' => $favori->document_id]) }}">
                                                    @if ($favori->document->image_id)
                                                        <img src="{{ asset($favori->document->image->chemin) }}" class="img-responsive" alt="" />
                                                    @else
                                                        <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="" />
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="small-list-detail">
                                                <a href="{{ route('detailMemoire', ['id' => $favori->document_id]) }}">
                                                    <h5 title="{{ $favori->document->titre }}">{{ strlen($favori->document->titre) > 70 ? substr($favori->document->titre, 0, 70) . '...' : $favori->document->titre }}</h5>
                                                </a>
                                                <p class="mrg-bot-0">Par : <a href="javascript:void(0)">{{ $favori->document->auteur }}</a></p>
                                                <p>Sujet :
                                                    <a href="#" title="Food & restaurant">
                                                        @foreach ($favori->document->ref_sujet as $key => $sujet)
                                                            {{ $sujet->sujet->valeur }} ,
                                                            @php
                                                                if ($key == 2) {
                                                                    echo '...';
                                                                    break;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                    </a> | <span>{{ $favori->created_at->format('d-m-Y') }}</span>
                                                </p>
                                            </div>
                                            <div class="small-list-action">
                                                <a href="{{ route('detailMemoire', ['id' => $favori->document_id]) }}" class="light-gray-btn btn-square"><i class="ti-eye"></i></a>
                                                <a href="javascript:void(0)" class="light-red-btn btn-square" data-id="{{ $favori->document->id }}" data-url="{{ route('favoris.store') }}" data-token="{{ csrf_token() }}"><i class="ti-trash"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                @if ($favoris->count() == 0)
                                    <li class="text-center">
                                        <h5>Aucun élément</h5>
                                    </li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>