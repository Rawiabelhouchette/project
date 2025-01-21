<div>
    <div class="hebergement-template">
        <form wire:submit.prevent="store">
            @csrf
            <div class="row align-items-start">
                <div class="col entreprise" wire:ignore>
                    <div>
                        <h3>Entreprise
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <select class="select2" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
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
                <div class="col nom">
                    <div>
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <input class="form-control" name="nom" type="text" placeholder="" required wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                <div class="col">
                    <div>
                        <h3>Ingrédients</h3>
                        <input class="form-control" name="ingredients" type="text" placeholder="" wire:model.defer='ingredients'>
                        @error('ingredients')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div>
                        <h3>Accompagnement</h3>
                        <input class="form-control" name="accompagnement" type="text" placeholder="" wire:model.defer='accompagnement'>
                        @error('accompagnement')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                <div class="col min-price">
                    <div>
                        <h3>Prix minimum</h3>
                        <input class="form-control" name="prix_min" type="number" placeholder="" wire:model.defer='prix_min'>
                        @error('prix_min')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col max-price">
                    <div>
                        <h3>Prix maximum</h3>
                        <input class="form-control" name="prix_max" type="number" placeholder="" wire:model.defer='prix_max'>
                        @error('prix_max')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col nb-personnes">
                    <div>
                        <h3 class="required">Date de validité</h3>
                        <input class="form-control" name="date_validite" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                        @error('date_validite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start" wire:ignore>
                <div class="col">
                    <h3>Description</h3>
                    <div class="editor" name="description" data-nom="description"></div>
                </div>
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Produits',
                    'name' => 'produits_patissiers',
                    'options' => $list_produits_patissiers,
                ])

                @include('admin.annonce.reference-select-component', [
                    'title' => 'Equipements',
                    'name' => 'equipements_patisserie',
                    'options' => $list_equipements_patisserie,
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
                        <button class="btn theme-btn" id="submit-btn" type="submit" style="margin-right: 30px;" wire:loading.attr='disabled'>
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
                console.log(description);
                console.log(JSON.stringify(quill.getContents().ops));
                @this.set('description', JSON.stringify(quill.getContents().ops));
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
