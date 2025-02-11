@props(['pays', 'villes', 'quartiers'])

<div>
    <div class="row align-items-start">
        <div class="col">
            <div>
                <h3 class="">Pays <b style="color: red; font-size: 100%;">*</b></h3>
                <h4>Sélectionnez un élément dans la liste</h4>
                <select class="form-control" data-nom="pays_id" wire:model.lazy='pays_id' required>
                    <option value="">Sélectionnez un pays</option>
                    @foreach ($pays as $p)
                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
            <div>
                <h3 class="">Ville <b style="color: red; font-size: 100%;">*</b></h3>
                <h4>Sélectionnez un élément dans la liste</h4>
                <select class="form-control" data-nom="ville_id" wire:model.lazy='ville_id' required>
                    <option value="">Sélectionnez une ville</option>
                    @foreach ($villes as $v)
                        <option value="{{ $v->id }}">{{ $v->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
            <div>
                <h3>Quartier <b style="color: red; font-size: 100%;">*</b></h3>
                <h4>Saisissez le nom du quartier</h4>
                <input class="form-control" data-nom="quartier_id" type="test" wire:model='quartier_id' placeholder="Saissisez le quartier" required>
                {{-- <select class="form-control" data-nom="quartier_id" wire:model.lazy='quartier_id'>
                    <option value="">Sélectionnez un quartier</option>
                    @foreach ($quartiers as $q)
                        <option value="{{ $q->id }}">{{ $q->nom }}</option>
                    @endforeach
                </select> --}}
            </div>
        </div>
    </div>

    <div class="row align-items-start">
        <button class="btn btn-success locate-me" type="button">
            <i class="fa fa-location-arrow"></i> Me localiser
        </button>
        <div class="row" wire:ignore>
            <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
            </div>
        </div>
        @error('longitude')
            <span class="text-center text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
</div>
