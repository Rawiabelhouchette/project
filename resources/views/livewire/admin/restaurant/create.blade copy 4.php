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
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control" id="name" type="text" aria-describedby="name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="number">Téléphone<b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control telephone" id="name" type="text" aria-describedby="name">
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

                                    <button class="btn btn-sucess mb-2" type="submit">Enregistrer</button>
                                    <button class="btn btn-danger mb-2" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col restaurant">
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le nom de votre restaurant</h4>
                        <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col restaurant">
                        <h3>Date de validité
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez la date d'expiration</h4>
                        <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
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
                    <div class="col entrees">
                        <h3>Entrées</h3>
                        <h4>Carte des entrées</h4>
                        <div class="form-group">
                            <div>
                                @foreach ($entrees as $key => $entree)
                                    <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#entree-{{ $key }}" type="button" aria-controls="entree-{{ $key }}">Entrée {{ $key + 1 }}<i class="fa fa-pencil"></i></button>
                                @endforeach

                                @if ($entrees_error && $key == count($entrees) - 1)
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <span class="text-danger"> {{ $entrees_error }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @foreach ($entrees as $key => $entree)
                            <div class="offcanvas offcanvas-end" id="entree-{{ $key }}" data-bs-scroll="true" aria-labelledby="entree-{{ $key }}" tabindex="-1">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="entree-{{ $key }}">Entrée {{ $key + 1 }}</h5>
                                    <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="form-group">
                                        <label for="name-1">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control" id="name-1" type="text" wire:model.defer='entrees.{{ $key }}.nom' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                        <textarea class="form-control" id="description" rows="3" wire:model.defer='entrees.{{ $key }}.ingredients' required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price-1">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control" id="price-1" type="number" wire:model.defer='entrees.{{ $key }}.prix_min' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-img-1">Image à la Une</label>
                                        <input class="form-control-file" id="form-img-1" type="file">
                                    </div>

                                    <button class="btn btn-sucess mb-2" data-bs-dismiss="offcanvas" type="button" type="button" aria-label="Close" wire:click="checkInputs('entree', {{ $key }})">Enregistrer</button>
                                    @if ($entrees_count > 1)
                                        <button class="btn btn-danger mb-2" data-bs-dismiss="offcanvas" type="buttom" type="button" aria-label="Close" wire:click="removeEntree({{ $key }})">Supprimer</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <button class="btn btn-success btn-square" type="button" wire:click="addEntree"><i class="fa fa-plus"></i></button>
                    </div>
                    {{-- <div class="col plats">
                        <h3>Plats</h3>
                        <h4>Carte des plats</h4>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#plat-1" type="button" aria-controls="entree-1">Plat 1<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" id="plat-1" data-bs-scroll="true" aria-labelledby="plat-1" tabindex="-1">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="entree-1">Plat 1</h5>
                                <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form>
                                    <div class="form-group">
                                        <label for="name-1">Nom</label>
                                        <input class="form-control" id="name-1" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Ingrédients</label>
                                        <textarea class="form-control" id="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price-1">Prix</label>
                                        <input class="form-control" id="price-1" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-img-1">Image à la Une</label>
                                        <input class="form-control-file" id="form-img-1" type="file">
                                    </div>
                                    <button class="btn btn-sucess mb-2" type="submit">Enregistrer</button>
                                    <button class="btn btn-danger mb-2" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                        <button class="btn btn-success btn-square" type="button"><i class="fa fa-plus"></i></button>
                    </div> --}}
                    <div class="col plats">
                        <h3>Plats</h3>
                        <h4>Carte des plats</h4>
                        <div id="plats-container">
                            <!-- Plat 1 par défaut -->
                            <div class="form-group plat-item" id="plat-item-1">
                                <input id="plats_data" name="plats_data" type="hidden" wire:model="plats_data">
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
                                            <label for="name-1">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="name-1" data-plat-id="1" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="description-1">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                            <textarea class="form-control required-field" id="description-1" data-plat-id="1" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price-1">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="price-1" data-plat-id="1" type="number">
                                        </div>
                                        <div class="form-group">
                                            <label for="form-img-1">Image à la Une</label>
                                            <input class="form-control-file" id="form-img-1" data-plat-id="1" type="file">
                                        </div>
                                        <button class="btn btn-success mb-2 save-plat-btn" data-plat-id="1" type="button">Enregistrer</button>
                                        <button class="btn btn-danger mb-2 delete-plat-btn" data-plat-id="1" type="button">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-square" id="add-plat-btn" type="button"><i class="fa fa-plus"></i></button>
                    </div>

                    <div class="col desserts">
                        <h3>Desserts</h3>
                        <h4>Carte des desserts</h4>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#dessert-1" type="button" aria-controls="dessert-1">Dessert 1<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" id="dessert-1" data-bs-scroll="true" aria-labelledby="dessert-1" tabindex="-1">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="dessert-1">Dessert 1</h5>
                                <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form>
                                    <div class="form-group">
                                        <label for="name-1">Nom</label>
                                        <input class="form-control" id="name-1" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Ingrédients</label>
                                        <textarea class="form-control" id="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price-1">Prix</label>
                                        <input class="form-control" id="price-1" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-img-1">Image à la Une</label>
                                        <input class="form-control-file" id="form-img-1" type="file">
                                    </div>
                                    <button class="btn btn-sucess mb-2" type="submit">Enregistrer</button>
                                    <button class="btn btn-danger mb-2" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                        <button class="btn btn-success btn-square" type="button"><i class="fa fa-plus"></i></button>

                    </div>
                </div>
                <div class="row align-items-end">
                    {{-- <button class="btn btn-danger mb-2" type="reset">Supprimer l'annonce</button> --}}
                    <button class="btn btn-success mb-2" type="submit" wire:target='store'>Sauvegarder l'annonce</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
            const addPlatBtn = $('#add-plat-btn');
            let platCounter = 2; // Compteur pour générer des IDs uniques

            // Fonction pour créer un nouveau plat
            function createPlat(platId) {
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
                            <label for="name-${platId}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                            <input class="form-control required-field" id="name-${platId}" type="text" data-plat-id="${platId}">
                        </div>
                        <div class="form-group">
                            <label for="description-${platId}">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                            <textarea class="form-control required-field" id="description-${platId}" rows="3" data-plat-id="${platId}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price-${platId}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                            <input class="form-control required-field" id="price-${platId}" type="number" data-plat-id="${platId}">
                        </div>
                        <div class="form-group">
                            <label for="form-img-${platId}">Image à la Une</label>
                            <input class="form-control-file" id="form-img-${platId}" type="file" data-plat-id="${platId}">
                        </div>
                        <button class="btn btn-success mb-2 save-plat-btn" type="button" data-plat-id="${platId}">Enregistrer</button>
                        <button class="btn btn-danger mb-2 delete-plat-btn" type="button" data-plat-id="${platId}">Supprimer</button>
                    </div>
                </div>
            </div>
        `;
            }

            // Valider les champs obligatoires et l'unicité du nom
            function validateFields(platId) {
                let isValid = true;
                const platName = $(`#name-${platId}`).val();

                // Vérifier si tous les champs obligatoires sont remplis
                $(`#plat-item-${platId} .required-field`).each(function() {
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

                // Vérifier que le nom du plat est unique
                if (!isPlatNameUnique(platName, platId)) {
                    alert(`Le plat "${platName}" existe déjà. Veuillez choisir un autre nom.`);
                    return false;
                }

                return isValid;
            }

            // Vérifier si le nom du plat est unique
            function isPlatNameUnique(platName, platId) {
                let isUnique = true;
                $('.required-field').each(function() {
                    const currentId = $(this).data('plat-id');
                    const currentName = $(`#name-${currentId}`).val();

                    // Si le nom est déjà pris et ce n'est pas le même plat
                    if (currentName === platName && currentId !== platId) {
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
                if (!validateFields(lastPlatId)) {
                    // alert(`Veuillez remplir tous les champs obligatoires pour le plat ${lastPlatId} avant d'ajouter un nouveau plat.`);
                    // Veuillez remplir tous les champs de l\'entrée
                    $('#plat-error-message').text(`Veuillez remplir tous les champs obligatoires du plat ${lastPlatId}.`);
                    return; // Stopper l'ajout si les champs ne sont pas valides
                }

                // Ajouter un nouveau plat
                const newPlatHTML = createPlat(platCounter);
                platsContainer.append(newPlatHTML);
                platCounter++;
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

            // Supprimer un plat
            $(document).on('click', '.delete-plat-btn', function() {
                const platId = $(this).data('plat-id');
                $(`#plat-item-${platId}`).remove();
                reorderPlats(); // Réordonner après suppression
            });

            // Enregistrer un plat (vous pouvez personnaliser selon vos besoins)
            $(document).on('click', '.save-plat-btn', function() {
                const platId = $(this).data('plat-id');
                if (validateFields(platId)) {
                    const platName = $(`#name-${platId}`).val();
                    const platIngredients = $(`#description-${platId}`).val();
                    const platPrice = $(`#price-${platId}`).val();


                    // Fermer le offcanvas après enregistrement
                    $(`#plat-${platId}`).offcanvas('hide');
                    $('#plat-error-message').text(''); // Réinitialiser le message d'erreur
                    collectPlats(); // Collecter les plats et les envoyer
                } else {
                    // alert(`Veuillez remplir tous les champs obligatoires pour le plat ${platId}.`);
                }
            });

            // Collecter les plats et envoyer
            function collectPlats() {
                let platsData = [];

                $('.plat-item').each(function() {
                    const platId = $(this).attr('id').split('-')[2]; // Extraire l'ID du plat
                    const name = $(`#name-${platId}`).val();
                    const description = $(`#description-${platId}`).val();
                    const price = $(`#price-${platId}`).val();
                    const image = $(`#form-img-${platId}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                    if (validateFields(platId)) {
                        platsData.push({
                            name: name,
                            description: description,
                            price: price,
                            image: image // Si image est définie, elle sera envoyée
                        });
                    }
                });

                // Placer les données dans le champ caché
                $('#plats_data').val(JSON.stringify(platsData));
            }

            // Événement pour le bouton "Ajouter"
            addPlatBtn.on('click', addPlat);
        });
    </script>
@endpush
