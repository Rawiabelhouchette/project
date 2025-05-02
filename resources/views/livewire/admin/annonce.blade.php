<div class="col-md-12 col-sm-12">

    <style>
        .tp-author-basic-info {
            margin: 30px 0 0 0;
            padding: 0 25px;
            border-top: 1px solid #ebedf1;
        }

        .tp-author-basic-info ul {
            width: 100%;
            display: table;
        }

        .tp-author-basic-info li {
            list-style: none;
            display: inline-block;
            width: 33.333333%;
            padding: 15px 0 10px;
        }

        .tp-author-basic-info li strong {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #384454;
        }

        .listing-location {
            height: 50px !important;
        }

        .img-responsive {
            object-fit: cover;
            object-position: center;
            width: 100%;
            height: 100%;
        }

        .custom-field-filter {
            margin-top: 6px !important;
            /* margin-bottom: 6px !important;
            height: 40px !important; */
        }
    </style>
    <div class="container">
        <div style="margin-top: 10px;">
            <span id="nbre-favoris" class="mrg-l-10">
                {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }}
                annonce(s)
            </span>
        </div>
        <div class="col-12 col-md-4 mb-md-0 mb-2 p-0">
            <select class="form-control custom-field-filter" wire:model.live="type"
                style="padding-top: 0; padding-bottom: 0;">
                <option value="">Tous les types</option>
                @foreach ($types as $type)
                    <option value="{{ $type->valeur }}">{{ $type->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 mb-md-0 mb-2">
            <select class="form-control custom-field-filter" wire:model.live="is_published"
                style="padding-top: 0; padding-bottom: 0;">
                <option value="">Toutes les annonces</option>
                <option value="1">Annonces publiées</option>
                <option value="0">Annonces non publiées</option>
            </select>
        </div>
        <div class="col-12 col-md-4 p-0">
            <input id="favorite_search" class="form-control custom-field-filter" type="search" value=""
                placeholder="Rechercher" wire:model.live.debounce.500ms='search'>
        </div>
    </div>
    <div class="card">
        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="small-list-wrapper">
                    <ul id="table">
                        <div class="col-md-12 col-sm-12" wire:loading wire:transition>
                            <h4 class="mt-3 text-center">Chargement...</h4>
                        </div>

                        @foreach ($annonces as $annonce)
                            <div class="col-md-4 col-xs-6 col-lg-4 col-xl-3">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-img">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            @if ($annonce->image)
                                                <img class="img-responsive" src="https://placehold.co/600"
                                                    alt="">
                                            @else
                                                <img class="img-responsive" src="http://via.placeholder.com/800x800"
                                                    alt="">
                                            @endif
                                        </a>
                                        @if ($annonce->is_active && $annonce->date_validite >= now())
                                            <span class="approve-listing" title="Annonce publiée">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        @else
                                            <span class="not-approve-listing" title="Annonce non publiée">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="listing-shot-caption">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            <h4>{{ Str::limit($annonce->titre, 24, '...') }}</h4>
                                            <span class="listing-location">{{ $annonce->description_courte }}</span>
                                        </a>
                                        <a class="listing-shot-edit"
                                            href="{{ $annonce->annonceable->public_edit_url ?? '#' }}">
                                            <span class="like-listing alt style-2" style="right: 50px;"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></span>
                                        </a>
                                        <a class="listing-shot-edit"
                                            href="{{ $annonce->annonceable->public_edit_url ?? '#' }}">
                                            <span class="like-listing alt style-2" style="right: 5px;"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    <div class="listing-price-info">
                                        <span class="pricetag">{{ $annonce->type }} </span>

                                    </div>
                                    {{-- <div class="listing-shot-info">
                                        <div class="row extra">
                                            <div class="col-md-12">
                                                <div class="listing-detail-info">
                                                    <span><i class="fa fa-phone" aria-hidden="true"></i>
                                                        {{ $annonce->entreprise->contact }}</span>
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
                                    </div> --}}
                                    <div class="listing-shot-info rating">
                                        <div class="d-md-flex" style="font-size: 14px;gap: 25px">
                                            <div class="text-center">
                                                <a href="#">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </a> {{ $annonce->nb_partage ?? 0 }}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $annonce->view_count }}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                                {{ $annonce->comment_count }}
                                            </div>
                                            <div class="text-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star"
                                                        aria-hidden="true"></i>
                                                @endfor
                                                &nbsp;&nbsp;
                                                {{ $annonce->note }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @empty($annonces->items())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-caption mrg-top-20 mrg-bot-20 text-center">
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
