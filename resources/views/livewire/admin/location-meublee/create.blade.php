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

                @include('admin.annonce.price-component', [
                    'min' => true,
                ])

                @include('admin.annonce.price-component', [
                    'min' => false,
                ])
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

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements d\'hébergement',
                    'name' => 'equipements_herbegement',
                    'options' => $list_equipements_herbegement,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements de cuisine',
                    'name' => 'equipements_cuisine',
                    'options' => $list_equipements_cuisine,
                ])
            </div>

            <div class="row align-items-start">
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
            });




        });
    </script>
@endpush
