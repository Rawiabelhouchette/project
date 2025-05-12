@props(['pays', 'villes', 'quartiers'])

<div>
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

    <div class="row align-items-start">
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