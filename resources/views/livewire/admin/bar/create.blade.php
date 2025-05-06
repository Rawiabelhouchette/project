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
                        <h4>Sélectionnez l'entreprise</h4>
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
                        <h4>Indiquez la date d'expiration de l'annonce</h4>
                        <input class="form-control" type="date" placeholder="" disabled wire:model.defer='date_validite' required>
                        @error('date_validite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.price-component', [
                    'min' => true,
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
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.description-component')
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements vie nocturne',
                    'name' => 'equipements_vie_nocturne',
                    'options' => $list_equipements_vie_nocturne,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Commodités vie nocturne',
                    'name' => 'commodites_vie_nocturne',
                    'options' => $list_commodites_vie_nocturne,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Type de musique',
                    'name' => 'types_musique',
                    'options' => $list_types_musique,
                ])
            </div>

            @include('admin.annonce.location-template', [
                'pays' => $pays,
                'villes' => $villes,
                'quartiers' => $quartiers,
            ])

            @include('admin.annonce.create-galery-component', [
                'galery' => $galerie,
            ])

            <div class="row padd-bot-15">
                <div class="form-group">
                    <div class="col text-right">
                        <button id="submit-btn" class="btn theme-btn" type="submit" style="margin-right: 30px;" wire:loading.attr='disabled'>
                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
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
