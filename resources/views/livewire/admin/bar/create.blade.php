<div>
    <div class="hebergement-template">
        <form wire:submit.prevent="store">
            @csrf
            <div class="card-header bg-vamiyi-orange text-white text-center py-4">
                <h2 class="card-title font-weight-bold">Remplissez les informations</h2>
            </div>

            @php
                $steps = ['Entreprise', 'Description', 'Images'];
                $icons = ['fa-briefcase', 'fa-info-circle', 'fa-image'];
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
                <x-admin.step-navigation :currentStep="$currentStep" :lastStep="2" />
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
                            <h3>Capacité d'accueil</h3>
                            <h4>Indiquez la capacité d'accueil</h4>
                            <input class="form-control" name="capacite_accueil" type="number" placeholder="" wire:model.defer='capacite_accueil' min="0">
                            @error('capacite_accueil')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12 nombre-salles-bain p-0">
                        <div class="col">
                            <h3>Type de bar</h3>
                            <h4>Indiquez le type de bar</h4>
                            <input class="form-control" name="type_bar" type="text" placeholder="" wire:model.defer='type_bar' min="0">
                            @error('type_bar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        @include('admin.annonce.description-component')
                    </div>
                </div>
                <div class="row align-items-start">
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements vie nocturne',
                        'name' => 'equipements_vie_nocturne',
                        'options' => $list_equipements_vie_nocturne,
                        'required' => true,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Commodités vie nocturne',
                        'name' => 'commodites_vie_nocturne',
                        'options' => $list_commodites_vie_nocturne,
                        'required' => true,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Type de musique',
                        'name' => 'types_musique',
                        'options' => $list_types_musique,
                    ])
                </div>
                <x-admin.step-navigation :currentStep="$currentStep" :lastStep="2" />
            </div>

            <!-- Step 3: Images -->
            <div class="step-content {{ $currentStep == 2 ? '' : 'd-none' }}">
                <div class="row align-items-start">
                    @include('admin.annonce.create-galery-component', [
                        'galery' => $galerie,
                    ])
                </div>
                <div class="row padd-bot-15 {{ $currentStep == 2 ? '' : 'd-none' }}">
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
