<div>
    <div class="hebergement-template">
        <form wire:submit.prevent="update">
            @csrf
            <div class="row align-items-start">
                <div class="col-md-4 col-xs-12 entreprise p-0">
                    <div class="col">
                        <h3>Entreprise
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
                        <select class="form-control" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
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
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        
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
                <div class="col-md-4 col-xs-12 is-active p-0">
                    <div class="col">
                        <h3 class="required">Statut</h3>
                        <h4>Indiquez si l'annonce est active ou inactive</h4>
                        <select class="form-control" name="is_active" wire:model.defer='is_active' required>
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                        @error('is_active')
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

            <div class="row align-items-start">
                @include('admin.annonce.edit-galery-component', [
                    'galerie' => $galerie,
                    'old_galerie' => $old_galerie,
                ])
            </div>

            @include('admin.annonce.edit-validation-buttons')

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
