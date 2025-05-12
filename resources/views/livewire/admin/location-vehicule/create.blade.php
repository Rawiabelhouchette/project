<div>
    <div class="hebergement-template">
        <form wire:submit.prevent="store">
            @csrf
            <div class="row align-items-start">
                <div class="col-md-4 col-xs-12 entreprise p-0">
                    <div class="col">
                        <h3>Entreprise
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select class="form-control" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
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

                <div class="col-md-4 col-xs-12 categorie p-0">
                    <div class="col">
                        <h3>Titre
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le titre de votre annonce</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 patisserie p-0">
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
                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Marque
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select id="marque" class="form-control" data-nom="marque_id" wire:model.lazy='marque_id' required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($list_marques as $marque)
                                <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                            @endforeach
                        </select>
                        @error('marque')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Modèle
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select class="form-control" data-nom="modele_id" wire:model.lazy='modele_id' required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($list_modeles as $modele)
                                <option value="{{ $modele->id }}">{{ $modele->nom }}</option>
                            @endforeach
                        </select>
                        @error('modele_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Année</h3>
                        
                        <input class="form-control" type="number" placeholder="" wire:model.defer='annee'>
                        @error('annee')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Kilométrage</h3>
                        
                        <input class="form-control" type="number" placeholder="" wire:model.defer='kilometrage'>
                        @error('kilometrage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Nombre de places
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_places'>
                        @error('nombre_places')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Nombre de portes
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select class="form-control" data-nom="nombre_portes" wire:model.lazy='nombre_portes' required>
                            <option value="">-- Sélectionner --</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                        </select>
                        @error('nombre_portes')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Type de moteur
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select id="carburant" class="form-control" data-nom="carburant" wire:model.defer='carburant' required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($list_types_carburant as $item)
                                <option value="{{ $item->valeur }}">{{ $item->valeur }}</option>
                            @endforeach
                        </select>
                        @error('carburant')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Boite de vitesses
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select id="boite_vitesses" class="form-control" data-nom="boite_vitesses" wire:model.defer='boite_vitesses' required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($list_boites_vitesse as $item)
                                <option value="{{ $item->valeur }}">{{ $item->valeur }}</option>
                            @endforeach
                        </select>
                        @error('boite_vitesses')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.description-component')
            </div>

            <div class="row col-md-12">
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Type de voiture',
                    'name' => 'types_vehicule',
                    'options' => $list_types_vehicule,
                    'required' => true,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Options et accessoires',
                    'name' => 'equipements_vehicule',
                    'options' => $list_equipements_vehicule,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Conditions de location',
                    'name' => 'conditions_location',
                    'options' => $list_conditions_location,
                ])

            </div>
            <div class="row col-md-12">
                @include('admin.annonce.location-template', [
                    'pays' => $pays,
                    'villes' => $villes,
                    'quartiers' => $quartiers,
                ])
            </div>

            <div class="row col-md-12">
                @include('admin.annonce.create-galery-component', [
                    'galery' => $galerie,
                ])
            </div>

            <div class="row padd-bot-15">
                <div class="form-group">
                    <div class="col text-right">
                        <button id="submit-btn" class="btn theme-btn" type="submit"  wire:loading.attr='disabled'>
                            <i class="fa fa-save fa-lg"></i>
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
            $('#submit-btn').click(function() {
                var description = $('.ql-editor').html();
                @this.set('description', description);
            });



        });
    </script>
@endpush
