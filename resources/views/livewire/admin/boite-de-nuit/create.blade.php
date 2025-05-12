<div>
    <div class="nightclub-template">
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
                @include('admin.annonce.description-component')
            </div>

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

            @include('admin.annonce.create-validation-buttons')
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
