<div>
    @php
        $defaultColor = '#de6600';
    @endphp
    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil']];
    @endphp

    <x-breadcumb :detail="true" :showSearchButton="true"
        backgroundImage="{{ asset('assets_client/img/banner/image-1.jpg') }}" :showTitle="true" title="Toutes nos offres"
        :breadcrumbs="$breadcrumbs" :typeAnnonce="$typeAnnonces" />
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
                        <div class="mb-0">
                            <select id="select-order" class="fs-5 filter-button" tabindex="-98"
                                wire:model.lazy='sortOrder'>
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
                            <div wire:key='{{ $facette->id }}'
                                class="{{ $index >= 2 ? 'd-md-block more-filter-sm d-none' : ($index >= 4 ? 'more-filter-md d-none' : '') }}">
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

                    @if (count($facettes) > 2)
                        <div class="row col-md-12 col-sm-12">
                            <div class="col-md-3 text-center mb-3 mt-2 d-block d-md-none">
                                <button id="show-more-filters-sm" class="filter-button" onclick="toggleMoreFiltersSm()">
                                    <i class="fa fa-sliders me-2"></i> Plus de filtres
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 text-center mb-3">
                        @if ($type || $ville || $quartier || $entreprise || $marque || $boiteVitesse || $nombrePersonne || $typeVehicule)
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

                        @if ($type || $ville || $quartier || $entreprise || $key || $marque || $boiteVitesse || $nombrePersonne || $typeVehicule)

                            <div class="row mrg-0 mrg-bot-10">
                                <div class="col-md-12 mrg-top-10">
                                    <div class="col-md-12"
                                        style="margin-left: 0px; padding-left: 0px; display: ''; align-items: center; ">
                                        Recherche : &nbsp;
                                        @if ($key)
                                            <span id="key-filter" class="badge height-25 theme-bg"
                                                data-value="{{ $key }}">
                                                {{ $key }}
                                                <a href="javascript:void(0)" class="selectedOption text-white"
                                                    wire:click='changeState("{{ $key }}", "key", true)'> x </a>
                                            </span> &nbsp;
                                        @endif
                                        @foreach ($facettes as $facette)
                                            @foreach ($facette->selectedItems as $item)
                                                <span class="badge height-25 theme-bg search-elt"
                                                    wire:key='sub-facette-filter-{{ $loop->index }}'>
                                                    {{ $item }}
                                                    <a href="javascript:void(0)" class="selectedOption text-white"
                                                        wire:click='changeState("{{ $item }}", "{{ $facette->category }}", true)'>
                                                        x </a>
                                                </span> &nbsp;
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mrg-0">
                        <div class="col-md-4 col-xs-9">
                            <h4 class="theme-cl-blue">Affichage :
                                {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }}
                                trouvé(s)</h4>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="javascript:void(0)" class="share-btn" data-target="#share" onclick="sharePage()">
                                <i class="fa fa-share-nodes" aria-hidden="true"></i>
                            </a>
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
                        </div>
                    </div>

                    <div class="container mt-5">
                        @include('components.public.share-modal', [
                            'title' => 'Partager cette annonce',
                        ])

                        <div class="col-md-12 col-sm-12" wire:loading.delay wire:transition>
                            @include('components.public.loader')
                        </div>
                        <style>
                            .property-grid {
                                display: flex;
                                flex-wrap: wrap;
                            }
                        </style>
                        <div class="property-grid">
                            <x-public.property-item :annonces="$annonces" :mode="$viewMode" />
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
                                <h4 class="mrg-top-0">service.client@vamiyi.com </h4>
                               
                                    <span class="vamiyi-contact-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32" fill="currentColor">
                                            <path d="M16.001 3.2c-7.062 0-12.8 5.738-12.8 12.8 0 2.263.61 4.469 1.766 6.404L3.2 28.8l6.697-1.744a12.726 12.726 0 0 0 6.104 1.564c7.062 0 12.8-5.738 12.8-12.8s-5.738-12.8-12.8-12.8zm0 23.014a10.172 10.172 0 0 1-5.17-1.423l-.369-.217-3.981 1.035 1.061-3.879-.24-.392a10.17 10.17 0 1 1 8.699 4.876zm5.493-7.678c-.302-.151-1.78-.879-2.057-.98-.276-.102-.478-.151-.68.151-.201.302-.78.979-.957 1.181-.177.201-.352.226-.654.075-.302-.151-1.276-.469-2.43-1.495-.898-.8-1.504-1.788-1.68-2.09-.177-.302-.019-.465.133-.616.136-.135.302-.352.453-.528.151-.177.201-.302.302-.504.1-.201.05-.377-.025-.528-.075-.151-.68-1.637-.931-2.238-.245-.588-.497-.508-.68-.517-.177-.009-.377-.011-.578-.011a1.113 1.113 0 0 0-.805.377c-.276.302-1.059 1.035-1.059 2.524 0 1.489 1.084 2.928 1.234 3.131.151.201 2.134 3.258 5.175 4.57.724.312 1.29.498 1.73.637.727.231 1.388.198 1.911.12.583-.086 1.78-.727 2.033-1.43.251-.704.251-1.307.176-1.43-.075-.124-.276-.2-.578-.352z"/>
                                        </svg>
                                    </span>
                                    <a href="https://wa.me/33766911098" target="_blank" rel="noopener noreferrer">
                                        +337 66 91 10 98
                                    </a>
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End Listing In Grid Style ======================= -->
</div>
