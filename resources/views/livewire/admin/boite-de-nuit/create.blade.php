<div>
    <div class="nightclub-template">
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
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Type de musique',
                        'name' => 'types_musique',
                        'options' => $list_types_musique,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements nocturnes',
                        'name' => 'equipements_vie_nocturne',
                        'options' => $list_equipements_vie_nocturne,
                    ])

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Commodités',
                        'name' => 'commodites',
                        'options' => $list_commodites,
                    ])
                </div>
                <div class="row align-items-start">

                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Services proposés',
                        'name' => 'services',
                        'options' => $list_services,
                    ])
                    @include('admin.annonce.description-component')
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
                <!-- @include('admin.annonce.create-validation-buttons') -->
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
