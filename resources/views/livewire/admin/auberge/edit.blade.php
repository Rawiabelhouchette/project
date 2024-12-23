<div>
    <div class="card">

        <div class="card-header">
            <h4>Modifier une auberge</h4>
        </div>

        <div class="card-body">
            <form wire:submit="update()">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label for="entreprise">Entreprise
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="select2" id="entreprise" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                    @endforeach
                                </select>
                                @error('entreprise_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nom
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Type d'hébergement
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" wire:model.defer='types_hebergement'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div> --}}

                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Superficie (m²)
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input class="form-control" type="number" placeholder="" wire:model.defer='superficie'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- </div>

                <div class="row"> --}}
                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de personne
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_personne'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de chambre
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_chambre' required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Prix minimum
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input class="form-control" type="number" placeholder="" wire:model.defer='prix_min'>
                                @error('prix_min')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Prix maximum
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input class="form-control" type="number" placeholder="" wire:model.defer='prix_max'>
                                @error('prix_max')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nombre de salle de bain
                                    {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                </label> <br>
                                <input class="form-control" type="number" placeholder="" wire:model.defer='nombre_salles_bain'>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Date de validité
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                                @error('date_validite')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- is_active boolean : dropdownlist --}}
                    <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Statut
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="form-control" data-nom="is_active" wire:model.defer='is_active'>
                                    <option value="1">Activé</option>
                                    <option value="0">Désactivé</option>
                                </select>
                                @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    {{-- <div class="col-md-3 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Heure de validité
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="time" class="form-control" placeholder="" wire:model.defer='heure_validite' required>
                                @error('heure_validite')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <textarea class="form-control height-100" id="description" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                </div>

                <div class="row" style="padding-left: 10px; padding-right: 10px;">
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
                        'title' => 'Commodités',
                        'name' => 'commodites',
                        'options' => $list_commodites,
                    ])

                    {{-- service --}}
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Services',
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

                    {{-- equipements_salle_bain --}}
                    @include('admin.annonce.reference-select-component', [
                        'title' => 'Equipements de salle de bain',
                        'name' => 'equipements_salle_bain',
                        'options' => $list_equipements_salle_bain,
                    ])
                </div>

                @include('admin.annonce.edit-galery-component', [
                    'galery' => $galerie,
                    'old_galerie' => $old_galerie,
                ])

                <div class="row">
                    <div class="form-group" style="margin-top: 15px;">
                        <div class="col-md-12 col-sm-12 text-right">
                            <button class="btn theme-btn" type="submit" style="margin-right: 30px;" wire:target='update' wire:loading.attr='disabled'>
                                <i class="fa fa-pencil fa-lg" style="margin-right: 10px;"></i>
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
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
