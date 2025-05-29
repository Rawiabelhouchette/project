@props(['pays', 'villes', 'quartiers','entreprises'])

<div>
                       <div class="row align-items-start">
                        <div class="col-md-4 col-sm-12 p-0">
                            <div class="col">
                                <h3>Entreprise
                                    <b style="color: red; font-size: 100%;">*</b>
                                </h3>
                                
                                <select class="form-control" name="entreprise_id" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
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

                        <div class="col-md-4 col-sm-12 p-0">
                            <div class="col">
                                <h3>Nom
                                    <b style="color: red; font-size: 100%;">*</b>
                                </h3>
                                
                                <input class="form-control" name="nom" data-nom="nom" type="text" placeholder="" wire:model.defer='nom' required>
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 p-0">
                            <div class="col">
                                <h3>Date de validité
                                    <b style="color: red; font-size: 100%;">*</b>
                                </h3>
                                
                                <input class="form-control" name="date_validite" data-nom="date_validite" type="date" placeholder="" disabled wire:model.defer='date_validite' required>
                                @error('date_validite')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
    <div class="row align-items-start">
        <div class="col-md-4 col-sm-12 p-0">
            <div class="col">
                <h3 class="">Pays <b style="color: red; font-size: 100%;">*</b></h3>
                
                <select class="form-control" data-nom="pays_id" wire:model.lazy='pays_id' required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($pays as $p)
                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 p-0">
            <div class="col">
                <h3 class="">Ville <b style="color: red; font-size: 100%;">*</b></h3>
                
                <select class="form-control" data-nom="ville_id" wire:model.lazy='ville_id' required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($villes as $v)
                        <option value="{{ $v->id }}">{{ $v->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 p-0">
            <div class="col">
                <h3>Quartier <b style="color: red; font-size: 100%;">*</b></h3>
                <input class="form-control" data-nom="quartier_id" type="text" wire:model='quartier_id'
                    placeholder="Saissisez le quartier" list="quartiers-list" required>
                <datalist id="quartiers-list">
                    @foreach ($quartiers as $q)
                        <option value="{{ $q->nom }}"></option>
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="row align-items-start m-0 p-2">
        <div class="row">
            <div class="col-md-12 col-sm-12" style="margin-top: 10px;">
                <button class="btn btn-sm btn-success locate-me" type="button">
                    <i class="fa fa-location-arrow"></i> Me localiser
                </button>
            </div>
        </div>
        <div class="row" wire:ignore>
            <div class="col-md-12 col-sm-12" style="margin-top: 10px;">
                <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
            </div>
        </div>
        @error('longitude')
            <span class="text-center text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
</div>