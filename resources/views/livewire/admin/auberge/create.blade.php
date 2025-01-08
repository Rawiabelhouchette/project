<div>
    <div class="hebergement-template">
        <form wire:submit="store()">
            @csrf
            <div class="row align-items-start">
                <div class="col entreprise" wire:ignore>
                    <div>
                        {{-- 
                         // TODO : Add id form h3 and link it to input
                        --}}

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
                </div>
                <div class="col nom">

                    <div>
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col room">
                    <div class="row">

                        <div>
                            <h3>Nombre de chambre
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3>
                            <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_chambre' required>
                        </div>

                    </div>
                </div>
                {{-- <div class="col">
                        <div>
                            <h3>Type d'hébergement
                            </h3> 
                            <input type="text" class="form-control" placeholder="" wire:model.defer='types_hebergement'>
                        </div>
                         
                    </div>
                </div> --}}
            </div>

            {{--   <div class="">
                    <div class="row">
                        
                        <div>
                            <h3>Superficie (m²)
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3> 
                            <input type="number" class="form-control" placeholder="" wire:model.defer='superficie'>
                        </div>
                        
                    </div>
                </div> --}}

            <div class="row align-items-start">
                <div class="col nb-personnes">
                    <div class="row">

                        <div>
                            <h3>Nombre de personnes
                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                            </h3>
                            <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_personne'>
                        </div>

                    </div>
                </div>
                <div class="col min-price">
                    <div class="row">

                        <div>
                            <h3>Prix minimum
                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                            </h3>
                            <input class="form-control" type="number" placeholder="" wire:model.defer='prix_min'>
                            @error('prix_min')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col max-price">
                    <div class="row">

                        <div>
                            <h3>Prix maximum
                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                            </h3>
                            <input class="form-control" type="number" placeholder="" wire:model.defer='prix_max'>
                            @error('prix_max')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <div class="row">

                        <div>
                            <h3>Nombre de salle de bain
                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                            </h3>
                            <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_salles_bain'>
                        </div>

                    </div>
                </div>

                <div class="col">
                    <div class="row">

                        <div>
                            <h3>Date de validité
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3>
                            <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                            @error('date_validite')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- <div class="col">
                    <div class="row">
                        
                        <div>
                            <h3>Heure de validité
                                <b style="color: red; font-size: 100%;">*</b>
                            </h3> 
                            <input type="time" class="form-control" placeholder="" wire:model.defer='heure_validite' required>
                            @error('heure_validite')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                </div> --}}

                <div class="col">
                    <h3>Description
                        {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                    </h3>
                    <textarea class="form-control height-100" id="description" placeholder="" wire:model.defer='description'></textarea>
                </div>
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
                    'title' => 'Accessoires de cuisines',
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

                @include('admin.annonce.create-galery-component', [
                    'galery' => $galerie,
                ])
            </div>

            <div class="row padd-bot-15">
                <div class="form-group">
                    <div class="col text-right">
                        <button class="btn theme-btn" type="submit" style="margin-right: 30px;" wire:target='store' wire:loading.attr='disabled'>
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
