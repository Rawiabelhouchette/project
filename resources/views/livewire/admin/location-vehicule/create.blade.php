<div>
    <form wire:submit.prevent="store">
        @csrf

        <div class="card-header bg-vamiyi-orange py-4 text-center text-white">
            <h2 class="card-title font-weight-bold">Remplissez les informations</h2>
        </div>
        <div class="card-body pt-4">
            <!-- Stepper -->
            <div class="stepper-wrapper mb-5">
                <div class="stepper-progress d-none d-md-flex">
                    @foreach (['Entreprise', 'Véhicule', 'Spécifications', 'Images'] as $index => $step)
                        <div class="stepper-step">
                            <button type="button" class="stepper-circle {{ $currentStep > $index ? 'completed' : ($currentStep == $index ? 'active' : '') }}" wire:click="$set('currentStep', {{ $index }})" {{ $currentStep < $index ? 'disabled' : '' }}>
                                <i class="fa {{ $index == 0 ? 'fa-building' : ($index == 1 ? 'fa-car' : ($index == 2 ? 'fa-cogs' : 'fa-images')) }}"></i>
                            </button>
                            <div class="stepper-label {{ $currentStep >= $index ? 'active' : '' }}">{{ $step }}</div>
                            @if ($index < 4)
                                <div class="stepper-line {{ $currentStep > $index ? 'completed' : '' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Mobile stepper -->
                <div class="d-md-none">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-medium">
                            Étape {{ $currentStep + 1 }} sur 4:
                            {{ ['Entreprise', 'Véhicule', 'Spécifications', 'Images'][$currentStep] }}
                        </span>
                        <span class="badge badge-primary">{{ $currentStep + 1 }}/4</span>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-vamiyi-orange" role="progressbar" style="width: {{ ($currentStep + 1) * 25 }}%" aria-valuenow="{{ ($currentStep + 1) * 25 }}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 1: Company Information -->
            <div class="step-content {{ $currentStep == 0 ? '' : 'd-none' }}">
                <div class="row align-items-start">
                    @include('admin.annonce.location-template', [
                        'pays' => $pays,
                        'villes' => $villes,
                        'quartiers' => $quartiers,
                    ])
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn theme-btn" wire:click="nextStep">
                        Continuer
                    </button>
                </div>
            </div>
            <!-- Step 4: Gallery (don't ask why step 4 before 2) (and dont move it) -->
            <div class="step-content {{ $currentStep == 3 ? '' : 'd-none' }}">
                <div class="row">
                    @include('admin.annonce.create-galery-component', [
                        'galery' => $galerie,
                    ])
                </div>
                <div class="d-flex justify-content-between {{ $currentStep == 3 ? '' : 'd-none' }} my-4">
                    <button type="button" class="btn btn-outline-secondary" wire:click="previousStep">
                        Retour
                    </button>
                    <button id="submit-btn" class="btn theme-btn" type="submit" wire:loading.attr='disabled'>
                        <i class="fa fa-save fa-lg"></i>
                        Enregistrer
                    </button>
                </div>
            </div>

            <!-- Step 2: Vehicle Details -->
            <div class="step-content {{ $currentStep == 1 ? '' : 'd-none' }} m-0">
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

                            <input class="form-control montant-format" type="text" placeholder="" wire:model.defer='kilometrage'>
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
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @error('nombre_portes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @include('admin.annonce.price-component', [
                        'min' => true,
                        'required' => true,
                        'withTitle' => false,
                    ])

                    @include('admin.annonce.price-component', [
                        'min' => false,
                        'withTitle' => false,
                    ])

                </div>
                <div class="d-flex justify-content-between my-4">
                    <button type="button" class="btn btn-outline-secondary" wire:click="previousStep">
                        Retour
                    </button>
                    <button type="button" class="btn theme-btn" wire:click="nextStep">
                        Continuer
                    </button>

                </div>

            </div>

            <!-- Step 3: Specifications -->
            <div class="step-content {{ $currentStep == 2 ? '' : 'd-none' }}">
                <div class="row align-items-start">
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

                <div class="row align-items-start">

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

                <!-- <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep">
                            Retour
                        </button>
                        <button type="button" class="btn theme-btn" wire:click="nextStep">
                            Continuer
                        </button>
                    </div> -->
                <div class="d-flex justify-content-between my-4" style="height: 100%;">
                    <button type="button" class="btn btn-outline-secondary" wire:click="previousStep">
                        Retour
                    </button>
                    <button type="button" class="btn theme-btn" wire:click="nextStep">
                        Continuer
                    </button>
                </div>
            </div>
        </div>

    </form>

</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submit-btn').click(function() {
                var description = $('.ql-editor').html();
                @this.set('description', description);
            });

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
