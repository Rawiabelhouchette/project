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

        .listing-price-info {
            position: absolute;
            top: 20px;
            left: 20px;
            display: inline-block;
            border-radius: 50px;
            font-size: 14px;
        }

        .listing-price-info span {
            display: inline-block;
            /* background: #ffffff; */
            /* background: #de6600; */
            color: #ffffff !important;
            padding: 4px 18px;
            border-radius: 50px;
            font-size: 14px;
            margin-right: 15px;
            color: #505667;
            box-shadow: 0px 0px 0px 5px rgba(255, 255, 255, 0.2);
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
    </style>

    <div class="padd-l-0 padd-r-0">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6" style="margin-top: 10px;">
                    <span id="nbre-favoris" class="mrg-l-10">{{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur
                        {{ $annonces->total() }} favori(s)</span>
                </div>
                <div class="col-md-6 text-center">
                    <input id="favorite_search" class="form-control" type="text" value="" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="small-list-wrapper">
                <div id="table" class="row">

                    <x-public.property-item :annonces="$annonces" :mode="'row'" showDelete="true" />

                    @empty($annonces->items())
                        <div class="col-md-12 col-sm-12">
                            <div class="listing-shot grid-style">
                                <div class="listing-shot-caption mrg-top-20 mrg-bot-20 text-center">
                                    <h4>Aucun favori trouvé</h4>
                                </div>
                            </div>
                        </div>
                    @endempty
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {{ $annonces->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function confirmRemoveFavorite(annonceId) {
            const params = {
                message: 'Voulez-vous vraiment retirer cette annonce de vos favoris ?',
                icon: 'warning',
                confirmButtonText: 'Oui, retirer',
                onConfirm: function() {
                    Livewire.dispatch('updateFavoris', [annonceId]);
                }
            };

            showConfirmationNotification(params);
        }
    </script>
@endpush
