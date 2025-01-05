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
                    <div class="col entrees">
                        <h3>Entrées</h3>
                        <h4>Carte des entrées</h4>
                        <div id="entrees-container">
                            <!-- Plat 1 par défaut -->
                            <div class="form-group entree-item" id="entree-item-1">
                                <div>
                                    <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#entree-1" type="button" aria-controls="entree-1">
                                        Entrée 1 <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                                <div class="offcanvas offcanvas-end" id="entree-1" data-bs-scroll="true" aria-labelledby="entree-1" tabindex="-1">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title">Entrée 1</h5>
                                        <button class="btn-close text-reset" id="entrees-close-1" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="form-group">
                                            <label for="entree-name-1">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="entree-name-1" data-entree-id="1" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="entree-description-1">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                            <textarea class="form-control required-field" id="entree-description-1" data-entree-id="1" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="entree-price-1">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="entree-price-1" data-entree-id="1" type="number">
                                        </div>
                                        <div class="form-group">
                                            <label for="form-img-1">Image à la Une</label>
                                            <input class="form-control-file" id="form-img-entree-1" data-entree-id="1" type="file">
                                        </div>
                                        <button class="btn btn-success mb-2 save-entree-btn" data-entree-id="1" type="button">Enregistrer</button>
                                        <button class="btn btn-danger mb-2 delete-entree-btn" data-entree-id="1" type="button">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 text-center">
                            <span class="text-danger" id="entree-error-message"></span>
                        </div>
                        <button class="btn btn-success btn-square" id="add-entree-btn" type="button"><i class="fa fa-plus"></i></button>
                    </div>
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
                                            <label for="form-img-plat-1">Image à la Une</label>
                                            <input class="form-control-file" id="form-img-plat-1" data-plat-id="1" type="file">
                                        </div>
                                        <button class="btn btn-success mb-2 save-plat-btn" data-plat-id="1" type="button">Enregistrer</button>
                                        <button class="btn btn-danger mb-2 delete-plat-btn" data-plat-id="1" type="button">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 text-center">
                            <span class="text-danger" id="plat-error-message"></span>
                        </div>
                        <button class="btn btn-success btn-square" id="add-plat-btn" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col desserts">
                        <h3>Desserts</h3>
                        <h4>Carte des desserts</h4>
                        <div id="desserts-container">
                            <!-- Plat 1 par défaut -->
                            <div class="form-group dessert-item" id="dessert-item-1">
                                <div>
                                    <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#dessert-1" type="button" aria-controls="dessert-1">
                                        Dessert 1 <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                                <div class="offcanvas offcanvas-end" id="dessert-1" data-bs-scroll="true" aria-labelledby="dessert-1" tabindex="-1">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title">Dessert 1</h5>
                                        <button class="btn-close text-reset" id="desserts-close-1" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="form-group">
                                            <label for="dessert-name-1">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="dessert-name-1" data-dessert-id="1" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="dessert-description-1">Ingrédients<b style="color: red; font-size: 100%;">*</b></label>
                                            <textarea class="form-control required-field" id="dessert-description-1" data-dessert-id="1" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="dessert-price-1">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control required-field" id="dessert-price-1" data-dessert-id="1" type="number">
                                        </div>
                                        <div class="form-group">
                                            <label for="form-img-dessert-1">Image à la Une</label>
                                            <input class="form-control-file" id="form-img-dessert-1" data-dessert-id="1" type="file">
                                        </div>
                                        <button class="btn btn-success mb-2 save-dessert-btn" data-dessert-id="1" type="button">Enregistrer</button>
                                        <button class="btn btn-danger mb-2 delete-dessert-btn" data-dessert-id="1" type="button">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 text-center">
                            <span class="text-danger" id="dessert-error-message"></span>
                        </div>
                        <button class="btn btn-success btn-square" id="add-dessert-btn" type="button"><i class="fa fa-plus"></i></button>
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

    <script src="{{ asset('assets/js/annonce/restaurant.js') }}"></script>

    <script>
        $('#restaurant-form-submit').on('click', function() {
            const plats = collectPlats();
            const entrees = collectEntrees();
            const desserts = collectDesserts();
            console.log(plats);
            console.log(entrees);
            console.log(desserts);
            // verifier et enlever les plats vides
            // en suite s'assurer qu'il y a au moins un plat
            @this.set('plats', plats);
            @this.set('entrees', entrees);
            @this.set('desserts', desserts);
        });
    </script>
@endpush
