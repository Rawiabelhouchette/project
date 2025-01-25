<div>
    <div class="page-name restaurant row">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="container text-left">

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
                                        <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#entree-{{ $index + 1 }}" type="button" aria-controls="entree-{{ $index + 1 }}">
                                            Entrée {{ $index + 1 }} <i class="fa fa-pencil"></i>
                                        </button>
                                    </div>
                                    <div class="offcanvas offcanvas-end" id="entree-{{ $index + 1 }}" data-bs-scroll="true" aria-labelledby="entree-{{ $index + 1 }}" tabindex="-1">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title">Entrée {{ $index + 1 }}</h5>
                                            <button class="btn-close text-reset" id="entrees-close-{{ $index + 1 }}" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="form-group">
                                                <label for="entree-name-{{ $index + 1 }}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field" id="entree-name-{{ $index + 1 }}" type="text" wire:model="entrees.{{ $index }}.nom">
                                            </div>
                                            <div class="form-group">
                                                <label for="entree-description-{{ $index + 1 }}">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                                <textarea class="form-control required-field" id="entree-description-{{ $index + 1 }}" wire:model="entrees.{{ $index }}.ingredients" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="entree-price-{{ $index + 1 }}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control required-field" id="entree-price-{{ $index + 1 }}" type="number" wire:model="entrees.{{ $index }}.prix_min">
                                            </div>
                                            <div class="form-group">
                                                <label for="form-img-entree-{{ $index + 1 }}">Image à la Une <b style="color: red; font-size: 100%;">*</b></label>
                                                <input class="form-control form-control-file" id="form-img-entree-{{ $index + 1 }}" data-id="{{ $index + 1 }}" type="file" wire:model="entrees.{{ $index }}.image" accept="image/*">
                                            </div>
                                            {{-- <button class="btn btn-success mb-2 save-entree-btn" data-entree-id="{{ $index + 1 }}" type="button">Enregistrer</button> --}}
                                            <button class="btn btn-danger mb-2 delete-entree-btn" data-entree-id="{{ $index + 1 }}" type="button" wire:click="removeEntree({{ $index }})">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- 
                            <div class="col-md-12 col-sm-12 text-center">
                                <span class="text-danger" id="entree-error-message"></span>
                                @error('entrees')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
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
                            <button class="btn btn-success btn-square" id="add-entree-btn" type="button" {{-- wire:click="addEntree" --}}><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="row padd-bot-15">
                    <div class="form-group">
                        <div class="col text-right">
                            <button class="btn theme-btn" id="restaurant-form-submit" type="submit" style="margin-right: 30px;" wire:loading.attr='disabled'>
                                <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    {{-- <script src="{{ asset('assets/js/annonce/restaurant.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                height: '25px',
                width: '100%',
            });

            $('.select2').on('change', function(e) {
                var data = $(this).val();
                var nom = $(this).data('nom');
                @this.set(nom, data);
            });

        });
    </script>

    <script>
        $('#restaurant-form-submit').on('click', function() {
            //  check if all required fields are filled : I dont want a function

            const plats = collectPlats();
            const entrees = collectEntrees();
            const desserts = collectDesserts();
            // console.log(entrees);
            // console.log(plats);
            // console.log(desserts);

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

            // // Valider les champs du dernier plat avant d'ajouter un nouveau
            // if (!validateAndShowError('plat', lastPlatId, plats, '#plat-error-message', 'Veuillez ajouter au moins un plat', 'Veuillez remplir tous les champs obligatoires du plat {id}.')) {
            //     return false;
            // }

            // // Valider les champs du dernier dessert avant d'ajouter un nouveau
            // if (!validateAndShowError('dessert', lastDessertId, desserts, '#dessert-error-message', 'Veuillez ajouter au moins un dessert', 'Veuillez remplir tous les champs obligatoires du dessert {id}.')) {
            //     return false;
            // }

            // verifier et enlever les plats vides
            // en suite s'assurer qu'il y a au moins un plat

            // console.log('entrees', entrees);
            // console.log('plats', plats);
            // console.log('desserts', desserts);
            // alert('Form submitted');

            // @this.set('entrees', entrees);
            // @this.set('plats', plats);
            // @this.set('desserts', desserts);

            // return;

            // prevent form submission
            // return false;
        });

        // Add dynamic image upload functionality
        // $(document).on('change', '.form-control-file', function(e) {
        //     var fileInput = $(this);
        //     var file = fileInput[0].files[0];
        //     var reader = new FileReader();
        //     var id = fileInput.data('id');
        //     // show canvas
        //     $('#entree-' + id).offcanvas('show');
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
        let platCounter = 2; // Compteur pour générer des IDs uniques
        let entreeCounter = 2; // Compteur pour générer des IDs uniques
        let dessertCounter = 2; // Compteur pour générer des IDs uniques

        // Fonction pour créer un nouveau plat
        const createPlat = (platId) => {
            return `
        <div class="form-group plat-item" id="plat-item-${platId}">
            <div>
                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#plat-${platId}" type="button" aria-controls="plat-${platId}">
                    Plat ${platId} <i class="fa fa-pencil"></i>
                </button>
            </div>
            <div class="offcanvas offcanvas-end" id="plat-${platId}" data-bs-scroll="true" tabindex="-1" aria-labelledby="plat-${platId}">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Plat ${platId}</h5>
                    <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" id="plats-close-${platId}" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="form-group">
                        <label for="plat-name-${platId}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                        <input class="form-control required-field" id="plat-name-${platId}" type="text" data-plat-id="${platId}">
                    </div>
                    <div class="form-group">
                        <label for="plat-description-${platId}">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                        <textarea class="form-control required-field" id="plat-description-${platId}" rows="3" data-plat-id="${platId}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="plat-price-${platId}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                        <input class="form-control required-field" id="plat-price-${platId}" type="number" data-plat-id="${platId}">
                    </div>
                    <div class="form-group">
                        <label for="form-img-plat-${platId}">Image à la Une</label>
                        <input class="form-control-file" id="form-img-plat-${platId}" type="file" data-plat-id="${platId}" accept="image/*">
                    </div>
                    <button class="btn btn-success mb-2 save-plat-btn" type="button" data-plat-id="${platId}">Enregistrer</button>
                    <button class="btn btn-danger mb-2 delete-plat-btn" type="button" data-plat-id="${platId}">Supprimer</button>
                </div>
            </div>
        </div>
    `;
        }

        const createEntree = (entreeId) => {
            return `
        <div class="form-group entree-item" id="entree-item-${entreeId}">
            <div>
                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#entree-${entreeId}" type="button" aria-controls="entree-${entreeId}">
                    Entrée ${entreeId} <i class="fa fa-pencil"></i>
                </button>
            </div>
            <div class="offcanvas offcanvas-end" id="entree-${entreeId}" data-bs-scroll="true" tabindex="-1" aria-labelledby="entree-${entreeId}">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Entrée ${entreeId}</h5>
                    <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" id="entrees-close-${entreeId}" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="form-group">
                        <label for="entree-name-${entreeId}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                        <input class="form-control required-field" id="entree-name-${entreeId}" type="text" data-entree-id="${entreeId}">
                    </div>
                    <div class="form-group">
                        <label for="entree-description-${entreeId}">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                        <textarea class="form-control required-field" id="entree-description-${entreeId}" rows="3" data-entree-id="${entreeId}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="entree-price-${entreeId}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                        <input class="form-control required-field" id="entree-price-${entreeId}" type="number" data-entree-id="${entreeId}">
                    </div>
                    <div class="form-group">
                        <label for="form-img-entree-${entreeId}">Image à la Une</label>
                        <input class="form-control-file" id="form-img-entree-${entreeId}" type="file" data-entree-id="${entreeId}" accept="image/*">
                    </div>
                    <button class="btn btn-success mb-2 save-entree-btn" type="button" data-entree-id="${entreeId}">Enregistrer</button>
                    <button class="btn btn-danger mb-2 delete-entree-btn" type="button" data-entree-id="${entreeId}">Supprimer</button>
                </div>
            </div>
        </div>
    `;
        }

        const createDessert = (dessertId) => {
            return `
        <div class="form-group dessert-item" id="dessert-item-${dessertId}">
            <div>
                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#dessert-${dessertId}" type="button" aria-controls="dessert-${dessertId}">
                    Dessert ${dessertId} <i class="fa fa-pencil"></i>
                </button>
            </div>
            <div class="offcanvas offcanvas-end" id="dessert-${dessertId}" data-bs-scroll="true" tabindex="-1" aria-labelledby="dessert-${dessertId}">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Dessert ${dessertId}</h5>
                    <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" id="desserts-close-${dessertId}" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="form-group">
                        <label for="dessert-name-${dessertId}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                        <input class="form-control required-field" id="dessert-name-${dessertId}" type="text" data-dessert-id="${dessertId}">
                    </div>
                    <div class="form-group">
                        <label for="dessert-description-${dessertId}">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                        <textarea class="form-control required-field" id="dessert-description-${dessertId}" rows="3" data-dessert-id="${dessertId}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dessert-price-${dessertId}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                        <input class="form-control required-field" id="dessert-price-${dessertId}" type="number" data-dessert-id="${dessertId}">
                    </div>
                    <div class="form-group">
                        <label for="form-img-dessert-${dessertId}">Image à la Une</label>
                        <input class="form-control-file" id="form-img-dessert-${dessertId}" type="file" data-dessert-id="${dessertId}" accept="image/*">
                    </div>
                    <button class="btn btn-success mb-2 save-dessert-btn" type="button" data-dessert-id="${dessertId}">Enregistrer</button>
                    <button class="btn btn-danger mb-2 delete-dessert-btn" type="button" data-dessert-id="${dessertId}">Supprimer</button>
                </div>
            </div>
        </div>
    `;
        }

        // Valider les champs obligatoires et l'unicité du nom
        function validateFields(element, id) {
            let isValid = true;
            const elementName = $(`#${element}-name-${id}`).val();

            // Vérifier si tous les champs obligatoires sont remplis
            $(`#${element}-item-${id} .required-field`).each(function() {
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
            $('.required-field').each(function() {
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

            // Ajouter un nouveau plat
            const newPlatHTML = createPlat(platCounter);
            platsContainer.append(newPlatHTML);
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

            // Ajouter une nouvelle entrée
            // const newEntreeHTML = createEntree(entreeCounter);
            // entreesContainer.append(newEntreeHTML);

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

            // Ajouter un nouveau dessert
            const newDessertHTML = createDessert(dessertCounter);
            dessertsContainer.append(newDessertHTML);
            dessertCounter++;

            // click sur le bouton pour ouvrir le formulaire (canvas)
            $(`#dessert-${dessertCounter - 1}`).offcanvas('show');
        }

        // Réordonner les plats après suppression
        function reorderPlats() {
            platsContainer.children('.plat-item').each(function(index) {
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
            entreesContainer.children('.entree-item').each(function(index) {
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
            dessertsContainer.children('.dessert-item').each(function(index) {
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
        $(document).on('click', '.delete-plat-btn', function() {
            const platId = $(this).data('plat-id');
            $('#plat-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#plat-item-${platId}`).remove();
            reorderPlats(); // Réordonner après suppression
        });

        // Supprimer une entrée
        $(document).on('click', '.delete-entree-btn', function() {
            const entreeId = $(this).data('entree-id');
            $('#entree-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#entree-item-${entreeId}`).remove();
            reorderEntrees(); // Réordonner après suppression
        });

        // Supprimer un dessert
        $(document).on('click', '.delete-dessert-btn', function() {
            const dessertId = $(this).data('dessert-id');
            $('#dessert-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#dessert-item-${dessertId}`).remove();
            reorderDesserts(); // Réordonner après suppression
        });

        // Enregistrer un plat (vous pouvez personnaliser selon vos besoins)
        $(document).on('click', '.save-plat-btn', function() {
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
        $(document).on('click', '.save-entree-btn', function() {
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
        $(document).on('click', '.save-dessert-btn', function() {
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

            $('.plat-item').each(function() {
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

            $('.entree-item').each(function() {
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

            $('.dessert-item').each(function() {
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
