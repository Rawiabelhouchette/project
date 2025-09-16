<div>
    <div class="hebergement-template">
        <form wire:submit.prevent="store">
            @csrf
            <div class="card-header bg-vamiyi-orange text-white text-center py-4">
                <h2 class="card-title font-weight-bold">Remplissez les informations</h2>
            </div>

            @php
                $steps = ['Entreprise', 'Description', 'Options', 'Images'];
                $icons = ['fa-briefcase', 'fa-info-circle', 'fa-building', 'fa-image'];
            @endphp
            <x-admin.form-stepper :steps="$steps" :currentStep="$currentStep" :icons="$icons" />

            <!-- Step 1: Entreprise -->
            <div class="step-content {{ $currentStep == 0 ? '' : 'd-none' }}">
                    <div class="row align-items-start">
                        @include('admin.annonce.location-template', [
                            'pays' => $pays,
                            'villes' => $villes,
                            'quartiers' => $quartiers,
                            'entreprises' => $entreprises,
                        ])
                    </div>
                <x-admin.step-navigation :currentStep="$currentStep" :lastStep="3" />
            </div>

            <!-- Step 2: Description -->
            <div class="step-content {{ $currentStep == 1 ? '' : 'd-none' }}">
                <div class="row align-items-start">
                    @include('admin.annonce.price-component', [
                        'min' => true,
                        'required' => true,
                    ])

                    @include('admin.annonce.price-component', [
                        'min' => false,
                    ])

                    <div class="col-md-4 col-xs-12 nombre-salles-bain p-0">
                        <div class="col">
                            <h3>Nombre de salle de bain</h3>
                            <h4>Indiquez le nombre de salle de bain</h4>
                            <input class="form-control" name="nombre_salles_bain" type="number" placeholder="" wire:model.defer='nombre_salles_bain'>
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-md-4 col-xs-12 nombre-personnes p-0">
                        <div class="col">
                            <h3>Nombre de personnes</h3>
                            <h4>Indiquez le nombre de personnes</h4>
                            <input class="form-control" name="nombre_personne" type="number" placeholder="" wire:model.defer='nombre_personne'>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12 nombre-chambres p-0">
                        <div class="col">
                            <h3>Nombre de chambre
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3>
                            <h4>Indiquez le nombre de chambres</h4>
                            <input class="form-control" name="nombre_chambre" type="number" placeholder="" wire:model.defer='nombre_chambre' required>
                        </div>
                    </div>
                </div>
                <x-admin.step-navigation :currentStep="$currentStep" :lastStep="3" />
            </div>


            <!-- Step 3: Options -->
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
                        'title' => 'Commodités hébergement',
                        'name' => 'commodites',
                        'options' => $list_commodites,
                    ])
                </div>
                <div class="row align-items-start">
                    {{-- service --}}
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Services proposés',
                        'name' => 'services',
                        'options' => $list_services,
                    ])

                    {{-- equipements_herbegement --}}
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements d\'hébergement',
                        'name' => 'equipements_herbegement',
                        'options' => $list_equipements_herbegement,
                    ])

                    {{-- equipements_cuisine --}}
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Accessoires de cuisine',
                        'name' => 'equipements_cuisine',
                        'options' => $list_equipements_cuisine,
                        'required' => true,
                    ])
                </div>
                <div class="row align-items-start">
                    {{-- equipements_salle_bain --}}
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements de salle de bain',
                        'name' => 'equipements_salle_bain',
                        'options' => $list_equipements_salle_bain,
                    ])
                    @include('admin.annonce.description-component')
                </div>
                <x-admin.step-navigation :currentStep="$currentStep" :lastStep="3" />
            </div>


            <!-- Step 4: Images -->
            <div class="step-content {{ $currentStep == 3 ? '' : 'd-none' }}">
                <div class="row align-items-start">
                    @include('admin.annonce.create-galery-component', [
                        'galery' => $galerie,
                    ])
                </div>
                <div class="row padd-bot-15 {{ $currentStep == 3 ? '' : 'd-none' }}">
                    <div class="form-group">
                        <div class="col text-right">
                            <button id="submit-btn" class="btn theme-btn" type="submit" wire:loading.attr='disabled'>
                                <i class="fa fa-save fa-lg"></i>
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
            $('#submit-btn').click(function() {
                var description = $('.ql-editor').html();
                @this.set('description', description);
            });




        });
    </script>
@endpush
