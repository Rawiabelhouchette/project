<div>
    <form wire:submit.prevent="store">
        @csrf

            <div class="card-header bg-vamiyi-orange text-white text-center py-4">
                <h2 class="card-title font-weight-bold">Remplissez les informations</h2>
            </div>
            <div class="card-body pt-4">
                @php
                    $steps = ['Entreprise', 'Propriété', 'Caractéristiques', 'Images'];
                    $icons = ['fa-building', 'fa-home', 'fa-list', 'fa-images'];
                @endphp
                
                <x-admin.form-stepper :steps="$steps" :currentStep="$currentStep" :icons="$icons" />

                <!-- Step 1: Entreprise -->
                <div class="step-content {{ $currentStep == 0 ? '' : 'd-none' }}">
                        <div class="row align-items-start">
                            @include('admin.annonce.location-template', [
                                'pays' => $pays,
                                'villes' => $villes,
                                'quartiers' => $quartiers,
                            ])
                        </div>
                    
                    <x-admin.step-navigation :currentStep="$currentStep" :lastStep="3" />
                </div>

                <!-- Step 2: Propriété -->
                <div class="step-content {{ $currentStep == 1 ? '' : 'd-none' }}">
                    <div class="row align-items-start">
                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3 class="required">Nombre de chambre</h3>
                                <h4>Indiquez le nombre de chambre</h4>
                                <input class="form-control" name="nombre_chambre" type="number" placeholder="" wire:model.defer='nombre_chambre' required>
                                @error('nombre_chambre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3>Nombre de personnes</h3>
                                <h4>Indiquez le nombre de personnes</h4>
                                <input class="form-control" name="nombre_personne" type="number" placeholder="" wire:model.defer='nombre_personne'>
                                @error('nombre_personne')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3>Nombre de salle de bain</h3>
                                <h4>Indiquez le nombre de salle de bain</h4>
                                <input class="form-control" name="nombre_salles_bain" type="number" placeholder="" wire:model.defer='nombre_salles_bain'>
                                @error('nombre_salles_bain')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-start mt-3">
                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3>Superficie</h3>
                                <h4>Indiquez la superficie en m²</h4>
                                <input class="form-control" name="superficie" type="number" placeholder="" wire:model.defer='superficie'>
                                @error('superficie')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12 min-price p-0">
                            <div class="col">
                                <h3>Prix minimum</h3>
                                <h4>Indiquez le prix minimum</h4>
                                <input class="form-control" name="prix_min" type="number" placeholder="" wire:model='prix_min'>
                                @error('prix_min')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12 max-price p-0">
                            <div class="col">
                                <h3>Prix maximum</h3>
                                <h4>Indiquez le prix maximum</h4>
                                <input class="form-control" name="prix_max" type="number" placeholder="" wire:model='prix_max'>
                                @error('prix_max')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-start mt-3">
                        <div class="col-12">
                            <h3>Description</h3>
                            <textarea class="form-control" wire:model.defer="description" rows="5"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row align-items-start mt-3">
                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3>Pays</h3>
                                <select class="form-control" wire:model="pays_id">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($pays as $p)
                                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
                                    @endforeach
                                </select>
                                @error('pays_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3>Ville</h3>
                                <select class="form-control" wire:model="ville_id" {{ empty($pays_id) ? 'disabled' : '' }}>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($villes as $ville)
                                        <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                    @endforeach
                                </select>
                                @error('ville_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12 p-0">
                            <div class="col">
                                <h3>Quartier</h3>
                                <select class="form-control" wire:model="quartier_id" {{ empty($ville_id) ? 'disabled' : '' }}>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($quartiers as $quartier)
                                        <option value="{{ $quartier->id }}">{{ $quartier->nom }}</option>
                                    @endforeach
                                </select>
                                @error('quartier_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <x-admin.step-navigation :currentStep="$currentStep" :lastStep="3" />
                </div>

                <!-- Step 3: Caractéristiques -->
                <div class="step-content {{ $currentStep == 2 ? '' : 'd-none' }}">
                    <div class="row align-items-start">
                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Type d\'hebergement',
                            'name' => 'types_hebergement',
                            'options' => $list_types_hebergement,
                        ])

                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Type de lit',
                            'name' => 'types_lit',
                            'options' => $list_types_lit,
                            'required' => true,
                        ])

                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Commodités',
                            'name' => 'commodites',
                            'options' => $list_commodites,
                        ])
                    </div>

                    <div class="row align-items-start mt-3">
                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Services proposés',
                            'name' => 'services',
                            'options' => $list_services,
                        ])

                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Equipements d\'hébergement',
                            'name' => 'equipements_herbegement',
                            'options' => $list_equipements_herbegement,
                        ])

                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Equipements de cuisine',
                            'name' => 'equipements_cuisine',
                            'options' => $list_equipements_cuisine,
                            'required' => true,
                        ])
                    </div>

                    <div class="row align-items-start mt-3">
                        @include('admin.annonce.reference-select-component', [
                            'title' => 'Equipements de salle de bain',
                            'name' => 'equipements_salle_bain',
                            'options' => $list_equipements_salle_bain,
                        ])
                    </div>
                    
                    <x-admin.step-navigation :currentStep="$currentStep" :lastStep="3" />
                </div>

                <!-- Step 4: Images -->
                <div class="step-content {{ $currentStep == 3 ? '' : 'd-none' }}"> 
                    <div class="row">
                        @include('admin.annonce.create-galery-component', [
                            'galery' => $galerie,
                        ])
                    </div>
                    <div class="d-flex justify-content-between my-4 {{ $currentStep == 3 ? '' : 'd-none' }}">
                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep">
                            Retour
                        </button>
                        <button id="submit-btn" class="btn theme-btn" type="submit" wire:loading.attr='disabled'>
                            <i class="fa fa-save fa-lg"></i>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', function () {
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mymap);

        var marker;

        mymap.on('click', function(e) {
            if (marker) {
                mymap.removeLayer(marker);
            }

            marker = L.marker(e.latlng).addTo(mymap);
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;

            Livewire.dispatch('setLocation', [{
                lon,
                lat
            }]);
        });

        // Refresh map when step changes
        Livewire.on('stepChanged', () => {
            setTimeout(() => {
                mymap.invalidateSize();
            }, 100);
        });
    });

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

