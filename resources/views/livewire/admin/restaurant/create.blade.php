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
                                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#entree-1" type="button" aria-controls="entree-1">Entrée 1<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        
                        @foreach ($entrees as $key => $entree)
                            <div class="offcanvas offcanvas-end" id="entree-1" data-bs-scroll="true" aria-labelledby="entree-1" tabindex="-1">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="entree-1">Entrée 1</h5>
                                    <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="name-1">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control" id="name-1" type="text" required wire:model.defer='entrees.{{ $key }}.nom'>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Ingrédients</label>
                                            <textarea class="form-control" id="description" rows="3" wire:model.defer='entrees.{{ $key }}.ingredients'></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price-1">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                            <input class="form-control" id="price-1" type="text" wire:model.defer='entrees.{{ $key }}.prix_min' required>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-img-1">Image à la Une</label>
                                            <input class="form-control-file" id="form-img-1" type="file">
                                        </div>
                                        <button class="btn btn-sucess mb-2" type="submit">Enregistrer</button>
                                        <button class="btn btn-danger mb-2" type="submit">Supprimer</button>
                                    </form>
                                </div>

                                @if ($entrees_error && $key == count($entrees) - 1)
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <span class="text-danger">{{ $entrees_error }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <button class="btn btn-success btn-square" type="button" wire:click="addEntree"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col plats">
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

    <div class="page-name restaurant row">

        <div class="col-md-12">
            <div class="card title">
                <div class="card-header">
                    <h4>Ajouter un restaurant</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xs-12">
            <div class="panel-group style-1" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" id="designing" role="tab">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                Restaurant
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="designing">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form wire:submit="store()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12" style="margin-top: 15px;" wire:ignore>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label class="">Entreprise
                                                        <b style="color: red; font-size: 100%;">*</b>
                                                    </label>
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
                                        </div>

                                        <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label class="required">Nom
                                                        <b style="color: red; font-size: 100%;">*</b>
                                                    </label>
                                                    <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                                                    @error('nom')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label class="">Date de validité
                                                        <b style="color: red; font-size: 100%;">*</b>
                                                    </label>
                                                    <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                                                    @error('date_validite')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label class="">Description
                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                            </label>
                                            <textarea class="form-control height-100" id="description" placeholder="" wire:model.defer='description'></textarea>
                                        </div>

                                        <div class="col-md-12">

                                            @include('admin.annonce.reference-select-component', [
                                                'title' => 'Type de cuisine',
                                                'name' => 'specialites',
                                                'options' => $list_specialites,
                                            ])

                                            @include('admin.annonce.reference-select-component', [
                                                'title' => 'Equipements restaurant',
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

                                        @include('admin.annonce.create-galery-component', [
                                            'galery' => $galerie,
                                        ])

                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="entrees" role="tab">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                    Entrées ({{ count($entrees) }})
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTwo" role="tabpanel" aria-labelledby="entrees">
                            <div class="panel-body">
                                <div class="">

                                    <div class="card-body">
                                        @foreach ($entrees as $key => $entree)
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <label class="">Nom
                                                                    <b style="color: red; font-size: 100%;">*</b>
                                                                </label>
                                                                <textarea class="form-control" type="text" placeholder="" required wire:model.defer='entrees.{{ $key }}.nom' required></textarea>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <label class="">Ingrédients
                                                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                                </label>
                                                                <textarea class="form-control" type="text" placeholder="" wire:model.defer='entrees.{{ $key }}.ingredients'></textarea>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <label class="">Prix minimum
                                                                    <b style="color: red; font-size: 100%;">*</b>
                                                                </label>
                                                                <input class="form-control" type="number" wire:model.defer='entrees.{{ $key }}.prix_min'>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="">Prix maximum
                                                                    <b style="color: red; font-size: 100%;">*</b>
                                                                </label>
                                                                <input class="form-control" type="number" placeholder="" wire:model.defer='entrees.{{ $key }}.prix_max'>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                @if ($key == 0)
                                                                    <button class="btn theme-btn btnAdd" type="button" style="background-color: green; border-color: green" wire:click="addEntree">
                                                                        <i class="fa fa-plus fa-lg text-center" style=""></i>
                                                                        Ajouter une entrée
                                                                    </button>
                                                                @else
                                                                    <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removeEntree({{ $key }})">
                                                                        <i class="fa fa-minus fa-lg text-center" style=""></i>
                                                                        Ajouter une entrée
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($entrees_error && $key == count($entrees) - 1)
                                                        <div class="col-md-6 col-xs-12 text-center">
                                                            <span class="text-danger">{{ $entrees_error }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="plats" role="tab">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                    Plats ({{ count($plats) }})
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree" role="tabpanel" aria-labelledby="plats">
                            <div class="panel-body">
                                <div class="">

                                    @foreach ($plats as $key => $plat)
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Nom
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" required wire:model.defer='plats.{{ $key }}.nom' required></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Ingrédients
                                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='plats.{{ $key }}.ingredients'></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Accompagnements
                                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='plats.{{ $key }}.accompagnements'></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Prix minimum
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <input class="form-control" type="number" wire:model.defer='plats.{{ $key }}.prix_min'>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Prix maximum
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <input class="form-control" type="number" placeholder="" wire:model.defer='plats.{{ $key }}.prix_max'>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-sm-4 col-xl-12" style="margin-top: 15px;">
                                                    <label class="">&nbsp;</label>
                                                    @if ($key == 0)
                                                        <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addPlat">
                                                            <i class="fa fa-plus fa-lg text-center" style=""></i>
                                                        </button>
                                                    @else
                                                        <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removePlat({{ $key }})">
                                                            <i class="fa fa-minus fa-lg text-center" style=""></i>
                                                        </button>
                                                    @endif
                                                </div>

                                                @if ($plats_error && $key == count($plats) - 1)
                                                    <div class="col-md-6 col-xs-12 text-center">
                                                        <span class="text-danger">{{ $plats_error }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="desserts" role="tab">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" role="button" aria-expanded="false" aria-controls="collapseFour">
                                    Desserts ({{ count($desserts) }})
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseFour" role="tabpanel" aria-labelledby="desserts">
                            <div class="panel-body">
                                <div class="">

                                    @foreach ($desserts as $key => $dessert)
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-xl-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Nom
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" required wire:model.defer='desserts.{{ $key }}.nom' required></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Ingrédients
                                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='desserts.{{ $key }}.ingredients'></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Prix minimum
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <input class="form-control" type="number" wire:model.defer='desserts.{{ $key }}.prix_min'>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Prix maximum
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <input class="form-control" type="number" placeholder="" wire:model.defer='desserts.{{ $key }}.prix_max'>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <label class="">&nbsp;</label>
                                                    @if ($key == 0)
                                                        <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addDessert">
                                                            <i class="fa fa-plus fa-lg text-center" style=""></i>
                                                        </button>
                                                    @else
                                                        <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removeDessert({{ $key }})">
                                                            <i class="fa fa-minus fa-lg text-center" style=""></i>
                                                        </button>
                                                    @endif
                                                </div>

                                                @if ($desserts_error && $key == count($desserts) - 1)
                                                    <div class="col-md-6 col-xs-12 text-center">
                                                        <span class="text-danger">{{ $desserts_error }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row padd-bot-15">
                <div class="form-group" style="margin-top: 15px;">
                    <div class="col-md-6 col-xs-12 text-right">
                        <button class="btn theme-btn btnAdd" type="submit" style="margin-right: 30px;" wire:target='store'>
                            <i class="fa fa-add fa-lg" style="margin-right: 10px;"></i>
                            Enregistrer le restaurant
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
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
@endpush
