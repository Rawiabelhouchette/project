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

                        <x-public.property-item :annonces="$annonces" :mode="'row'" showDelete="true" :deleteType="'delete'"/>

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
