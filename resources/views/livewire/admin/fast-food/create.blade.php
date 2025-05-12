<div class="fast-food-template">
    <div>
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-start">
                <div class="col-md-4 col-sm-12 p-0">
                    <div class="col">
                        <h3>Entreprise
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select class="form-control" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
                            @foreach ($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                            @endforeach
                        </select>
                        @error('entreprise_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 p-0">
                    <div class="col">
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le nom de votre restaurant</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 p-0">
                    <div class="col">
                        <h3>Date de validité
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <input class="form-control" type="date" placeholder="" disabled wire:model.defer='date_validite' required>
                        @error('date_validite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row align-items-start">
                @include('admin.annonce.description-component')
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Équipements',
                    'name' => 'equipements_restauration',
                    'options' => $list_equipements_restauration,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Services proposés',
                    'name' => 'services',
                    'options' => $list_services,
                ])
            </div>

            <div class="row align-items-start">
                <div class="col-md-12 col-sm-12 p-0">
                    <div class="col produits">
                        <h3>Menus ({{ count($produits) }})
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Carte de menus</h4>
                        <div id="produits-container">
                            <!-- Produit 1 par défaut -->
                            @foreach ($produits as $index => $menu)
                                <div id="produit-item-{{ $index + 1 }}" class="form-group produit-item">
                                    <div>
                                        <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#produit-{{ $index + 1 }}" type="button" aria-controls="produit-{{ $index + 1 }}">
                                            Menu {{ $index + 1 }} : {{ $menu['nom'] }} <i class="fa fa-pencil"></i>
                                        </button>
                                    </div>
                                    <div id="produit-{{ $index + 1 }}" class="offcanvas offcanvas-end" data-bs-scroll="true" aria-labelledby="produit-{{ $index + 1 }}" tabindex="-1">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title">Menu {{ $index + 1 }}</h5>
                                            <button id="produits-close-{{ $index + 1 }}" class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="form-group">
                                                <label for="produit-name-{{ $index + 1 }}">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                                <input id="produit-name-{{ $index + 1 }}" class="form-control required-field" type="text" wire:model="produits.{{ $index }}.nom">
                                            </div>
                                            <div class="form-group">
                                                <label for="produit-description-{{ $index + 1 }}">Accompagnements<b style="color: red; font-size: 100%;">*</b></label>
                                                <textarea id="produit-description-{{ $index + 1 }}" class="form-control required-field" wire:model="produits.{{ $index }}.accompagnements" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="produit-price-{{ $index + 1 }}">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                                <input id="produit-price-{{ $index + 1 }}" class="form-control required-field" type="number" wire:model="produits.{{ $index }}.prix">
                                            </div>
                                            <div class="form-group">
                                                <label for="form-img-produit-{{ $index + 1 }}">Image à la Une <b style="color: red; font-size: 100%;">*</b></label>
                                                <input id="form-img-produit-{{ $index + 1 }}" class="form-control form-control-file" data-id="{{ $index + 1 }}" type="file" wire:model="produits.{{ $index }}.image" accept="image/*">

                                                @if (!empty($produits[$index]['image']))
                                                    <img class="listing-shot-img img-responsive" src="{{ $produits[$index]['image']->temporaryUrl() }}" alt="" style="width: 100%; height: 100px; object-fit: cover;">
                                                @endif

                                            </div>
                                            <button class="btn btn-danger delete-produit-btn mb-2" data-produit-id="{{ $index + 1 }}" type="button" wire:click="removeProduit({{ $index }})">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12 col-sm-12 text-center">
                                <span id="produit-error-message" class="text-danger"><br></span>
                            </div>
                            @if ($produits_error)
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $produits_error }}</span>
                                </div>
                            @endif
                            @error('produits.*.nom')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('produits.*.accompagnements')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('produits.*.prix')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            @error('produits.*.image')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            <button id="add-produit-btn" class="btn btn-success btn-square" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.annonce.location-template', [
                'pays' => $pays,
                'villes' => $villes,
                'quartiers' => $quartiers,
            ])

            <div class="row align-items-start">
                @include('admin.annonce.create-galery-component', [
                    'galery' => $galerie,
                ])
            </div>

            <div class="row padd-bot-15">
                <div class="form-group">
                    <div class="col text-right">
                        <button id="fast-food-form-submit" class="btn theme-btn" type="submit" style="margin-right: 30px;" wire:loading.attr="disabled">
                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                            Enregistrer
                        </button>
                    </div>
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
        $('#fast-food-form-submit').on('click', function() {
            //  check if all required fields are filled : I dont want a function

            const produits = collectProduits();

            const lastProduitId = produitCounter - 1;

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

            // Valider les champs du dernier produit avant d'ajouter un nouveau
            if (!validateAndShowError('produit', lastProduitId, produits, '#produit-error-message', 'Veuillez ajouter au moins un produit', 'Veuillez remplir tous les champs obligatoires du produit {id}.')) {
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
        const produitsContainer = $('#produits-container');
        const addProduitBtn = $('#add-produit-btn');
        let produitCounter = 2; // Compteur pour générer des IDs uniques

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

        // Vérifier si le nom du produit est unique
        function isProduitNameUnique(elementName, id) {
            let isUnique = true;
            $('.required-field').each(function() {
                const currentId = $(this).data('${element}-id');
                const currentName = $(`#${elementName}-name-${currentId}`).val();

                // Si le nom est déjà pris et ce n'est pas le même produit
                if (currentName === elementName && currentId !== id) {
                    isUnique = false;
                    return false; // Sortir de la boucle dès qu'un doublon est trouvé
                }
            });
            return isUnique;
        }

        // Ajouter un nouveau produit (avec validation)
        function addProduit() {
            const lastProduitId = produitCounter - 1;

            // Valider les champs du dernier produit avant d'ajouter un nouveau
            if (!validateFields('produit', lastProduitId)) {
                $('#produit-error-message').text(`Veuillez remplir tous les champs obligatoires du produit ${lastProduitId}.`);
                return; // Stopper l'ajout si les champs ne sont pas valides
            }

            @this.call('addProduit');

            produitCounter++;

            // click sur le bouton pour ouvrir le formulaire (canvas)
            $(`#produit-${produitCounter - 1}`).offcanvas('show');
        }

        // Réordonner les produits après suppression
        function reorderProduits() {
            produitsContainer.children('.produit-item').each(function(index) {
                const newIndex = index + 1; // Nouvel index (commence à 1)
                const produitItem = $(this);

                // Mettre à jour le conteneur principal
                produitItem.attr('id', `produit-item-${newIndex}`);

                // Mettre à jour le bouton
                const button = produitItem.find('.btn-form');
                button.text(`Produit ${newIndex}`);
                button.attr('data-bs-target', `#produit-${newIndex}`);
                button.attr('aria-controls', `produit-${newIndex}`);

                // Mettre à jour la zone offcanvas
                const offcanvas = produitItem.find('.offcanvas');
                offcanvas.attr('id', `produit-${newIndex}`);
                offcanvas.attr('aria-labelledby', `produit-${newIndex}`);
                offcanvas.find('.offcanvas-title').text(`Produit ${newIndex}`);

                // Mettre à jour les champs dans le formulaire
                produitItem.find('label[for^="name"]').attr('for', `name-${newIndex}`);
                produitItem.find('label[for^="description"]').attr('for', `description-${newIndex}`);
                produitItem.find('label[for^="price"]').attr('for', `price-${newIndex}`);
                produitItem.find('label[for^="form-img"]').attr('for', `form-img-${newIndex}`);
                produitItem.find('input[id^="name"]').attr('id', `name-${newIndex}`);
                produitItem.find('textarea[id^="description"]').attr('id', `description-${newIndex}`);
                produitItem.find('input[id^="price"]').attr('id', `price-${newIndex}`);
                produitItem.find('input[id^="form-img"]').attr('id', `form-img-${newIndex}`);

                // Mettre à jour les boutons
                produitItem.find('.save-produit-btn').attr('data-produit-id', newIndex);
                produitItem.find('.delete-produit-btn').attr('data-produit-id', newIndex);
            });

            // Réinitialiser le compteur au dernier index + 1
            produitCounter = produitsContainer.children('.produit-item').length + 1;
        }

        // Supprimer un produit
        $(document).on('click', '.delete-produit-btn', function() {
            const produitId = $(this).data('produit-id');
            $('#produit-error-message').text(''); // Réinitialiser le message d'erreur
            $(`#produit-item-${produitId}`).remove();
            reorderProduits(); // Réordonner après suppression
        });

        // Enregistrer un produit (vous pouvez personnaliser selon vos besoins)
        $(document).on('click', '.save-produit-btn', function() {
            const produitId = $(this).data('produit-id');
            if (validateFields('produit', produitId)) {
                const produitName = $(`#produit-name-${produitId}`).val();
                const produitaccompagnements = $(`#produit-description-${produitId}`).val();
                const produitPrice = $(`#produit-price-${produitId}`).val();

                // Fermer le offcanvas après enregistrement
                $(`#produit-${produitId}`).offcanvas('hide');
                $('#produit-error-message').text(''); // Réinitialiser le message d'erreur
            }
        });

        // Collecter les produits et envoyer
        function collectProduits() {
            let produitsData = [];

            $('.produit-item').each(function() {
                const produitId = $(this).attr('id').split('-')[2]; // Extraire l'ID du produit
                const name = $(`#produit-name-${produitId}`).val();
                const description = $(`#produit-description-${produitId}`).val();
                const price = $(`#produit-price-${produitId}`).val();
                const image = $(`#form-img-produit-${produitId}`).val(); // Si une image est incluse, vous pourrez la gérer ici

                produitsData.push({
                    nom: name,
                    accompagnements: description,
                    prix: price,
                    image: image // Si image est définie, elle sera envoyée
                });
            });

            return clearData(produitsData);
        }

        const clearData = (objets) => {
            return objets.filter(objet => {
                return Object.values(objet).some(value => value !== null && value !== '');
            });
        }

        // Événement pour le bouton "Ajouter"
        addProduitBtn.on('click', addProduit);
    </script>
@endpush
