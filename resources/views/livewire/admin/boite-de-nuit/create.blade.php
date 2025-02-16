<div>
    <div class="nightclub-template">
        <form wire:submit.prevent="store">
            @csrf
            <div class="row align-items-start">
                <div class="col entreprise" wire:ignore>
                    <div>
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

                <div class="col date-validite">
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
                    {{-- <textarea class=" editor" id="description" placeholder="" wire:model.defer='description'></textarea> --}}
                    <div class="editor" name="description" data-nom="description"></div>
                </div>
            </div>

            {{-- Type de musique --}}
            @include('admin.annonce.reference-select-component', [
                'title' => 'Type de musique',
                'name' => 'types_musique',
                'options' => $list_types_musique,
            ])

            {{-- Equipements nocturnes --}}
            @include('admin.annonce.reference-select-component', [
                'title' => 'Equipements nocturnes',
                'name' => 'equipements_vie_nocturne',
                'options' => $list_equipements_vie_nocturne,
            ])

            {{-- Commodités --}}
            @include('admin.annonce.reference-select-component', [
                'title' => 'Commodités',
                'name' => 'commodites',
                'options' => $list_commodites,
            ])

            {{-- Services --}}
            @include('admin.annonce.reference-select-component', [
                'title' => 'Services',
                'name' => 'services',
                'options' => $list_services,
            ])

            @include('admin.annonce.location-template', [
                'pays' => $pays,
                'villes' => $villes,
                'quartiers' => $quartiers,
            ])

            @include('admin.annonce.create-galery-component', [
                'galery' => $galerie,
            ])

            <div class="row padd-bot-15">
                <div class="form-group" style="margin-top: 15px;">
                    <div class="col-md-12 col-sm-12 text-right">
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
