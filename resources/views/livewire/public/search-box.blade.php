<div>
    @php
        $defaultColor = '#de6600';
    @endphp
    <!-- ================ Start Page Title ======================= -->
    <section class="title-transparent page-title" style="background:url(assets_client/img/banner/image-1.jpg);">
        <div class="container">
            <div class="title-content">
                <h1>Toutes nos offres</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    @if ($detail)
                        {{-- <a href="#" style="color: white;"
                            onclick="event.preventDefault(); history.back();">Recherche</a> --}}
                        <span class="current">Recherche</span>
                        <span class="gt3_breadcrumb_divider"></span>
                        <span class="current">Détail</span>
                    @else
                        <span class="current">Recherche</span>
                    @endif
                </div>
            </div>
            <div class="banner-caption d-none d-md-block">
                    <!-- <h3 class="text-center">Recherche</h3> -->
                    <form class="form-verticle" method="GET" action="{{ route('search') }}">
                            <input name="form_request" type="hidden" value="1">
                            <div class="col-md-4 col-sm-4 no-padd">
                                <i class="banner-icon icon-pencil"></i>
                                <input class="form-control left-radius right-br" name="key" type="text"
                                    placeholder="Mot clé...">
                            </div>
                            <div class="col-md-3 col-sm-3 no-padd">
                                <div class="form-box">
                                    <i class="banner-icon icon-map-pin"></i>
                                    <input id="myInput" class="form-control right-br" name="location" type="text"
                                        placeholder="Localisation...">
                                    <div id="autocomplete-results" class="autocomplete-items"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 no-padd">
                                <div class="form-box">
                                    <i class="banner-icon icon-layers"></i>
                                    <select class="form-control" name="type[]">
                                        <option class="chosen-select" data-placeholder="{{ __('Types d\'annonce') }}"
                                            value="" selected>{{ __('Types d\'annonce') }}</option>
                                        @foreach ($typeAnnonce as $annonce)
                                            <option value="{{ $annonce }}">{{ $annonce }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-3 no-padd">
                                <div class="form-box">
                                    <button class="btn theme-btn btn-default" type="submit" style="border-top-left-radius: 0px; !important; border-bottom-left-radius: 0px !important;">
                                        {{-- <i class="ti-search"></i> --}}
                                        {{ __('Rechercher') }}
                                    </button>
                                </div>
                            </div>
                        </form>


                </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ================ End Page Title ======================= -->


    <div class="mobile-show">
        <style>
            :root {
                --primary-color: #de6600;
                --secondary-color: #de6600;
                --accent-color: #de6600;
                --light-color: #f8f9fa;
                --dark-color: #212529;
                --transition-speed: 0.3s;
            }


            .search-container {
                max-width: 600px;
                margin: 50px auto;
            }

            .search-bar-mobile {
                border-radius: 30px;
                padding: 15px 20px;
                margin: 50px;
                cursor: pointer;
                color: white;
                background-color: #de6600;
                transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            }

            .search-bar-mobile:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            }

            .modal-fullscreen-mobile {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .modal-fullscreen-mobile .modal-content {
                height: 100%;
                border: 0;
                border-radius: 0;
                background-color: rgba(255, 255, 255, 0.98);
            }

            .modal-header {
                border-bottom: none;
                padding: 15px 20px;
                justify-content: flex-end;
            }

            .btn-close {
                transition: transform var(--transition-speed);
            }

            .btn-close:hover {
                transform: rotate(90deg);
            }

            ..modal-body-mobile {
                padding: 0 20px;
                overflow-y: auto;
            }

            /* Custom accordion styling */
            .search-accordion {
                margin-bottom: 20px;
            }

            .search-accordion-item {
                margin-bottom: 20px;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                border: none;
                transition: all var(--transition-speed);
            }

            .search-accordion-item.active {
                box-shadow: 0 8px 24px rgba(67, 97, 238, 0.15);
                transform: translateY(-3px);
            }

            .search-accordion-header {
                background-color: white;
                border: none;
                padding: 0;
                cursor: pointer;
            }

            .search-accordion-button {
                width: 100%;
                padding: 20px;
                background: none;
                border: none;
                text-align: left;
                position: relative;
                display: flex;
                align-items: center;
                font-weight: 600;
                color: var(--dark-color);
                border-radius: 16px;
                transition: all var(--transition-speed);
            }

            .search-accordion-button .icon-container {
                background-color: #f1f3f9;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 12px;
                margin-right: 15px;
                transition: all var(--transition-speed);
            }

            .search-accordion-button:hover .icon-container,
            .search-accordion-item.active .search-accordion-button .icon-container {
                background-color: var(--primary-color);
                color: white;
            }

            .search-accordion-button .toggle-icon {
                margin-left: auto;
                transition: transform var(--transition-speed);
                font-size: 1.5rem;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #999;
            }

            .search-accordion-item.active .search-accordion-button .toggle-icon {
                transform: rotate(180deg);
                color: var(--primary-color);
            }

            .search-accordion-button .title {
                font-size: 1.1rem;
                margin-right: 8px;
            }

            .search-accordion-button .counter {
                background-color: var(--accent-color);
                color: white;
                padding: 2px 8px;
                border-radius: 20px;
                font-size: 0.75rem;
                opacity: 0;
                transition: all var(--transition-speed);
                transform: scale(0.8);
            }

            .search-accordion-button .counter.active {
                opacity: 1;
                transform: scale(1);
            }

            .search-accordion-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s ease-in-out;
                padding: 0 20px;
            }

            .search-accordion-item.active .search-accordion-content {
                max-height: 500px;
            }

            .search-accordion-body {
                padding: 20px 0;
            }

            /* Input Styling */
            .input-container {
                position: relative;
                margin-bottom: 20px;
            }

            .input-container input {
                width: 100%;
                padding: 16px 16px 16px 50px;
                border-radius: 12px;
                border: 2px solid #e0e0e0;
                font-size: 1rem;
                transition: all var(--transition-speed);
                background-color: white;
            }

            .input-container input:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            }

            .input-container .input-icon {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                color: #999;
                transition: all var(--transition-speed);
            }

            .input-container input:focus+.input-icon {
                color: var(--primary-color);
            }

            /* Chips Styling */
            .chips-container {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 15px;
                padding-bottom: 10px;
                max-height: 200px;
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: #ccc transparent;
            }

            .chips-container::-webkit-scrollbar {
                width: 6px;
            }

            .chips-container::-webkit-scrollbar-track {
                background: transparent;
            }

            .chips-container::-webkit-scrollbar-thumb {
                background-color: #ccc;
                border-radius: 6px;
            }

            .chip {
                display: inline-flex;
                align-items: center;
                padding: 8px 16px;
                background-color: #f1f3f9;
                border-radius: 20px;
                font-size: 14px;
                cursor: pointer;
                transition: all var(--transition-speed);
                position: relative;
                overflow: hidden;
                border: 2px solid transparent;
            }

            .chip:hover {
                background-color: #e6e9f0;
                transform: translateY(-2px);
            }

            .chip.active {
                background-color: rgba(67, 97, 238, 0.1);
                border-color: var(--primary-color);
                color: var(--primary-color);
                font-weight: 500;
            }

            .chip.active::before {
                content: '';
                position: absolute;
                top: -10px;
                right: -10px;
                background-color: var(--primary-color);
                width: 20px;
                height: 20px;
                transform: rotate(45deg);
            }

            .chip.active::after {
                content: '✓';
                position: absolute;
                top: 2px;
                right: 2px;
                color: white;
                font-size: 8px;
            }

            /* Footer Styling */
            .modal-footer {
                justify-content: space-between;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
                padding: 20px;
                position: sticky;
                bottom: 0;
                background-color: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
            }

            .clear-btn {
                background: none;
                border: none;
                color: var(--dark-color);
                text-decoration: underline;
                font-weight: 500;
                transition: all var(--transition-speed);
            }

            .clear-btn:hover {
                color: var(--primary-color);
                text-decoration: none;
            }

            .search-btn {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                border: none;
                border-radius: 24px;
                padding: 12px 24px;
                font-weight: 600;
                width: 100%;
                max-width: 200px;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            }

            .search-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            }

            .search-btn:active {
                transform: translateY(0);
                box-shadow: 0 2px 10px rgba(67, 97, 238, 0.3);
            }

            .search-btn i {
                font-size: 1.1rem;
            }

            /* Progress Bar */
            .progress-container {
                height: 4px;
                width: 100%;
                background-color: #f1f3f9;
                border-radius: 2px;
                margin-top: 10px;
                overflow: hidden;
            }

            .progress-bar {
                height: 100%;
                width: 0;
                background-color: var(--accent-color);
                border-radius: 2px;
                transition: width var(--transition-speed) ease;
            }

            /* Animation for accordion opening */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .search-accordion-item.active .search-accordion-body {
                animation: fadeIn 0.3s ease forwards;
            }

            /* Pulse animation for search button */
            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7);
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(67, 97, 238, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(67, 97, 238, 0);
                }
            }
        </style>
        <div class="form-verticle-mobile">
            <!-- Main Search Bar -->
            <div class="search-container">
                <div class="search-bar-mobile d-flex align-items-center justify-content-center" data-bs-toggle="modal"
                    data-bs-target="#searchModalMobile">
                    <i class="bi bi-search me-2"></i>
                    <span>Rechercher</span>
                </div>
            </div>

            <!-- Full Screen Search Modal -->
            <div class="modal fade" id="searchModalMobile" tabindex="-1" aria-labelledby="searchModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-fullscreen-mobile">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="customCloseBtnMobile"></button>
                        </div>

                        <div class="modal-body-mobile">

                            <div class="search-accordion" id="searchAccordion">

                                <!-- Mot clé Accordion -->
                                <div class="search-accordion-item active" id="motCleSection">
                                    <div class="search-accordion-header">
                                        <button class="search-accordion-button" type="button" data-section="motCle">
                                            <div class="icon-container">
                                                <i class="bi bi-search"></i>
                                            </div>
                                            <span class="title">Mot clé</span>
                                            <span class="selection-text" id="motCleSelection"></span>
                                            <div class="toggle-icon">
                                                <i class="bi bi-chevron-down"></i>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="search-accordion-content" style="max-height: 500px;">
                                        <div class="search-accordion-body">
                                            <div class="input-container">
                                                <input type="text" id="motCleInput" name="key"
                                                    placeholder="Rechercher par mot clé">
                                                <i class="bi bi-search input-icon"></i>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-bar" id="motCleProgress"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Localisation Accordion -->
                                <div class="search-accordion-item" id="localisationSection">
                                    <div class="search-accordion-header">
                                        <button class="search-accordion-button" type="button"
                                            data-section="localisation">
                                            <div class="icon-container">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                            <span class="title">Localisation</span>
                                            <span class="selection-text" id="localisationSelection"></span>
                                            <div class="toggle-icon">
                                                <i class="bi bi-chevron-down"></i>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="search-accordion-content">
                                        <div class="search-accordion-body">
                                            <div class="input-container">
                                                <input type="text" id="localisationInput"
                                                    placeholder="Rechercher une localisation">
                                                <i class="bi bi-geo-alt input-icon"></i>
                                            </div>
                                            <div class="chips-container" id="localisationChips">
                                                @foreach ($quartiers as $quartier)
                                                    <div class="chip" data-section="localisation">
                                                        {{ $quartier }}
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-bar" id="localisationProgress"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Types d'annonce Accordion -->
                                <div class="search-accordion-item" id="typesAnnonceSection">
                                    <div class="search-accordion-header">
                                        <button class="search-accordion-button" type="button"
                                            data-section="typesAnnonce">
                                            <div class="icon-container">
                                                <i class="bi bi-tag"></i>
                                            </div>
                                            <span class="title">Types d'annonce</span>
                                            <span class="selection-text" id="typesAnnonceSelection"></span>
                                            <div class="toggle-icon">
                                                <i class="bi bi-chevron-down"></i>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="search-accordion-content">
                                        <div class="search-accordion-body">
                                            <div class="input-container">
                                                <input type="text" id="typesAnnonceInput"
                                                    placeholder="Rechercher un type d'annonce">
                                                <i class="bi bi-tag input-icon"></i>
                                            </div>

                                            <div class="chips-container" id="typesAnnonceChips">
                                                @foreach ($typeAnnonce as $annonce)
                                                    <div class="chip" data-section="typesAnnonce">
                                                        {{ $annonce }}</div>
                                                @endforeach
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress-bar" id="typesAnnonceProgress"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">

                            <div>

                                <form class="form-verticle" method="GET" action="{{ route('search') }}">
                                    <input type="hidden" value="1" name="form_request">
                                    <input type="hidden" name="type[]" value="" />
                                    <input type="hidden" name="key" value="" />
                                    <input type="hidden" name="location" value="" />

                                    <button type="submit" class="clear-btn">
                                        Effacer tous les filtres
                                    </button>
                                </form>
                            </div>
                            <div>
                                <form class="form-verticle" method="GET" action="{{ route('search') }}">
                                    <input type="hidden" value="1" name="form_request">
                                    <input type="hidden" name="type[]" id="typeMobile" value="" />
                                    <input type="hidden" name="key" id="keyMobile" value="" />
                                    <input type="hidden" name="location" id="localisationMobile" value="" />

                                    <button type="submit" class="search-btn" type="submit">
                                        <i class="bi bi-search"></i>
                                        <span>{{ __('Rechercher') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const params = new URLSearchParams(window.location.search);
                // Initialize UI with default values
                function initializeUI() {
                    // Set keyword input if it exists in query params
                    if (selections.motCle) {
                        document.getElementById('motCleInput').value = selections.motCle;
                        updateSelectionText('motCle', selections.motCle);
                        updateProgress('motCle');
                    }

                    // Set default "Auberge" chip as active
                    if (typeof selections.typesAnnonce === 'string') {

                        const typesAnnonceChips = document.querySelectorAll('.chip[data-section="typesAnnonce"]');

                        typesAnnonceChips.forEach(chip => {
                            if (chip.textContent.trim() === selections.typesAnnonce?.trim()) {
                                chip.classList.add('active');
                                updateSelectionText('typesAnnonce', selections.typesAnnonce);
                                updateProgress('typesAnnonce');
                                document.getElementById("typeMobile").value = selections.typesAnnonce
                            }
                        });
                    }

                    if (typeof selections.localisation === 'string') {
                        const localisationChips = document.querySelectorAll('.chip[data-section="localisation"]');

                        localisationChips.forEach(chip => {
                            if (chip.textContent.trim() === selections.localisation?.trim()) {
                                chip.classList.add('active');
                                updateSelectionText('localisation', selections.localisation);
                                updateProgress('localisation');
                            }
                        });
                    }
                }
                const queryObject = {};
                params.forEach((value, key) => {
                    queryObject[key] = value;
                });


                // Track selections for each section
                let typeRaw = queryObject["type[]"] || queryObject["type[0]"];
                let selections = {
                    motCle: queryObject["key"] || "",
                    localisation: queryObject["location"] || "",
                    typesAnnonce: Array.isArray(typeRaw) ? typeRaw : typeRaw ? typeRaw : []
                };
                initializeUI()
                console.log(selections)



                // Get accordion sections
                const accordionSections = document.querySelectorAll('.search-accordion-item');
                const accordionButtons = document.querySelectorAll('.search-accordion-button');

                // Toggle accordion sections
                accordionButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const section = this.getAttribute('data-section');
                        const parent = document.getElementById(section + 'Section');

                        // Close all other sections
                        accordionSections.forEach(item => {
                            if (item !== parent) {
                                item.classList.remove('active');
                                item.querySelector('.search-accordion-content').style
                                    .maxHeight = null;
                            }
                        });

                        // Toggle current section
                        parent.classList.toggle('active');

                        // Set max-height for animation
                        const content = parent.querySelector('.search-accordion-content');
                        if (parent.classList.contains('active')) {
                            content.style.maxHeight = '500px';
                        } else {
                            content.style.maxHeight = null;
                        }
                    });
                });

                // Handle chips selection (single select)
                const chips = document.querySelectorAll('.chip');
                chips.forEach(chip => {
                    chip.addEventListener('click', function() {
                        const section = this.getAttribute('data-section');
                        const value = this.textContent;

                        // Deselect all chips in this section
                        document.querySelectorAll(`.chip[data-section="${section}"]`).forEach(c => {
                            c.classList.remove('active');
                        });

                        // Select this chip
                        this.classList.add('active');

                        // Update selection
                        selections[section] = value;

                        // Update UI
                        updateSelectionText(section, value);
                        updateProgress(section);

                        // Auto-close section after selection (optional)
                        // setTimeout(() => {
                        //     const nextSection = getNextSection(section);
                        //     if (nextSection) {
                        //         document.querySelector(`[data-section="${nextSection}"]`).click();
                        //     }
                        // }, 500);
                    });
                });

                // Handle keyword input
                const motCleInput = document.getElementById('motCleInput');
                motCleInput.addEventListener('input', function() {
                    selections.motCle = this.value;
                    updateSelectionText('motCle', this.value);
                    updateProgress('motCle');
                });

                // Filter chips based on input
                const filterInputs = document.querySelectorAll('#localisationInput, #typesAnnonceInput');
                filterInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        const section = this.id.replace('Input', '');
                        const searchTerm = this.value.toLowerCase();
                        const chipsContainer = document.getElementById(section + 'Chips');
                        const chips = chipsContainer.querySelectorAll('.chip');

                        let visibleCount = 0;

                        chips.forEach(chip => {
                            const text = chip.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                chip.style.display = 'inline-flex';
                                visibleCount++;
                            } else {
                                chip.style.display = 'none';
                            }
                        });

                        // Add "no results" message if no chips match
                        const noResults = chipsContainer.querySelector('.no-results');
                        if (visibleCount === 0 && searchTerm !== '') {
                            if (!noResults) {
                                const message = document.createElement('div');
                                message.classList.add('no-results');
                                message.textContent = 'Aucun résultat trouvé';
                                message.style.padding = '10px';
                                message.style.color = '#666';
                                chipsContainer.appendChild(message);
                            }
                        } else if (noResults) {
                            noResults.remove();
                        }
                    });
                });

                // Clear all selections
                const clearBtn = document.getElementById('clearBtn');
                clearBtn.addEventListener('click', function() {
                    // Clear chips
                    document.querySelectorAll('.chip.active').forEach(chip => {
                        chip.classList.remove('active');
                    });

                    // Clear inputs
                    document.querySelectorAll('input').forEach(input => {
                        input.value = '';
                    });

                    // Reset chip visibility
                    document.querySelectorAll('.chip').forEach(chip => {
                        chip.style.display = 'inline-flex';
                    });

                    // Remove "no results" messages
                    document.querySelectorAll('.no-results').forEach(el => el.remove());

                    // Reset selections
                    selections.motCle = '';
                    selections.localisation = '';
                    selections.typesAnnonce = '';

                    // Update UI
                    updateSelectionText('motCle', '');
                    updateSelectionText('localisation', '');
                    updateSelectionText('typesAnnonce', '');
                    updateProgress('motCle');
                    updateProgress('localisation');
                    updateProgress('typesAnnonce');
                });



                // Update selection text in accordion header
                function updateSelectionText(section, value) {
                    const selectionText = document.getElementById(section + 'Selection');
                    document.getElementById("typeMobile").value = selections.typesAnnonce
                    document.getElementById("keyMobile").value = selections.motCle
                    document.getElementById("localisationMobile").value = selections.localisation
                    if (value) {
                        selectionText.textContent = value;
                        selectionText.classList.add('active');
                    } else {
                        selectionText.textContent = '';
                        selectionText.classList.remove('active');
                    }
                }

                // Update progress bar
                function updateProgress(section) {
                    const progress = document.getElementById(section + 'Progress');
                    let percentage = 0;

                    if (selections[section]) {
                        percentage = 100;
                    }

                    progress.style.width = percentage + '%';
                }

                // Get next section (for auto-advancing)
                function getNextSection(currentSection) {
                    const sections = ['motCle', 'localisation', 'typesAnnonce'];
                    const currentIndex = sections.indexOf(currentSection);

                    if (currentIndex < sections.length - 1) {
                        return sections[currentIndex + 1];
                    }

                    return null;
                }

                // Focus on the first input when modal opens
                const searchModalMobile = document.getElementById('searchModalMobile');
                searchModalMobile.addEventListener('shown.bs.modal', function() {


                    document.getElementById('motCleInput').focus();


                });
                document.getElementById("customCloseBtnMobile").addEventListener("click", function() {
                    document.querySelector("#share").style.display = "";
                });

            });
        </script>
    </div>

    <style>
        .mobile-show {
            display: none;
        }

        @media (max-width: 480px) {
            .desktop-show {
                display: none
            }

            .modal-footer>* {
                margin: 0 !important
            }

            .modal-open #share {
                display: none !important
            }

            .mobile-show {
                display: block !important;
            }
        }

        @media (min-width: 481px) and (max-width: 767px) {
            .desktop-show {
                display: none
            }

            .modal-footer>* {
                margin: 0 !important
            }

            .modal-open #share {
                display: none !important
            }

            .mobile-show {
                display: block !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .desktop-show {
                display: none
            }

            .modal-footer>* {
                margin: 0 !important
            }


            .modal-open #share {
                display: none !important
            }

            .mobile-show {
                display: block !important;
            }
        }


        .autocomplete {
            position: relative;
            display: inline-block;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0;
            right: 0;
            border-radius: 5px;
            margin-top: 5px;

            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
            text-align: left;
        }

        .autocomplete-items div:hover {
            background-color: #f6f6f6;
        }

        .autocomplete-items div:first-child {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            border-top: 1px solid #d4d4d4;
        }

        .autocomplete-items div:last-child {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>

    @push('scripts')
        <script>
            let countries = @json($quartiers);
            let myInput = document.getElementById('myInput');

            myInput.addEventListener('focus', function(e) {
                let a, b, val = this.value;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                if (!val) {
                    for (let i = 0; i < countries.length; i++) {
                        b = document.createElement("DIV");
                        b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i];
                        b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                        b.addEventListener("click", function(e) {
                            document.getElementById('myInput').value = this.getElementsByTagName("input")[0]
                                .value;
                            closeAllLists();
                        });
                        a.appendChild(b);

                    }
                    return;

                }

                for (let i = 0; i < countries.length; i++) {
                    let country = normalize(countries[i]).toUpperCase();
                    let searchVal = normalize(val).toUpperCase();

                    if (country.includes(searchVal)) {
                        let startIdx = country.indexOf(searchVal);
                        let endIdx = startIdx + searchVal.length;

                        b = document.createElement("DIV");
                        b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i].substr(0, startIdx) +
                            "<strong>" + countries[i].substr(startIdx, searchVal.length) + "</strong>" +
                            countries[i].substr(endIdx);
                        b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                        b.addEventListener("click", function(e) {
                            document.getElementById('myInput').value = this.getElementsByTagName("input")[0]
                                .value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });


            myInput.addEventListener('input', function(e) {
                let a, b, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (let i = 0; i < countries.length; i++) {
                    let country = normalize(countries[i]).toUpperCase();
                    let searchVal = normalize(val).toUpperCase();

                    if (country.includes(searchVal)) {
                        let startIdx = country.indexOf(searchVal);
                        let endIdx = startIdx + searchVal.length;

                        b = document.createElement("DIV");
                        b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i].substr(0, startIdx) +
                            "<strong>" + countries[i].substr(startIdx, searchVal.length) + "</strong>" +
                            countries[i].substr(endIdx);
                        b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                        b.addEventListener("click", function(e) {
                            document.getElementById('myInput').value = this.getElementsByTagName("input")[0]
                                .value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });

            function normalize(str) {
                return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            }

            function closeAllLists(elmnt) {
                let x = document.getElementsByClassName("autocomplete-items");
                for (let i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != document.getElementById('myInput')) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        </script>
    @endpush
</div>
