<div>
    <div class="page-name restaurant row">
        <form wire:submit="store()">
            <div class="container text-left">
                <div class="row align-items-start">
                    <div class="col entreprise">
                        <h3>Établissement</h3>
                        <h4>Saisissez les coordonnées de l'établissement</h4>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#entreprise" type="button" aria-controls="entreprise-1">Mon établissement<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" id="entreprise" data-bs-scroll="true" aria-labelledby="entreprise" tabindex="-1">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="entreprise-1">Mon entreprise</h5>
                                <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                    <input class="form-control" id="name" type="text" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="number">Téléphone<b style="color: red; font-size: 100%;">*</b></label>
                                    <input class="form-control telephone" id="number" type="text" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="ets-email">Email<b style="color: red; font-size: 100%;">*</b></label>
                                    <input class="form-control" id="ets-email" type="email" aria-describedby="email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" id="description" type="text" aria-describedby="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="whatsapp">Whatsapp</label>
                                    <input class="form-control" id="whatsapp" type="number" aria-describedby="whatsapp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="facebook">Facebook</label>
                                    <input class="form-control" id="facebook" type="url" aria-describedby="facebook">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="instagram">Instagram</label>
                                    <input class="form-control" id="instagram" type="url" aria-describedby="instagram">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="website">Site web</label>
                                    <input class="form-control" id="website" type="url" aria-describedby="website">
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="country">Pays</label>
                                        <select class="form-control" id="country">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="city">Ville</label>
                                        <select class="form-control" id="city">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="location">Quartier</label>
                                        <select class="form-control" id="location">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="longitude">Longitude</label>
                                    <input class="form-control" id="longitude" type="number" aria-describedby="longitude">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="latitude">Latitude</label>
                                    <input class="form-control" id="latitude" type="number" aria-describedby="latitude">
                                </div>
                                <div class="mb-3">
                                    <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-center">Heure d'ouverture et de fermeture</h6>
                                    <div class="form-group">
                                        <label for="horaire">Tableau des horaires à intégrer une fois le code prêt</label>
                                        <select class="form-control" id="horaire">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-sucess mb-2" type="button">Enregistrer</button>
                                <button class="btn btn-danger mb-2" type="button">Supprimer</button>
                            </div>
                        </div>
                    </div>

                    <div class="col restaurant">
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le nom de votre restaurant</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='nom'>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col restaurant">
                        <h3>Date de validité
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez la date d'expiration</h4>
                        <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite'>
                        @error('date_validite')
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
                    <div class="col plats">
                        <h3>Plats</h3>
                        <h4>Carte des plats</h4>
                        <div id="plats-container">
                            <!-- Plat 1 par défaut -->
                            <div class="form-group plat-item" id="plat-item-1">
                                <div>
                                    <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#plat-1" type="button" aria-controls="plat-1">
                                        Plat 1 <i class="fa fa-pencil"></i>
                                    </button>
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <span class="text-danger" id="plat-error-message"></span>
                                    </div>
                                </div>
                                <div class="offcanvas offcanvas-end" id="plat-1" data-bs-scroll="true" aria-labelledby="plat-1" tabindex="-1">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title">Plat 1</h5>
                                        <button class="btn-close text-reset" id="plats-close-1" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="form-group">
                                            <label for="plat-name-1">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="plat-name-1" data-plat-id="1" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="plat-description-1">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                            <textarea class="form-control required-field" id="plat-description-1" data-plat-id="1" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="plat-price-1">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="plat-price-1" data-plat-id="1" type="number">
                                        </div>
                                        <div class="form-group">
                                            <label for="form-img-1">Image à la Une</label>
                                            <input class="form-control-file" id="form-img-plat-1" data-plat-id="1" type="file">
                                        </div>
                                        <button class="btn btn-success mb-2 save-plat-btn" data-plat-id="1" type="button">Enregistrer</button>
                                        <button class="btn btn-danger mb-2 delete-plat-btn" data-plat-id="1" type="button">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-square" id="add-plat-btn" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row align-items-end">
                    {{-- <button class="btn btn-danger mb-2" type="reset">Supprimer l'annonce</button> --}}
                    <button class="btn btn-success mb-2" id="restaurant-form-submit" type="submit" wire:target='store'>Sauvegarder l'annonce</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
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
        $(document).ready(function() {
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
            function createElement(element, id) {
                return `
                    <div class="form-group ${element}-item" id="${element}-item-${id}">
                        <div>
                            <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#${element}-${id}" type="button" aria-controls="${element}-${id}">
                                ${element} ${id} <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                        <div class="offcanvas offcanvas-end" id="${element}-${id}" data-bs-scroll="true" tabindex="-1" aria-labelledby="${element}-${id}">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title">${element} ${id}</h5>
                                <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" id="${element}-close-${id}" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="form-group">
                                    <label for="${element}-name-${id}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                    <input class="form-control required-field" id="${element}-name-${id}" type="text" data-${element}-id="${id}">
                                </div>
                                <div class="form-group">
                                    <label for="${element}-description-${id}">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                    <textarea class="form-control required-field" id="${element}-description-${id}" rows="3" data-${element}-id="${id}"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="${element}-price-${id}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                    <input class="form-control required-field" id="${element}-price-${id}" type="number" data-${element}-id="${id}">
                                </div>
                                <div class="form-group">
                                    <label for="form-img-${id}">Image à la Une</label>
                                    <input class="form-control-file" id="form-img-${element}-${id}" type="file" data-${element}-id="${id}">
                                </div>
                                <button class="btn btn-success mb-2 save-${element}-btn" type="button" data-${element}-id="${id}">Enregistrer</button>
                                <button class="btn btn-danger mb-2 delete-${element}-btn" type="button" data-${element}-id="${id}">Supprimer</button>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Valider les champs obligatoires et l'unicité du nom
            function validateFields(element, id) {
                let isValid = true;
                const elementName = $(`#${element}-name-${id}`).val();

                // Vérifier si tous les champs obligatoires sont rempli
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

                // // Vérifier que le nom du plat est unique
                // if (!isPlatNameUnique(platName, platId)) {
                //     alert(`Le plat "${platName}" existe déjà. Veuillez choisir un autre nom.`);
                //     return false;
                // }

                return isValid;
            }

            function addElement(element) {
                const lastElementId = element === 'plat' ? platCounter - 1 : element === 'entree' ? entreeCounter - 1 : dessertCounter - 1;

                // Valider les champs du dernier plat avant d'ajouter un nouveau
                if (!validateFields(element, lastElementId)) {
                    // alert(`Veuillez remplir tous les champs obligatoires pour le plat ${lastPlatId} avant d'ajouter un nouveau plat.`);
                    // Veuillez remplir tous les champs de l\'entrée
                    $(`#${element}-error-message`).text(`Veuillez remplir tous les champs obligatoires du ${element} ${lastElementId}.`);
                    return; // Stopper l'ajout si les champs ne sont pas valides
                }

                // Ajouter un nouveau plat
                const newElementHTML = createElement(element, element === 'plat' ? platCounter : element === 'entree' ? entreeCounter : dessertCounter);
                if (element === 'plat') {
                    platsContainer.append(newElementHTML);
                    platCounter++;
                } else if (element === 'entree') {
                    entreesContainer.append(newElementHTML);
                    entreeCounter++;
                } else {
                    dessertsContainer.append(newElementHTML);
                    dessertCounter++;
                }
            }

            function reorderPlats(element) {
                const container = element === 'plat' ? platsContainer : element === 'entree' ? entreesContainer : dessertsContainer;
                const counter = element === 'plat' ? platCounter : element === 'entree' ? entreeCounter : dessertCounter;

                container.children(`.${element}-item`).each(function(index) {
                    const newIndex = index + 1; // Nouvel index (commence à 1)
                    const item = $(this);

                    // Mettre à jour le conteneur principal
                    item.attr('id', `${element}-item-${newIndex}`);

                    // Mettre à jour le bouton
                    const button = item.find('.btn-form');
                    button.text(`${element} ${newIndex}`);
                    button.attr('data-bs-target', `#${element}-${newIndex}`);
                    button.attr('aria-controls', `${element}-${newIndex}`);

                    // Mettre à jour la zone offcanvas
                    const offcanvas = item.find('.offcanvas');
                    offcanvas.attr('id', `${element}-${newIndex}`);
                    offcanvas.attr('aria-labelledby', `${element}-${newIndex}`);
                    offcanvas.find('.offcanvas-title').text(`${element} ${newIndex}`);

                    // Mettre à jour les champs dans le formulaire
                    item.find('label[for^="name"]').attr('for', `${element}-name-${newIndex}`);
                    item.find('label[for^="description"]').attr('for', `${element}-description-${newIndex}`);
                    item.find('label[for^="price"]').attr('for', `${element}-price-${newIndex}`);
                    item.find('label[for^="form-img"]').attr('for', `form-img-${element}-${newIndex}`);
                    item.find('input[id^="name"]').attr('id', `${element}-name-${newIndex}`);
                    item.find('textarea[id^="description"]').attr('id', `${element}-description-${newIndex}`);
                    item.find('input[id^="price"]').attr('id', `${element}-price-${newIndex}`);
                    item.find('input[id^="form-img"]').attr('id', `form-img-${element}-${newIndex}`);

                    // Mettre à jour les boutons
                    item.find(`.save-${element}-btn`).attr(`data-${element}-id`, newIndex);
                    item.find(`.delete-${element}-btn`).attr(`data-${element}-id`, newIndex);
                });

                // Réinitialiser le compteur au dernier index + 1
                if (element === 'plat') {
                    platCounter = container.children(`.${element}-item`).length + 1;
                } else if (element === 'entree') {
                    entreeCounter = container.children(`.${element}-item`).length + 1;
                } else {
                    dessertCounter = container.children(`.${element}-item`).length + 1;
                }
            }

            // Fonction générique pour supprimer un élément
            function deleteItem(element, id) {
                $(`#${element}-item-${id}`).remove();
                reorderPlats(element); // Réordonner après suppression
            }

            // Écouteur d'événements pour les boutons de suppression
            $(document).on('click', '.delete-plat-btn, .delete-entree-btn, .delete-dessert-btn', function() {
                const element = $(this).data('plat-id') ? 'plat' : $(this).data('entree-id') ? 'entree' : 'dessert';
                const id = $(this).data(`${element}-id`);
                deleteItem(element, id);
            });

            // Enregistrer un plat (vous pouvez personnaliser selon vos besoins)
            function saveItem(element, id) {
                if (validateFields(id)) {
                    const itemName = $(`#name-${id}`).val();
                    const itemIngredients = $(`#description-${id}`).val();
                    const itemPrice = $(`#price-${id}`).val();

                    // Fermer le offcanvas après enregistrement
                    $(`#${element}-${id}`).offcanvas('hide');
                    $(`#${element}-error-message`).text(''); // Réinitialiser le message d'erreur
                    // collectItems(); // Collecter les éléments et les envoyer
                } else {
                    // alert(`Veuillez remplir tous les champs obligatoires pour le ${element} ${id}.`);
                }
            }

            $(document).on('click', '.save-plat-btn, .save-entree-btn, .save-dessert-btn', function() {
                const element = $(this).data('plat-id') ? 'plat' : $(this).data('entree-id') ? 'entree' : 'dessert';
                const id = $(this).data(`${element}-id`);
                saveItem(element, id);
            });

            // Collecter les plats et envoyer
            function collectElements(element) {
                // let platsData = [];
                let elementsData = [];

                // $('.plat-item').each(function() {
                //     const platId = $(this).attr('id').split('-')[2]; // Extraire l'ID du plat
                //     const name = $(`#name-${platId}`).val();
                //     const description = $(`#description-${platId}`).val();
                //     const price = $(`#price-${platId}`).val();
                //     const image = $(`#form-img-${platId}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                //     // if (validateFields(platId)) {
                //     platsData.push({
                //         nom: name,
                //         ingredients: description,
                //         prix: price,
                //         image: image // Si image est définie, elle sera envoyée
                //     });
                //     // }
                // });

                // return platsData;

                $(`.${element}-item`).each(function() {
                    const id = $(this).attr('id').split('-')[2]; // Extraire l'ID de l'élément
                    const name = $(`#${element}-name-${id}`).val();
                    const description = $(`#${element}-description-${id}`).val();
                    const price = $(`#${element}-price-${id}`).val();
                    const image = $(`#form-img-${element}-${id}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                    // if (validateFields(platId)) {
                    elementsData.push({
                        nom: name,
                        ingredients: description,
                        prix: price,
                        image: image // Si image est définie, elle sera envoyée
                    });
                    // }
                });

                return elementsData;
            }

            // Événement pour le bouton "Ajouter"
            addPlatBtn.on('click', addElement('plat'));
            addEntreeBtn.on('click', addElement('entree'));
            addDessertBtn.on('click', addElement('dessert'));

            $('#restaurant-form-submit').on('click', function() {
                const plats = collectElements('plat');
                const entrees = collectElements('entree');
                const desserts = collectElements('dessert');
                // verifier et enlever les plats vides
                // en suite s'assurer qu'il y a au moins un plat
                @this.set('plats', plats);
                @this.set('entrees', entrees);
                @this.set('desserts', desserts);
            });
        });
    </script>
@endpush
