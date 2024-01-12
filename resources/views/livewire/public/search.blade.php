<div>
    <!-- ================ Listing In Grid Style ======================= -->
    <section class="padd-top-20">
        <div class="container">
            <div class="row">

                <!-- Start Sidebar -->
                <div class="col-md-4 col-sm-12">
                    <h4 class="text-center mrg-bot-15">Filtrer vos recherches</h4>
                    <div class="sidebar">
                        <!-- Start: Search By Price -->
                        <div class="widget-boxed padd-bot-10">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-briefcase padd-r-10"></i>Types d'annonce
                            </div>
                            <div class="widget-boxed-body padd-top-10 padd-bot-0">
                                <div class="side-list">
                                    <ul class="price-range">
                                        @foreach ($typesAnnonce as $type)
                                            <li>
                                                <span class="custom-checkbox d-block">
                                                    <input id="check-{{ $type }}" type="checkbox" value="{{ $type }}" wire:change='changeState("{{ $type }}")' {{ in_array($type, $selectedAnnonceId) ? 'checked' : '' }}>
                                                    <label for="check-{{ $type }}" style="font-weight: normal;">{{ $type }}</label>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if (count($allAnnonceTypes) > count($typesAnnonce))
                                <div class="text-center padd-top-5 padd-bot-0">
                                    <a href="javascript:void(0)" wire:click='loadMoreAnnonceType'>
                                        <h5>Voir plus ({{ count($allAnnonceTypes) - count($typesAnnonce) }}) +</h5>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- End: Search By Price -->

                        <!-- Start: Latest Listing -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-check-box padd-r-10"></i>Dernières annonces</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5" wire:ignore>
                                <div class="side-list">
                                    <ul class="listing-list">
                                        @foreach ($latestAnnonces as $annonce)
                                            <li>
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    <div class="listing-list-img">
                                                        <img src="http://via.placeholder.com/100x100" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                                <div class="listing-list-info">
                                                    <h5><a href="{{ route('show', $annonce->slug) }}" title="Listing">{{ $annonce->titre }}</a></h5>
                                                    <div class="listing-post-meta">
                                                        <span class="updated">{{ date('d-m-Y', strtotime($annonce->created_at)) }}</span> | <a href="{{ route('search.key.type', ['', $annonce->type]) }}" rel="tag">{{ $annonce->type }}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Latest Listing -->

                        <!-- Start: Help & Support -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-body padd-top-40 padd-bot-40 text-center">
                                <div class="help-support">
                                    <i class="ti-headphone-alt font-60 theme-cl mrg-bot-15"></i>
                                    <p>Vous avez une question ? Contactez-nous</p>
                                    <h4 class="mrg-top-0">contact@numrod.fr</h4>
                                </div>
                            </div>
                        </div>
                        <!-- End: Help & Support -->
                    </div>
                </div>
                <!-- End Start Sidebar -->

                <!-- Start All Listing -->
                <div class="col-md-8 col-sm-12">
                    <!-- Filter option -->
                    <div class="row mrg-0 mrg-bot-20">
                        <div class="col-md-6 mrg-top-10">
                            <h5>Affichage : {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} résultat trouvé(s)</h5>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <select id="select-order" class="form-control" style="height: 35px !important; margin-bottom: 0px;" tabindex="-98" wire:model.lazy='sortOrder'>
                                <option value="">Trier</option>
                                <option value="titre|asc">Titre: A à Z</option>
                                <option value="titre|desc">Titre: Z à A</option>
                                <option value="created_at|asc">Date: Ancien à récent</option>
                                <option value="created_at|desc">Date: Récent à ancien</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Filter option -->
                    <div class="row mrg-0">
                        @foreach ($annonces as $annonce)
                            <div class="col-md-6 col-sm-6">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-img">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            <img src="http://via.placeholder.com/800x800" class="img-responsive" alt="">
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
                        @empty($annonces->items())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-caption text-center mrg-top-5">
                                        <h4>Aucune annonce trouvée</h4>
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </div>
                    {{ $annonces->links() }}
                </div>
                <!-- End All Listing -->
            </div>
            <!-- End Pagination -->
        </div>
    </section>
    <!-- ================ End Listing In Grid Style ======================= -->
</div>
