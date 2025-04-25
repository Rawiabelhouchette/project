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
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le nom de votre annonce</h4>
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
                <div class="col-md-4 col-xs-12 p-0">
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
            </div>

            <div class="row align-items-start">
                <div class="col-md-4 col-xs-12 nombre-salles-bain p-0">
                    <div class="col">
                        <h3>Nombre de salle de bain</h3>
                        <h4>Indiquez le nombre de salle de bain</h4>
                        <input class="form-control" name="nombre_salles_bain" type="number" placeholder="" wire:model.defer='nombre_salles_bain'>
                    </div>
                </div>

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

            <div class="row align-items-start">
                @include('admin.annonce.description-component')
            </div>

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
