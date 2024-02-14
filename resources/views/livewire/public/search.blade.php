<div>
    <!-- ================ Listing In Grid Style ======================= -->
    <section class="padd-top-20">
        <div class="container">
            <div class="row">

                <!-- Start Sidebar -->
                <div class="col-md-4 col-sm-12">
                    <h4 class="text-center mrg-bot-15">Filtrer vos recherches</h4>

                    {{-- @if (count($this->type) != 0)
                        <p class="text-center" wire:transition>
                            <a href="javascript:void(0)" wire:click='resetFilter()'>
                                Effacer tous les filtres
                            </a>
                        </p>
                    @endif --}}

                    <div class="sidebar">
                        <div class="widget-boxed padd-bot-10 mrg-bot-10">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-user padd-r-10"></i>Titre
                            </div>
                            <div class="widget-boxed-body padd-top-10">
                                <div class="side-list">
                                    <input type="search" style="height: 40px; border-radius: 5px;" class="form-control" id="search-type" placeholder="Rechercher" onkeyup="filterList('type')">
                                    <ul class="price-range" id="list-types" style="min-height: 100px; max-height: 273px; overflow-y: auto;">
                                        @foreach ($type as $item)
                                            {{ $item }}
                                        @endforeach

                                        @foreach ($typeAnnonces as $item)
                                            {{ in_array($item['value'], $type) ? 'checked' : '' }}
                                            <li style="padding: 5px;">
                                                <span class="custom-checkbox d-block padd-top-0">
                                                    <input id="check-{{ $item['value'] }}" type="checkbox" value="{{ $item['value'] }}" wire:change='changeState("{{ $item['value'] }}", "type")' {{ in_array($item['value'], $type) ? 'checked' : null }}> {{-- wire:loading.attr="disabled"> --}}
                                                    <label for="check-{{ $item['value'] }}" style="font-weight: normal;">{{ $item['value'] }}</label>
                                                </span>
                                            </li>
                                        @endforeach
                                        <p id="no-type-results" class="text-center" style="display: none;">Aucun résultat</p>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- @include('components.public.filter-view', [
                            'title' => 'Types d\'annonce',
                            'category' => 'type',
                            'elements' => $typeAnnonces,
                            'selectedItems' => $type,
                            'icon' => 'ti-briefcase',
                        ])

                        @include('components.public.filter-view', [
                            'title' => 'Villes',
                            'category' => 'ville',
                            'elements' => $villes,
                            'selectedItems' => $ville,
                            'icon' => 'ti-location-pin',
                        ])

                        @include('components.public.filter-view', [
                            'title' => 'Quartiers',
                            'category' => 'quartier',
                            'elements' => $quartiers,
                            'selectedItems' => $quartier,
                            'icon' => 'ti-location-pin',
                        ])

                        @include('components.public.filter-view', [
                            'title' => 'Entreprises',
                            'category' => 'entreprise',
                            'elements' => $entreprises,
                            'selectedItems' => $entreprise,
                            'icon' => 'ti-user',
                        ]) --}}

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
                    @if (array_merge($type, $ville, $quartier))
                        <div class="row mrg-0 mrg-bot-10" wire:transition>
                            <div class="col-md-12 mrg-top-10">
                                <div class="col-md-12" style="margin-left: 0px; padding-left: 0px; display: ''; align-items: center; ">
                                    Recherche : &nbsp;
                                    @foreach ($type as $item)
                                        <span class="badge height-25 theme-bg">
                                            {{ $item }}
                                            <a href="javascript:void(0)" class="text-white" wire:click='changeState("{{ $item }}", "type", true)'> x </a>
                                        </span> &nbsp;
                                    @endforeach
                                    @foreach ($ville as $item)
                                        <span class="badge height-25 theme-bg">
                                            {{ $item }}
                                            <a href="javascript:void(0)" class="text-white" wire:click='changeState("{{ $item }}", "ville", true)'> x </a>
                                        </span> &nbsp;
                                    @endforeach
                                    @foreach ($quartier as $item)
                                        <span class="badge height-25 theme-bg">
                                            {{ $item }}
                                            <a href="javascript:void(0)" class="text-white" wire:click='changeState("{{ $item }}", "quartier", true)'> x </a>
                                        </span> &nbsp;
                                    @endforeach
                                    @foreach ($entreprise as $item)
                                        <span class="badge height-25 theme-bg">
                                            {{ $item }}
                                            <a href="javascript:void(0)" class="text-white" wire:click='changeState("{{ $item }}", "entreprise", true)'> x </a>
                                        </span> &nbsp;
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

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
                        <div class="col-md-1" style="">
                            <a href="javascript:void(0)" class="annonce-share" data-toggle="modal" data-target="#share" data-type="all">
                                <i class="fa fa-share fa-lg" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End Filter option -->
                    <div class="row mrg-0">

                        {{-- button --}}

                        @include('components.public.share-modal', [
                            'title' => 'Partager cette annonce',
                        ])

                        @if ($isLoading)
                            @include('components.public.loader')
                        @endif

                        @forelse ($annonces as $annonce)
                            <div class="col-md-6 col-sm-6" wire:key='{{ $annonce->id }}'>
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-img">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            @if ($annonce->image)
                                                <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="">
                                            @else
                                                <img src="http://via.placeholder.com/800x800" class="img-responsive" alt="">
                                            @endif
                                        </a>
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
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#signin" onclick="$('#share').hide()">
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
                                        {{-- <a href="{{ route('search') }}" class="theme-cl">Effacer les filtres</a> --}}
                                        <a href="javascript:void(0)" class="theme-cl" wire:click='resetFilters'>Effacer les filtres</a>
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

                // $('#annonce-whatsapp').attr('href', 'https://web.whatsapp.com/send?text=' + text);
                // open directly in whatsapp app
                $('#annonce-whatsapp').attr('href', 'whatsapp://send?text=' + text);
            });

            $('#annonce-url').click(function() {
                var text = $(this).data('url');

                if (!navigator.clipboard) {
                    console.log('Clipboard API not available');
                    return;
                }

                navigator.clipboard.writeText(text).then(function() {
                    $('#copyMessage').hide();
                    $('#copyMessage').fadeIn(500);
                    // $('#copyMessage').show();
                    setTimeout(function() {
                        $('#copyMessage').fadeOut(500);
                        // $('#copyMessage').hide();
                    }, 2000);
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        });
    </script>

    <script>
        function filterList(category) {
            // Get the input field and its value
            var filter = normalizeString($('#search-' + category).val());

            // Get the list and its items
            var $li = $('#list-' + category + 's li');

            // Variable to count the number of items displayed
            var count = 0;

            // Loop through the list items and hide those that don't match the filter
            $li.each(function() {
                var txtValue = normalizeString($(this).find('label').text());
                if (txtValue.indexOf(filter) > -1) {
                    $(this).fadeIn(300);
                    count++;
                } else {
                    $(this).fadeOut(300);
                }
            });

            // Get the no results message
            var $noResults = $('#no-' + category + '-results');

            // If no items are displayed, show the no results message
            if (count === 0) {
                $noResults.fadeIn(300);
            } else {
                $noResults.hide(); //fadeOut(300);
            }
        }

        function normalizeString(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toUpperCase();
        }
    </script>

    <script>
        window.addEventListener('refresh:filter', event => {
            var intervalId = setInterval(function() {
                var categories = [];
                $('ul.price-range').each(function() {
                    if (this.id.startsWith('list-')) {
                        var idWithoutList = this.id.replace('list-', '').slice(0, -1);
                        categories.push(idWithoutList);
                    }
                });
                categories.forEach(function(category) {
                    filterList(category);
                });
                clearInterval(intervalId);
            }, 500);
        });
    </script>
@endpush
