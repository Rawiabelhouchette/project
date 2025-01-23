<div>
    <div class="page-name restaurant row">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="container text-left">
                <div class="row align-items-start">
                    <div class="col entreprise" wire:ignore>
                        <div>
                            <h3>Entreprise
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3>
                            <h4>Sélectionnez l'entreprise</h4>
                            <select class="select2" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
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
                                                <input class="form-control-file" id="form-img-entree-{{ $index + 1 }}" type="file" required wire:model="entrees.{{ $index }}.image" accept="image/*">
                                                {{-- <span>
                                                    @if ($entrees[$index]['image'])
                                                        <img src="{{ $entrees[$index]['image']->temporaryUrl() }}" alt="" style="width: 100px; height: 100px;">
                                                    @endif
                                                </span> --}}
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
                            @if ($entrees_error)
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $entrees_error }}</span>
                                </div>
                            @endif
                            @error('entrees')
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                            <button class="btn btn-success btn-square" id="add-entree-btn" type="button" wire:click="addEntree"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    {{-- <div class="col plats">
                        <h3>Plats <b style="color: red; font-size: 100%;">*</b></h3>
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
                            @error('plats')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-success btn-square" id="add-plat-btn" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col desserts">
                        <h3>Desserts <b style="color: red; font-size: 100%;">*</b></h3>
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
                            @error('desserts')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-success btn-square" id="add-dessert-btn" type="button"><i class="fa fa-plus"></i></button>
                    </div> --}}
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
@endpush
