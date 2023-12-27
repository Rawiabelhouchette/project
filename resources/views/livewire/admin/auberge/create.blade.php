<div>
    <div class="card">

        <div class="card-header">
            <h4>Ajouter une auberge</h4>
        </div>

        <div class="card-body">
            <form wire:submit="store()">
                @csrf
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;" wire:ignore>
                        <div class="row">
                            {{-- 
                             // TODO : Add id form label and link it to input
                            --}}
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Entreprise
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <select class="select2" wire:model.defer='entreprise_id' required data-nom="entreprise_id">
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
                                <label class="">Nom de l'hébergement
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control" placeholder="" required wire:model.defer='nom' required>
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
                                <input type="number" class="form-control" placeholder="" wire:model.defer='superficie'>
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
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_personne'>
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
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_chambre' required>
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
                                <input type="number" class="form-control" placeholder="" wire:model.defer='prix_min'>
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
                                <input type="number" class="form-control" placeholder="" wire:model.defer='prix_max'>
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
                                <input type="number" class="form-control" placeholder="" wire:model.defer='nombre_salles_bain'>
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
                                <input type="date" class="form-control" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                                @error('date_validite')
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
                        <textarea id="description" class="form-control height-100" placeholder="" wire:model.defer='description'></textarea>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Type d'hebergement
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='types_hebergement' data-nom="types_hebergement">
                            @foreach ($list_types_hebergement as $type)
                                <option value="{{ $type->id }}">{{ $type->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Type de lit
                            <b style="color: red; font-size: 100%;">*</b>
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='types_lit' data-nom="types_lit" required>
                            @foreach ($list_types_lit as $type)
                                <option value="{{ $type->id }}">{{ $type->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Commodités
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='commodites' data-nom="commodites">
                            @foreach ($list_commodites as $commodite)
                                <option value="{{ $commodite->id }}">{{ $commodite->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Services
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='services' data-nom="services">
                            @foreach ($list_services as $service)
                                <option value="{{ $service->id }}">{{ $service->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Equipements d'hébergement
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='equipements_herbegement' data-nom="equipements_herbegement">
                            @foreach ($list_equipements_herbegement as $item)
                                <option value="{{ $item->id }}">{{ $item->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Equipement de cuisine
                            <b style="color: red; font-size: 100%;">*</b>
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='equipements_cuisine' data-nom="equipements_cuisine" required>
                            @foreach ($list_equipements_cuisine as $item)
                                <option value="{{ $item->id }}">{{ $item->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" wire:ignore>
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Equipement de salle de bain
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='equipements_salle_bain' data-nom="equipements_salle_bain">
                            @foreach ($list_equipements_salle_bain as $item)
                                <option value="{{ $item->id }}">{{ $item->valeur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 40px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Galérie
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <label for="upload" class="btn btn-sm theme-btn-outlined" style="padding: 6px">
                            <i class="fa fa-upload fa-lg" style="margin-left: 10px;"></i>
                            &nbsp; &nbsp; &nbsp;
                            @if ($galerie)
                                {{ count($galerie) }} image(s) sélectionnée(s)
                            @else
                                Aucune image sélectionnée
                            @endif
                            &nbsp; &nbsp;
                        </label>
                        <input id="upload" type="file" wire:model="galerie" accept="image/*" multiple style="display: none;"> <br>
                        <div class="text-center">
                            @foreach ($galerie as $index => $image)
                                <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                            @endforeach
                        </div>

                        @error('galerie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin-top: 15px;">
                            <div class="col-md-12 col-sm-12 text-right">
                                <button wire:target='store' wire:loading.attr='disabled' type="submit" class="btn theme-btn" style="margin-right: 30px;">
                                    <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                                    Enregistrer
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
