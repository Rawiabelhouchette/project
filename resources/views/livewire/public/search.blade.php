<div>
    @php
        $defaultColor = '#de6600';
    @endphp

    <!-- ================ Listing In Grid Style ======================= -->
    <section class="sec-bt">
        <div class="container">
            <div class="row">
                <!-- Start Sidebar -->
                <div class="col-md-12 col-sm-12">
                    <!-- Create a flex container for the header elements -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="align-items-center">
                            <h4 class="mb-0 me-3">Filtrer vos recherches</h4>


                        </div>
                        <!-- Sort dropdown moved to the right -->
                        <div class="mb-0 d-flex align-items-center">
                            <!-- View mode toggle buttons -->
                            <div class="view-mode-buttons me-3 d-none d-md-block">
                                <button class="btn btn-sm {{ $viewMode === 'row' ? 'theme-bg text-white' : 'btn-light btn-inactive' }}"
                                        wire:click="$set('viewMode', 'row')" title="Vue grille"
                                        style="padding: 8px 10px;border: 0;">
                                    <i class="fa fa-th-large"></i>
                                </button>
                                <button class="btn btn-sm {{ $viewMode === 'line' ? 'theme-bg text-white' : 'btn-light btn-inactive' }}"
                                        wire:click="$set('viewMode', 'line')" title="Vue liste"
                                        style="padding: 8px 10px;border: 0;">
                                    <i class="fa fa-list"></i>
                                </button>
                            </div>

                            <!-- Sort dropdown -->
                            <select id="select-order" class="fs-5 filter-button" tabindex="-98" wire:model.lazy='sortOrder'>
                                <option value="" disabled>Trier</option>
                                <option value="titre|asc">Titre: A à Z</option>
                                <option value="titre|desc">Titre: Z à A</option>
                                <option value="created_at|asc">Date: Ancien à récent</option>
                                <option value="created_at|desc">Date: Récent à ancien</option>
                            </select>
                        </div>
                    </div>
                    <div class="sidebar" class="row col-md-12 col-sm-12">
                        @foreach ($facettes as $index => $facette)
                            <div wire:key='{{ $facette->id }}' class="{{ $index >= 2 ? 'd-md-block more-filter-sm d-none' : ($index >= 4 ? 'more-filter-md d-none' : '') }}">
                                @include('components.public.filter-view', [
                                    'title' => $facette->title,
                                    'category' => $facette->category,
                                    'items' => $facette->items,
                                    'selectedItems' => $facette->selectedItems,
                                    'icon' => $facette->icon,
                                    'filterModel' => $facette->filterModel,
                                ])
                            </div>
                        @endforeach
                    </div>
                    @if(count($facettes) > 2)
                    <div class="row col-md-12 col-sm-12">
                        <div class="col-md-3 text-center mb-3 mt-2 d-block d-md-none">
                            <button id="show-more-filters-sm" class="filter-button" onclick="toggleMoreFiltersSm()">
                            <i class="fa fa-sliders me-2"></i> Plus de filtres
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="col-12 text-center mb-3">
                        @if ($type || $ville || $quartier || $entreprise)
                            <p id="reset-filters" class="btn theme-btn mb-0" wire:click='resetFilters'>

                                <i class="fa fa-trash" aria-hidden="true"></i> Effacer tous

                            </p>
                        @endif
                    </div>
                    <script>
                        function toggleMoreFiltersSm() {
                            const moreFilters = document.querySelectorAll('.more-filter-sm');
                            const button = document.getElementById('show-more-filters-sm');

                            let isHidden = moreFilters[0].classList.contains('d-none');

                            moreFilters.forEach(filter => {
                                if (isHidden) {
                                    filter.classList.remove('d-none');
                                    button.innerHTML = '<i class="fa fa-sliders me-2"></i> Moins de filtres';
                                } else {
                                    filter.classList.add('d-none');
                                    button.innerHTML = '<i class="fa fa-sliders me-2"></i> Plus de filtres';
                                }
                            });
                        }

                        function toggleMoreFiltersMd() {
                            const moreFilters = document.querySelectorAll('.more-filter-md');
                            const button = document.getElementById('show-more-filters-md');

                            let isHidden = moreFilters[0].classList.contains('d-none');

                            moreFilters.forEach(filter => {
                                if (isHidden) {
                                    filter.classList.remove('d-none');
                                    button.innerHTML = '<i class="fa fa-filter me-2"></i> Moins de filtres';
                                } else {
                                    filter.classList.add('d-none');
                                    button.innerHTML = '<i class="fa fa-filter me-2"></i> Plus de filtres';
                                }
                            });
                        }
                    </script>
                </div>
                <!-- End Start Sidebar -->

                <!-- Start All Listing -->
                <div class="col-md-12 col-sm-12 p-0" wire:key='filterShow'>
                    <!-- Filter option -->
                    <div id="research-zone">
                        @if ($type || $ville || $quartier || $entreprise || $key)
                            <div class="row mrg-0 mrg-bot-10">
                                <div class="col-md-12 mrg-top-10">
                                    <div class="col-md-12" style="margin-left: 0px; padding-left: 0px; display: ''; align-items: center; ">
                                        Recherche : &nbsp;
                                        @if ($key)
                                            <span id="key-filter" class="badge height-25 theme-bg" data-value="{{ $key }}">
                                                {{ $key }}
                                                <a href="javascript:void(0)" class="selectedOption text-white" wire:click='changeState("{{ $key }}", "key", true)'> x </a>
                                            </span> &nbsp;
                                        @endif
                                        @foreach ($facettes as $facette)
                                            @foreach ($facette->selectedItems as $item)
                                                <span class="badge height-25 theme-bg search-elt" wire:key='sub-facette-filter-{{ $loop->index }}'>
                                                    {{ $item }}
                                                    <a href="javascript:void(0)" class="selectedOption text-white" wire:click='changeState("{{ $item }}", "{{ $facette->category }}", true)'> x </a>
                                                </span> &nbsp;
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between px-2">
                        <div class="">
                            <h4 class="theme-cl-blue">Affichage : {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} trouvé(s)</h4>
                        </div>

                        <a href="javascript:void(0)" class="share-btn" data-target="#share" onclick="sharePage()">
                                <i class="fa fa-share-nodes" aria-hidden="true"></i>
                            </a>
                    </div>

                    <div class="container mt-5">
                        @include('components.public.share-modal', [
                            'title' => 'Partager cette annonce',
                        ])

                        <div class="col-md-12 col-sm-12" wire:loading.delay wire:transition>
                            @include('components.public.loader')
                        </div>
                        <div class="row">
                            @foreach ($annonces as $annonce)
                                <x-public.property-item :annonce="$annonce" :mode="$viewMode" />
                            @endforeach
                        </div>
                        <div id="annonces-zone" class="row mt-5 p-0" >

                        </div>

                        @empty($annonces->count())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style" style="padding-top: 50px; padding-bottom: 50px;">
                                    <div class="listing-shot-caption mrg-top-5 text-center">
                                        <i class="fa-solid fa-xmark fa-5x" aria-hidden="true"></i> <br>
                                        <h4>Aucune annonce trouvée</h4>
                                        {{-- <a href="javascript:void(0)" class="reset-filters" class="theme-cl" wire:click='resetFilters'>    Effacer les filtres</a> --}}
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </div>

                    <div id="annonce-pagination">
                        {{ $annonces->links() }}
                    </div>


                </div>
                <div id="contact-zone">
                        <div class="widget-boxed">
                            <div class="widget-boxed-body padd-top-40 padd-bot-40 text-center">
                                <div class="help-support">
                                    <i class="ti-headphone-alt font-60 theme-cl mrg-bot-15"></i>
                                    <p>Vous avez une question ? <br> Contactez-nous</p>
                                    <h4 class="mrg-top-0">contact@numrod.fr</h4>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- ================ End Listing In Grid Style ======================= -->
</div>








