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
                        <div class="widget-boxed padd-bot-10 mrg-bot-10">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-briefcase padd-r-10"></i>Types d'annonce
                            </div>
                            <div class="widget-boxed-body padd-top-10">
                                <div class="side-list">
                                    <ul class="price-range" id="list-types">
                                        @foreach ($typeAnnonces as $item)
                                            <li style="padding: 5px;">
                                                <span class="custom-checkbox d-block padd-top-0">
                                                    <input id="check-{{ $item }}" type="checkbox" value="{{ $item }}" wire:change='changeState("{{ $item }}")' {{ in_array($item, $type) ? 'checked' : '' }}>
                                                    <label for="check-{{ $item }}" style="font-weight: normal;">{{ $item }}</label>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            @if (count($typeAnnonces) > 5)
                                <div class="text-center padd-top-5 padd-bot-0" id="voir-plus-zone-type">
                                    <a href="javascript:void(0)" id="voir-plus-btn-type">
                                        <h5>Voir plus ({{ count($typeAnnonces) - 5 }}) +</h5>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- End: Search By Price -->

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
                    {{-- <div class="row mrg-0">
                        <div class="col-md-12 mrg-top-10">
                            <div class="col-md-12" style="margin-left: 0px; padding-left: 0px; display: flex; align-items: center; ">
                                Recherche : &nbsp;
                                @foreach (['test1', 'test3', 'Lome'] as $element)
                                    <span class="badge height-25" style="background-color: #ff3a72">
                                        {{ $element }}
                                        <a href="javascript:void(0)" class="filtre" data-slug="{{ $element }}" style="color: #35434E"> x </a>
                                    </span> &nbsp;
                                @endforeach
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mrg-0">
                        <div class="col-md-6 mrg-top-10">
                            <h5>Affichage : {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} résultat trouvé(s)</h5>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <select id="select-order" class="form-control" style="height: 35px !important; margin-bottom: 0px;" tabindex="-98" wire:model.lazy='sortOrder'>
                                <option value="" disabled>Trier</option>
                                <option value="titre|asc">Titre: A à Z</option>
                                <option value="titre|desc">Titre: Z à A</option>
                                <option value="created_at|asc">Date: Ancien à récent</option>
                                <option value="created_at|desc">Date: Récent à ancien</option>
                            </select>
                        </div>
                        <div class="col-md-1" style="display: flex; top: 50%">
                            <a href="javascript:void(0)" class="annonce-share" data-toggle="modal" data-target="#share" data-type="all">
                                <i class="fa fa-share fa-lg" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End Filter option -->
                    <div class="row mrg-0">

                        {{-- button --}}

                        @include('components.share-modal', [
                            'title' => 'Partager cette annonce',
                        ])

                        @if ($isLoading)
                            @include('components.loader')
                        @endif

                        @forelse ($annonces as $annonce)
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

                                        <div class="listing-shot-info rating padd-0">
                                            {{ $annonce->note }}
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                            &nbsp;&nbsp;
                                            ({{ $annonce->nb_notation }})
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#share" class="theme-cl annonce-share" style="float: right;"
                                               data-url="{{ route('show', $annonce->slug) }}"
                                               data-titre="{{ $annonce->titre }}"
                                               data-image="{{ $annonce->image ? asset('storage/' . $annonce->imagePrincipale->chemin) : 'http://via.placeholder.com/800x800' }}"
                                               data-type="{{ $annonce->type }}">
                                                <i class="fa fa-share theme-cl" aria-hidden="true"></i>
                                                Partager
                                            </a>
                                        </div>
                                    </div>
                                    <div class="tp-author-basic-info mrg-top-0">
                                        <ul>
                                            <li class="text-center padd-top-10 padd-bot-0">
                                                <i class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                                {{ $annonce->nb_vue }}
                                            </li>
                                            <li class="text-center padd-top-10 padd-bot-0">
                                                <i class="fa fa-heart fa-lg" aria-hidden="true"></i>
                                                {{ $annonce->nb_favoris }}
                                            </li>
                                            <li class="text-center padd-top-10 padd-bot-0">
                                                <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                                                {{ $annonce->nb_commentaire }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style" style="padding-top: 50px; padding-bottom: 50px;">
                                    <div class="listing-shot-caption text-center mrg-top-5">
                                        <h4>Aucune annonce trouvée</h4>
                                    </div>
                                </div>
                            </div>
                        @endforelse
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

@push('scripts')
    <script src="{{ asset('assets_client/js/search.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.annonce-share').on('click', function() {
                var type = $(this).data('type');
                var text;
                $('#share-annonce-image').show();
                if (type === 'all') {
                    text = window.location.href;
                    $('#share-annonce-image').hide();
                    $('#annonce-type').text('');
                    $('#annonce-titre').text("Partager la page");
                    $('#annonce-email').attr('href', 'mailto:?subject=' + $(this).data('titre') + '&body=' + text);
                    $('#annonce-url').data('url', text);
                    $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + text);
                } else {
                    text = "Salut!%0AJette un œil à l'annonce que j’ai trouvé sur Vamiyi%0ATitre : " + $(this).data('titre') + "%0ALien : " + $(this).data('url') + " ";
                    $('#annonce-titre').text($(this).data('titre'));
                    $('#annonce-image-url').attr('src', $(this).data('image'));
                    $('#annonce-type').text($(this).data('type'));
                    $('#annonce-email').attr('href', 'mailto:?subject=' + $(this).data('titre') + '&body=' + text);
                    $('#annonce-url').data('url', $(this).data('url'));
                    $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + $(this).data('url'));
                }

                $('#annonce-whatsapp').attr('href', 'https://web.whatsapp.com/send?text=' + text);
            });

            $('#annonce-url').click(function() {
                var text = $(this).data('url');

                if (!navigator.clipboard) {
                    console.log('Clipboard API not available');
                    return;
                }

                navigator.clipboard.writeText(text).then(function() {
                    $('#copyMessage').hide();
                    $('#copyMessage').show();
                    setTimeout(function() {
                        $('#copyMessage').hide();
                    }, 2000);
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        });
    </script>
@endpush
