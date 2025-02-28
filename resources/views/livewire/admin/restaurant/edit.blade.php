<div>
    <div class="page-name restaurant row">
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="container text-left">
                <div class="row align-items-start">
                    <div class="col entreprise">
                        <div>
                            <h3>Entreprise
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3>
                            <h4>Sélectionnez l'entreprise</h4>
                            <select class="form-control" data-nom="entreprise_id" wire:model.defer='entreprise_id'
                                required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($entreprises as $entreprise)
                                    <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                @endforeach
                            </select>
                            @error('entreprise_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col restaurant">
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le nom de votre restaurant</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col restaurant">
                        <h3>Date de validité
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez la date d'expiration de l'annonce</h4>
                        <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder=""
                            wire:model.defer='date_validite' required>
                        @error('date_validite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="row align-items-start">
                    <div class="col col-md-4 col-xs-12 restaurant">
                        <h3>Statut
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez si l'annonce est active</h4>
                        <select class="form-control" wire:model.defer='is_active' required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row align-items-start">
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements',
                        'name' => 'equipements_restauration',
                        'options' => $list_equipements_restauration,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Boissons disponibles',
                        'name' => 'carte_consommation',
                        'options' => $list_carte_consommation,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Services proposés',
                        'name' => 'services',
                        'options' => $list_services,
                    ])
                </div>

                <div class="row align-items-start">
                    <div class="col entrees">
                        <h3>Entrées ({{ count($entrees) }})
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Carte des entrées</h4>
                        <div id="entrees-container">
                            <!-- Plat 1 par défaut -->
                            @foreach ($entrees as $index => $entree)
                                <div class="form-group entree-item" id="entree-item-{{ $index + 1 }}">
                                    <div>
                                        <button class="btn btn-form" data-bs-toggle="offcanvas"
                                            data-bs-target="#entree-{{ $index + 1 }}" type="button"
                                            aria-controls="entree-{{ $index + 1 }}">
                                            {{ Str::limit('Entrée ' . ($index + 1) . ' : ' . $entree['nom'], 40) }} <i
                                                class="fa fa-pencil"></i>
                                        </button>
                                    </div>
                                    <div class="offcanvas offcanvas-end" id="entree-{{ $index + 1 }}" data-bs-scroll="true"
                                        aria-labelledby="entree-{{ $index + 1 }}" tabindex="-1">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title">Entrée {{ $index + 1 }}</h5>
                                            <button class="btn-close text-reset" id="entrees-close-{{ $index + 1 }}"
                                                data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="form-group">
                                                <label for="entree-name-{{ $index + 1 }}">Nom<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field" id="entree-name-{{ $index + 1 }}"
                                                    type="text" wire:model="entrees.{{ $index }}.nom">
                                            </div>
                                            <div class="form-group">
                                                <label for="entree-description-{{ $index + 1 }}">Ingrédients<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <textarea class="form-control required-field"
                                                    id="entree-description-{{ $index + 1 }}"
                                                    wire:model="entrees.{{ $index }}.ingredients" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="entree-price-{{ $index + 1 }}">Prix<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field"
                                                    id="entree-price-{{ $index + 1 }}" type="number"
                                                    wire:model="entrees.{{ $index }}.prix_min">
                                            </div>
                                            <div class="form-group">
                                                <label for="form-img-entree-{{ $index + 1 }}">Image à la Une <b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control form-control-file"
                                                    id="form-img-entree-{{ $index + 1 }}" data-id="{{ $index + 1 }}"
                                                    type="file" wire:model="entrees.{{ $index }}.image" accept="image/*">

                                                @if (is_string($entrees[$index]['image']))
                                                    <img class="listing-shot-img img-responsive"
                                                        src="{{ asset('storage/' . $entrees[$index]['image']) }}" alt=""
                                                        style="width: 100%; height: 100px; object-fit: cover;">
                                                @else
                                                    <img class="listing-shot-img img-responsive"
                                                        src="{{ $entrees[$index]['image'] ? $entrees[$index]['image']->temporaryUrl() : '' }}"
                                                        alt="" style="width: 100%; height: 100px; object-fit: cover;">
                                                @endif

                                            </div>
                                            <button class="btn btn-danger mb-2 delete-entree-btn"
                                                data-entree-id="{{ $index + 1 }}" type="button"
                                                wire:click="removeEntree({{ $index }})">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12 col-sm-12 text-center">
                                <span class="text-danger" id="entree-error-message"><br></span>
                            </div>
                            @if ($entrees_error)
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $entrees_error }}</span>
                                </div>
                            @endif
                            @error('entrees.*.nom')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('entrees.*.ingredients')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('entrees.*.prix_min')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('entrees.*.image')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            <button class="btn btn-success btn-square" id="add-entree-btn" type="button"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="col plats">
                        <h3>Plats ({{ count($plats) }})
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Carte des plats</h4>
                        <div id="plats-container">
                            <!-- Plat 1 par défaut -->
                            @foreach ($plats as $index => $plat)
                                <div class="form-group plat-item" id="plat-item-{{ $index + 1 }}">
                                    <div>
                                        <button class="btn btn-form" data-bs-toggle="offcanvas"
                                            data-bs-target="#plat-{{ $index + 1 }}" type="button"
                                            aria-controls="plat-{{ $index + 1 }}">
                                            {{ Str::limit('Plat ' . ($index + 1) . ' : ' . $plat['nom'], 40) }} <i
                                                class="fa fa-pencil"></i>
                                        </button>
                                    </div>
                                    <div class="offcanvas offcanvas-end" id="plat-{{ $index + 1 }}" data-bs-scroll="true"
                                        aria-labelledby="plat-{{ $index + 1 }}" tabindex="-1">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title">Plat {{ $index + 1 }}</h5>
                                            <button class="btn-close text-reset" id="plats-close-{{ $index + 1 }}"
                                                data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="form-group">
                                                <label for="plat-name-{{ $index + 1 }}">Nom<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field" id="plat-name-{{ $index + 1 }}"
                                                    type="text" wire:model="plats.{{ $index }}.nom">
                                            </div>
                                            <div class="form-group">
                                                <label for="plat-description-{{ $index + 1 }}">Ingrédients<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <textarea class="form-control required-field"
                                                    id="plat-description-{{ $index + 1 }}"
                                                    wire:model="plats.{{ $index }}.ingredients" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="plat-price-{{ $index + 1 }}">Prix<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field" id="plat-price-{{ $index + 1 }}"
                                                    type="number" wire:model="plats.{{ $index }}.prix_min">
                                            </div>
                                            <div class="form-group">
                                                <label for="form-img-plat-{{ $index + 1 }}">Image à la Une <b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control form-control-file"
                                                    id="form-img-plat-{{ $index + 1 }}" data-id="{{ $index + 1 }}"
                                                    type="file" wire:model="plats.{{ $index }}.image" accept="image/*">

                                                @if (is_string($plats[$index]['image']))
                                                    <img class="listing-shot-img img-responsive"
                                                        src="{{ asset('storage/' . $plats[$index]['image']) }}" alt=""
                                                        style="width: 100%; height: 100px; object-fit: cover;">
                                                @else
                                                    <img class="listing-shot-img img-responsive"
                                                        src="{{ $plats[$index]['image'] ? $plats[$index]['image']->temporaryUrl() : '' }}"
                                                        alt="" style="width: 100%; height: 100px; object-fit: cover;">
                                                @endif

                                            </div>
                                            <button class="btn btn-danger mb-2 delete-plat-btn"
                                                data-plat-id="{{ $index + 1 }}" type="button"
                                                wire:click="removePlat({{ $index }})">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12 col-sm-12 text-center">
                                <span class="text-danger" id="plat-error-message"><br></span>
                            </div>
                            @if ($plats_error)
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $plats_error }}</span>
                                </div>
                            @endif
                            @error('plats.*.nom')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('plats.*.ingredients')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('plats.*.prix_min')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('plats.*.image')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            <button class="btn btn-success btn-square" id="add-plat-btn" type="button"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="col desserts">
                        <h3>Desserts ({{ count($desserts) }})
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Carte des desserts</h4>
                        <div id="desserts-container">
                            <!-- Dessert 1 par défaut -->
                            @foreach ($desserts as $index => $dessert)
                                <div class="form-group dessert-item" id="dessert-item-{{ $index + 1 }}">
                                    <div>
                                        <button class="btn btn-form" data-bs-toggle="offcanvas"
                                            data-bs-target="#dessert-{{ $index + 1 }}" type="button"
                                            aria-controls="dessert-{{ $index + 1 }}">
                                            {{ Str::limit('Dessert ' . ($index + 1) . ' : ' . $dessert['nom'], 40) }} <i
                                                class="fa fa-pencil"></i>
                                        </button>
                                    </div>
                                    <div class="offcanvas offcanvas-end" id="dessert-{{ $index + 1 }}" data-bs-scroll="true"
                                        aria-labelledby="dessert-{{ $index + 1 }}" tabindex="-1">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title">Dessert {{ $index + 1 }}</h5>
                                            <button class="btn-close text-reset" id="desserts-close-{{ $index + 1 }}"
                                                data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="form-group">
                                                <label for="dessert-name-{{ $index + 1 }}">Nom<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field"
                                                    id="dessert-name-{{ $index + 1 }}" type="text"
                                                    wire:model="desserts.{{ $index }}.nom">
                                            </div>
                                            <div class="form-group">
                                                <label for="dessert-description-{{ $index + 1 }}">Ingrédients<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <textarea class="form-control required-field"
                                                    id="dessert-description-{{ $index + 1 }}"
                                                    wire:model="desserts.{{ $index }}.ingredients" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="dessert-price-{{ $index + 1 }}">Prix<b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field"
                                                    id="dessert-price-{{ $index + 1 }}" type="number"
                                                    wire:model="desserts.{{ $index }}.prix_min">
                                            </div>
                                            <div class="form-group">
                                                <label for="form-img-dessert-{{ $index + 1 }}">Image à la Une <b
                                                        style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control form-control-file"
                                                    id="form-img-dessert-{{ $index + 1 }}" data-id="{{ $index + 1 }}"
                                                    type="file" wire:model="desserts.{{ $index }}.image" accept="image/*">

                                                @if (is_string($desserts[$index]['image']))
                                                    <img class="listing-shot-img img-responsive"
                                                        src="{{ asset('storage/' . $desserts[$index]['image']) }}" alt=""
                                                        style="width: 100%; height: 100px; object-fit: cover;">
                                                @else
                                                    <img class="listing-shot-img img-responsive"
                                                        src="{{ $desserts[$index]['image'] ? $desserts[$index]['image']->temporaryUrl() : '' }}"
                                                        alt="" style="width: 100%; height: 100px; object-fit: cover;">
                                                @endif

                                            </div>
                                            <button class="btn btn-danger mb-2 delete-dessert-btn"
                                                data-dessert-id="{{ $index + 1 }}" type="button"
                                                wire:click="removeDessert({{ $index }})">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12 col-sm-12 text-center">
                                <span class="text-danger" id="dessert-error-message"><br></span>
                            </div>
                            @if ($desserts_error)
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $desserts_error }}</span>
                                </div>
                            @endif
                            @error('desserts.*.nom')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('desserts.*.ingredients')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('desserts.*.prix_min')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('desserts.*.image')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            <button class="btn btn-success btn-square" id="add-dessert-btn" type="button"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                @include('admin.annonce.location-template', [
                    'pays' => $pays,
                    'villes' => $villes,
                    'quartiers' => $quartiers,
                ])

                <div class="row align-items-start">
                    @include('admin.annonce.edit-galery-component', [
                        'galerie' => $galerie,
                        'old_galerie' => $old_galerie,
                    ])
                </div>

                @include('admin.annonce.edit-validation-buttons')
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                height: '25px',
                width: '100%',
            });

            $('.select2').on('change', function (e) {
                var data = $(this).val();
                var nom = $(this).data('nom');
                @this.set(nom, data);
            });

        });
    </script>

    <script>
        $('#restaurant-form-submit').on('click', function () {
            const plats = collectPlats();
            const entrees = collectEntrees();
            const desserts = collectDesserts();

            const lastEntreeId = entreeCounter - 1;
            const lastPlatId = platCounter - 1;
            const lastDessertId = dessertCounter - 1;

            function validateAndShowError(type, lastId, items, errorMessageSelector, emptyMessage, invalidMessage) {
                if (lastId > 0 && !validateFields(type, lastId)) {
                    $(errorMessageSelector).text(invalidMessage.replace('{id}', lastId));
                    return false;
                }

                if (items.length === 0) {
                    $(errorMessageSelector).text(emptyMessage);
                    return false;
                }

                return true;
            }

            // Valider les champs du dernier entrée avant d'ajouter un nouveau
            if (!validateAndShowError('entree', lastEntreeId, entrees, '#entree-error-message', 'Veuillez ajouter au moins une entrée', 'Veuillez remplir tous les champs obligatoires de l\'entrée {id}.')) {
                return false;
            }

            // Valider les champs du dernier plat avant d'ajouter un nouveau
            if (!validateAndShowError('plat', lastPlatId, plats, '#plat-error-message', 'Veuillez ajouter au moins un plat', 'Veuillez remplir tous les champs obligatoires du plat {id}.')) {
                return false;
            }

            // Valider les champs du dernier dessert avant d'ajouter un nouveau
            if (!validateAndShowError('dessert', lastDessertId, desserts, '#dessert-error-message', 'Veuillez ajouter au moins un dessert', 'Veuillez remplir tous les champs obligatoires du dessert {id}.')) {
                return false;
            }
        });

        // Add dynamic image upload functionality
        // $(document).on('change', '.form-control-file', function(e) {
        //     var fileInput = $(this);
        //     var file = fileInput[0].files[0];
        //     var reader = new FileReader();
        //     reader.onload = function(e) {
        //         var imgPreview = $('<img>').attr('src', e.target.result).css({
        //             'max-width': '100%',
        //             'height': 'auto',
        //             'margin-top': '10px'
        //         });
        //         fileInput.after(imgPreview);
        //     };
        //     reader.readAsDataURL(file);
        // });
    </script>

    <script type="text/javascript">
        const platsContainer = $('#plats-container');
        const entreesContainer = $('#entrees-container');
        const dessertsContainer = $('#desserts-container');
        const addPlatBtn = $('#add-plat-btn');
        const addEntreeBtn = $('#add-entree-btn');
        const addDessertBtn = $('#add-dessert-btn');
        let platCounter = "{{ count($plats) + 1 }}";
        let entreeCounter = "{{ count($entrees) + 1 }}";
        let dessertCounter = "{{ count($desserts) + 1 }}";

        // Valider les champs obligatoires et l'unicité du nom
        function validateFields(element, id) {
            let isValid = true;
            const elementName = $(`#${element}-name-${id}`).val();

            // Vérifier si tous les champs obligatoires sont remplis
            $(`#${element}-item-${id} .required-field`).each(function () {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid'); // Ajouter une classe pour marquer le champ comme invalide
                } else {
                    $(this).removeClass('is-invalid'); // Enlever la classe si valide
                }
            });

            // Vérifier l'unicité du nom
            if (!isValid) {
                return false; // Si un champ est manquant, on retourne false
            }

            return isValid;
        }

        // Vérifier si le nom du plat est unique
        function isPlatNameUnique(elementName, id) {
            let isUnique = true;
            $('.required-field').each(function () {
                const currentId = $(this).data('${element}-id');
                const currentName = $(`#${elementName}-name-${currentId}`).val();

                // Si le nom est déjà pris et ce n'est pas le même plat
                if (currentName === elementName && currentId !== id) {
                    isUnique = false;
                    return false; // Sortir de la boucle dès qu'un doublon est trouvé
                }
            });
            return isUnique;
        }

        // Ajouter un nouveau plat (avec validation)
        function addPlat() {
            const lastPlatId = platCounter - 1;

            // Valider les champs du dernier plat avant d'ajouter un nouveau
            if (!validateFields('plat', lastPlatId)) {
                $('#plat-error-message').text(`Veuillez remplir tous les champs obligatoires du plat ${lastPlatId}.`);
                return; // Stopper l'ajout si les champs ne sont pas valides
            }

            @this.call('addPlat');

            platCounter++;

            // click sur le bouton pour ouvrir le formulaire (canvas)
            $(`#plat-${platCounter - 1}`).offcanvas('show');
        }

        function addEntree() {
            const lastEntreeId = entreeCounter - 1;

            // Valider les champs de la dernière entrée avant d'ajouter une nouvelle
            if (!validateFields('entree', lastEntreeId)) {
                $('#entree-error-message').text(`Veuillez remplir tous les champs obligatoires de l'entrée ${lastEntreeId}.`);
                return; // Stopper l'ajout si les champs ne sont pas valides
            }

            @this.call('addEntree');

            entreeCounter++;

            // click sur le bouton pour ouvrir le formulaire (canvas)
            $(`#entree-${entreeCounter - 1}`).offcanvas('show');
        }

        function addDessert() {
            const lastDessertId = dessertCounter - 1;

            // Valider les champs du dernier dessert avant d'ajouter un nouveau
            if (!validateFields('dessert', lastDessertId)) {
                $('#dessert-error-message').text(`Veuillez remplir tous les champs obligatoires du dessert ${lastDessertId}.`);
                return; // Stopper l'ajout si les champs ne sont pas valides
            }

            @this.call('addDessert');

            dessertCounter++;

            // click sur le bouton pour ouvrir le formulaire (canvas)
            $(`#dessert-${dessertCounter - 1}`).offcanvas('show');
        }

        // Réordonner les plats après suppression
        function reorderPlats() {
            platsContainer.children('.plat-item').each(function (index) {
                const newIndex = index + 1; // Nouvel index (commence à 1)
                const platItem = $(this);

                // Mettre à jour le conteneur principal
                platItem.attr('id', `plat-item-${newIndex}`);

                // Mettre à jour le bouton
                const button = platItem.find('.btn-form');
                button.text(`Plat ${newIndex}`);
                button.attr('data-bs-target', `#plat-${newIndex}`);
                button.attr('aria-controls', `plat-${newIndex}`);

                // Mettre à jour la zone offcanvas
                const offcanvas = platItem.find('.offcanvas');
                offcanvas.attr('id', `plat-${newIndex}`);
                offcanvas.attr('aria-labelledby', `plat-${newIndex}`);
                offcanvas.find('.offcanvas-title').text(`Plat ${newIndex}`);

                // Mettre à jour les champs dans le formulaire
                platItem.find('label[for^="name"]').attr('for', `name-${newIndex}`);
                platItem.find('label[for^="description"]').attr('for', `description-${newIndex}`);
                platItem.find('label[for^="price"]').attr('for', `price-${newIndex}`);
                platItem.find('label[for^="form-img"]').attr('for', `form-img-${newIndex}`);
                platItem.find('input[id^="name"]').attr('id', `name-${newIndex}`);
                platItem.find('textarea[id^="description"]').attr('id', `description-${newIndex}`);
                platItem.find('input[id^="price"]').attr('id', `price-${newIndex}`);
                platItem.find('input[id^="form-img"]').attr('id', `form-img-${newIndex}`);

                // Mettre à jour les boutons
                platItem.find('.save-plat-btn').attr('data-plat-id', newIndex);
                platItem.find('.delete-plat-btn').attr('data-plat-id', newIndex);
            });

            // Réinitialiser le compteur au dernier index + 1
            platCounter = platsContainer.children('.plat-item').length + 1;
        }

        function reorderEntrees() {
            entreesContainer.children('.entree-item').each(function (index) {
                const newIndex = index + 1; // Nouvel index (commence à 1)
                const entreeItem = $(this);

                // Mettre à jour le conteneur principal
                entreeItem.attr('id', `entree-item-${newIndex}`);

                // Mettre à jour le bouton
                const button = entreeItem.find('.btn-form');
                button.text(`Entrée ${newIndex}`);
                button.attr('data-bs-target', `#entree-${newIndex}`);
                button.attr('aria-controls', `entree-${newIndex}`);

                // Mettre à jour la zone offcanvas
                const offcanvas = entreeItem.find('.offcanvas');
                offcanvas.attr('id', `entree-${newIndex}`);
                offcanvas.attr('aria-labelledby', `entree-${newIndex}`);
                offcanvas.find('.offcanvas-title').text(`Entrée ${newIndex}`);

                // Mettre à jour les champs dans le formulaire
                entreeItem.find('label[for^="name"]').attr('for', `name-${newIndex}`);
                entreeItem.find('label[for^="description"]').attr('for', `description-${newIndex}`);
                entreeItem.find('label[for^="price"]').attr('for', `price-${newIndex}`);
                entreeItem.find('label[for^="form-img"]').attr('for', `form-img-${newIndex}`);
                entreeItem.find('input[id^="name"]').attr('id', `name-${newIndex}`);
                entreeItem.find('textarea[id^="description"]').attr('id', `description-${newIndex}`);
                entreeItem.find('input[id^="price"]').attr('id', `price-${newIndex}`);
                entreeItem.find('input[id^="form-img"]').attr('id', `form-img-${newIndex}`);

                // Mettre à jour les boutons
                entreeItem.find('.save-entree-btn').attr('data-entree-id', newIndex);
                entreeItem.find('.delete-entree-btn').attr('data-entree-id', newIndex);
            });

            // Réinitialiser le compteur au dernier index + 1
            entreeCounter = entreesContainer.children('.entree-item').length + 1;
        }

        function reorderDesserts() {
            dessertsContainer.children('.dessert-item').each(function (index) {
                const newIndex = index + 1; // Nouvel index (commence à 1)
                const dessertItem = $(this);

                // Mettre à jour le conteneur principal
                dessertItem.attr('id', `dessert-item-${newIndex}`);

                // Mettre à jour le bouton
                const button = dessertItem.find('.btn-form');
                button.text(`Dessert ${newIndex}`);
                button.attr('data-bs-target', `#dessert-${newIndex}`);
                button.attr('aria-controls', `dessert-${newIndex}`);

                // Mettre à jour la zone offcanvas
                const offcanvas = dessertItem.find('.offcanvas');
                offcanvas.attr('id', `dessert-${newIndex}`);
                offcanvas.attr('aria-labelledby', `dessert-${newIndex}`);
                offcanvas.find('.offcanvas-title').text(`Dessert ${newIndex}`);

                // Mettre à jour les champs dans le formulaire
                dessertItem.find('label[for^="name"]').attr('for', `name-${newIndex}`);
                dessertItem.find('label[for^="description"]').attr('for', `description-${newIndex}`);
                dessertItem.find('label[for^="price"]').attr('for', `price-${newIndex}`);
                dessertItem.find('label[for^="form-img"]').attr('for', `form-img-${newIndex}`);
                dessertItem.find('input[id^="name"]').attr('id', `name-${newIndex}`);
                dessertItem.find('textarea[id^="description"]').attr('id', `description-${newIndex}`);
                dessertItem.find('input[id^="price"]').attr('id', `price-${newIndex}`);
                dessertItem.find('input[id^="form-img"]').attr('id', `form-img-${newIndex}`);

                // Mettre à jour les boutons
                dessertItem.find('.save-dessert-btn').attr('data-dessert-id', newIndex);
                dessertItem.find('.delete-dessert-btn').attr('data-dessert-id', newIndex);
            });

            // Réinitialiser le compteur au dernier index + 1
            dessertCounter = dessertsContainer.children('.dessert-item').length + 1;
        }

        // Supprimer un plat
        $(document).on('click', '.delete-plat-btn', function () {
            const platId = $(this).data('plat-id');
            $('#plat-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#plat-item-${platId}`).remove();
            reorderPlats(); // Réordonner après suppression
        });

        // Supprimer une entrée
        $(document).on('click', '.delete-entree-btn', function () {
            const entreeId = $(this).data('entree-id');
            $('#entree-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#entree-item-${entreeId}`).remove();
            reorderEntrees(); // Réordonner après suppression
        });

        // Supprimer un dessert
        $(document).on('click', '.delete-dessert-btn', function () {
            const dessertId = $(this).data('dessert-id');
            $('#dessert-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#dessert-item-${dessertId}`).remove();
            reorderDesserts(); // Réordonner après suppression
        });

        // Enregistrer un plat (vous pouvez personnaliser selon vos besoins)
        $(document).on('click', '.save-plat-btn', function () {
            const platId = $(this).data('plat-id');
            if (validateFields('plat', platId)) {
                const platName = $(`#plat-name-${platId}`).val();
                const platIngredients = $(`#plat-description-${platId}`).val();
                const platPrice = $(`#plat-price-${platId}`).val();

                // Fermer le offcanvas après enregistrement
                $(`#plat-${platId}`).offcanvas('hide');
                $('#plat-error-message').text(''); // Réinitialiser le message d'erreur
            }
        });

        // Enregistrer une entrée
        $(document).on('click', '.save-entree-btn', function () {
            const entreeId = $(this).data('entree-id');
            if (validateFields('entree', entreeId)) {
                const entreeName = $(`#entree-name-${entreeId}`).val();
                const entreeIngredients = $(`#entree-description-${entreeId}`).val();
                const entreePrice = $(`#entree-price-${entreeId}`).val();

                // Fermer le offcanvas après enregistrement
                $(`#entree-${entreeId}`).offcanvas('hide');
                $('#entree-error-message').text(''); // Réinitialiser le message d'erreur
            }
        });

        // Enregistrer un dessert
        $(document).on('click', '.save-dessert-btn', function () {
            const dessertId = $(this).data('dessert-id');
            if (validateFields('dessert', dessertId)) {
                const dessertName = $(`#dessert-name-${dessertId}`).val();
                const dessertIngredients = $(`#dessert-description-${dessertId}`).val();
                const dessertPrice = $(`#dessert-price-${dessertId}`).val();

                // Fermer le offcanvas après enregistrement
                $(`#dessert-${dessertId}`).offcanvas('hide');
                $('#dessert-error-message').text(''); // Réinitialiser le message d'erreur
            }
        });

        // Collecter les plats et envoyer
        function collectPlats() {
            let platsData = [];

            $('.plat-item').each(function () {
                const platId = $(this).attr('id').split('-')[2]; // Extraire l'ID du plat
                const name = $(`#plat-name-${platId}`).val();
                const description = $(`#plat-description-${platId}`).val();
                const price = $(`#plat-price-${platId}`).val();
                const image = $(`#form-img-plat-${platId}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                platsData.push({
                    nom: name,
                    ingredients: description,
                    prix: price,
                    image: image // Si image est définie, elle sera envoyée
                });
            });

            return clearData(platsData);
        }

        function collectEntrees() {
            let entreesData = [];

            $('.entree-item').each(function () {
                const entreeId = $(this).attr('id').split('-')[2]; // Extraire l'ID de l'entrée
                const name = $(`#entree-name-${entreeId}`).val();
                const description = $(`#entree-description-${entreeId}`).val();
                const price = $(`#entree-price-${entreeId}`).val();
                const image = $(`#form-img-entree-${entreeId}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                entreesData.push({
                    nom: name,
                    ingredients: description,
                    prix: price,
                    image: image // Si image est définie, elle sera envoyée
                });
            });

            return clearData(entreesData);
        }

        function collectDesserts() {
            let dessertsData = [];

            $('.dessert-item').each(function () {
                const dessertId = $(this).attr('id').split('-')[2]; // Extraire l'ID du dessert
                const name = $(`#dessert-name-${dessertId}`).val();
                const description = $(`#dessert-description-${dessertId}`).val();
                const price = $(`#dessert-price-${dessertId}`).val();
                const image = $(`#form-img-dessert-${dessertId}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                dessertsData.push({
                    nom: name,
                    ingredients: description,
                    prix: price,
                    image: image // Si image est définie, elle sera envoyée
                });
            });

            return clearData(dessertsData);
        }

        const clearData = (objets) => {
            return objets.filter(objet => {
                return Object.values(objet).some(value => value !== null && value !== '');
            });
        }

        // Événement pour le bouton "Ajouter"
        addPlatBtn.on('click', addPlat);

        // Événement pour le bouton "Ajouter"
        addEntreeBtn.on('click', addEntree);

        // Événement pour le bouton "Ajouter"
        addDessertBtn.on('click', addDessert);
    </script>
@endpush