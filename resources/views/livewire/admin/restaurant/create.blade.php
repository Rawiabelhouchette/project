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
