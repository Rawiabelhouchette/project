<div>
   <div class="restaurant-template">
        <form wire:submit="store()">
            @csrf
            <div class="container text-left">
                <div class="row align-items-start">
                    <div class="col" wire:ignore>
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
                    <div class="col">
                        <label class="required">Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </label>
                        <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="">Date de validité
                            <b style="color: red; font-size: 100%;">*</b>
                        </label>
                        <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                        @error('date_validite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row align-items-start">                    
                    <div class="col">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label>
                        <textarea class="form-control height-100" id="description" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Type de cuisine',
                        'name' => 'specialites',
                        'options' => $list_specialites,
                    ])
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Services proposés',
                        'name' => 'services',
                        'options' => $list_services,
                    ])
                </div>
                <div class="row align-items-start">
                   <!--  <div class="col entreprise">
                        <h3>Établissement</h3>
                        <h4>Saisissez les coordonnées de l'établissement</h4>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#entreprise" aria-controls="entreprise-1">Mon établissement<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="entreprise" aria-labelledby="entreprise">
                          <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="entreprise-1">Mon entreprise</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>
                          <div class="offcanvas-body">
                             <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                    <input type="text" class="form-control" id="name" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Téléphone<b style="color: red; font-size: 100%;">*</b></label>
                                    <input type="text" class="form-control telephone" id="name" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label for="ets-email" class="form-label">Email<b style="color: red; font-size: 100%;">*</b></label>
                                    <input type="email" class="form-control" id="ets-email" aria-describedby="email">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="description" aria-describedby="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">Whatsapp</label>
                                    <input type="number" class="form-control" id="whatsapp" aria-describedby="whatsapp">
                                </div>
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="url" class="form-control" id="facebook" aria-describedby="facebook">
                                </div>
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="url" class="form-control" id="instagram" aria-describedby="instagram">
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label">Site web</label>
                                    <input type="url" class="form-control" id="website" aria-describedby="website">
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
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="number" class="form-control" id="longitude" aria-describedby="longitude">
                                </div>
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="number" class="form-control" id="latitude" aria-describedby="latitude">
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
                            
                            <button class="btn btn-sucess mb-2">Enregistrer</button>
                            <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    </div> -->
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements restaurant',
                        'name' => 'equipements_restauration',
                        'options' => $list_equipements_restauration,
                    ])
                    <div class="col consomations">
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Boissons disponibles',
                        'name' => 'carte_consommation',
                        'options' => $list_carte_consommation,
                    ])
                </div>
                </div>
                <div class="row align-items-start">
                    <div class="col entrees">
                        <h3>Entrées ({{ count($entrees) - 1 }})</h3>
                        <h4>Carte des entrées</h4>
                        @foreach ($entrees as $key => $entree)
                        <div class="form-group">
                            
                            <div>
                                <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#entrees-{{ $key }}" aria-controls="entrees-{{ $key }}">Entrée {{ $key + 1 }}<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="entrees-{{ $key }}" aria-labelledby="entrees-{{ $key }}">
                          <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="entrees-{{ $key }}">Entrée {{ $key + 1 }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                             <form>
                                <div class="form-group">
                                    <label for="name-{{ $key }}">Nom</label>
                                    <input type="text" class="form-control" id="name-{{ $key }}" required wire:model.defer='entrees.{{ $key }}.nom' required>
                                </div>
                                <div class="form-group">
                                    <label for="ingredients-{{ $key }}">Ingrédients</label>
                                    <textarea class="form-control" id="ingredients-{{ $key }}" rows="3" required wire:model.defer='entrees.{{ $key }}.ingredients' required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price-{{ $key }}">Prix min</label>
                                    <input type="text" class="form-control" id="price-{{ $key }}" required wire:model.defer='entrees.{{ $key }}.prix_min' required>
                                </div>
                                <div class="form-group">
                                    <label for="price-{{ $key }}">Prix max</label>
                                    <input type="text" class="form-control" id="price-{{ $key }}" required wire:model.defer='entrees.{{ $key }}.prix_max' required>
                                </div>
                                <div class="form-group">
                                    <label for="form-img-{{ $key }}">Image à la Une</label>
                                    <input type="file" class="form-control-file" id="form-img-{{ $key }}">
                                </div>
                                <button type="submit" class="btn btn-sucess mb-2" data-bs-dismiss="offcanvas" wire:click="addEntree">Enregistrer</button>
                                <button type="submit" class="btn btn-danger mb-2" wire:click="removeEntree({{ $key }})">Supprimer</button>
                            </form>
                        </div>
                    </div>
                        @endforeach
                        <button type="button" class="btn btn-success btn-square" wire:click="addEntree"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col plats">
                        <h3>Plats ({{ count($plats) - 1 }})</h3>
                        <h4>Carte des plats</h4>                                    
                        @foreach ($plats as $key => $plat)
                        <div class="form-group">
                            <div>
                                <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#plats-{{ $key }}" aria-controls="plats-{{ $key }}">Plat {{ $key + 1 }}<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="plats-{{ $key }}" aria-labelledby="plats-{{ $key }}">
                          <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="plats-{{ $key }}">Plat {{ $key + 1 }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>
                          <div class="offcanvas-body">
                             <form>
                                <div class="form-group">
                                    <label for="plat-name-{{ $key }}">Nom</label>
                                    <input type="text" class="form-control" id="plat-name-{{ $key }}" required wire:model.defer='plats.{{ $key }}.nom' required>
                                </div>
                                <div class="form-group">
                                    <label for="plat-ingredients-{{ $key }}">Ingrédients</label>
                                    <textarea class="form-control" id="plat-ingredients-{{ $key }}" rows="3" required wire:model.defer='plats.{{ $key }}.ingredients' required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="plat-accompagnements-{{ $key }}">Accompagnements</label>
                                    <textarea class="form-control" id="plat-accompagnements-{{ $key }}" rows="3" required wire:model.defer='plats.{{ $key }}.accompagnements' required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="plat-price-min-{{ $key }}">Prix min</label>
                                    <input type="text" class="form-control" id="plat-price-{{ $key }}" required wire:model.defer='plats.{{ $key }}.prix_min' required>
                                </div>
                                <div class="form-group">
                                    <label for="plat-price-max-{{ $key }}">Prix max</label>
                                    <input type="text" class="form-control" id="price-{{ $key }}" required wire:model.defer='plats.{{ $key }}.prix_max' required>
                                </div>
                                <div class="form-group">
                                    <label for="plat-form-img-{{ $key }}">Image à la Une</label>
                                    <input type="file" class="form-control-file" id="plat-form-img-{{ $key }}">
                                </div>
                                <button type="submit" class="btn btn-sucess mb-2" data-bs-dismiss="offcanvas" wire:click="addPlat">Enregistrer</button>
                                <button type="submit" class="btn btn-danger mb-2" wire:click="removePlat({{ $key }})">Supprimer</button>
                            </form>
                        </div>
                    </div>
                         @endforeach
                        <button type="button" class="btn btn-success btn-square" wire:click="addPlat"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col desserts">
                        <h3>Desserts ({{ count($desserts) - 1 }})</h3>
                        <h4>Carte des desserts</h4>
                        @foreach ($desserts as $key => $dessert)
                        <div class="form-group">
                            <div>
                                <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#dessert-{{ $key }}" aria-controls="dessert-{{ $key }}">Dessert {{ $key + 1 }}<i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="dessert-{{ $key }}" aria-labelledby="dessert-{{ $key }}">
                          <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="dessert-{{ $key }}">Dessert {{ $key + 1 }}</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>
                          <div class="offcanvas-body">
                             <form>
                                <div class="form-group">
                                    <label for="name-{{ $key }}">Nom</label>
                                    <input type="text" class="form-control" id="name-{{ $key }}" required wire:model.defer='desserts.{{ $key }}.nom' required>
                                </div>
                                <div class="form-group">
                                    <label for="ingredients-{{ $key }}">Ingrédients</label>
                                    <textarea class="form-control" id="ingredients-{{ $key }}" rows="3" required wire:model.defer='desserts.{{ $key }}.ingredients' required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price-{{ $key }}">Prix</label>
                                    <input type="text" class="form-control" id="price-{{ $key }}" required wire:model.defer='desserts.{{ $key }}.prix_min' required>
                                </div>
                                <div class="form-group">
                                    <label for="price-{{ $key }}">Prix</label>
                                    <input type="text" class="form-control" id="price-{{ $key }}" required wire:model.defer='desserts.{{ $key }}.prix_max' required>
                                </div>
                                <div class="form-group">
                                    <label for="form-img-{{ $key }}">Image à la Une</label>
                                    <input type="file" class="form-control-file" id="form-img-{{ $key }}">
                                </div>
                                <button type="submit" class="btn btn-sucess mb-2" data-bs-dismiss="offcanvas" wire:click="addDessert">Enregistrer</button>
                                <button type="submit" class="btn btn-danger mb-2" wire:click="removeDessert({{ $key }})">Supprimer</button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                        <button type="button" class="btn btn-success btn-square" wire:click="addDessert"><i class="fa fa-plus"></i></button>
            
                     </div>
                </div>
                <div class="row align-items-start">
                    @include('admin.annonce.create-galery-component', [
                        'galery' => $galerie,
                    ])
                </div>
                <div class="row align-items-end">
                    <!-- <button type="submit" class="btn btn-danger mb-2">Supprimer l'annonce</button> -->
                    <button twire:target='store' wire:loading.attr='disabled' type="submit" class="btn theme-btn" s>Sauvegarder l'annonce</button>
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
        document.addEventListener("DOMContentLoaded", function(){
          var myOffcanvas = document.getElementByCassName('offcanvas');
          var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
          document.getElementById("OpenMenu").addEventListener('click',function (e){
            e.preventDefault();
            e.stopPropagation();
            bsOffcanvas.toggle();
          });
        });
    </script>
@endpush
