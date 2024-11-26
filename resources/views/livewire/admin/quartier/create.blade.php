<div class="card">
    <div class="card-header">
        <h4>{{ $libelle }}</h4>
    </div>

    <div class="card-body">
        <form wire:submit="store()">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xl-3">
                    <div class="row form-group">
                        <label class="col-md-3 col-sm-3 col-xl-2 required">Pays </label>
                        <div class="col-md-9 col-sm-9 col-xl-10">
                            <select class="form-control" required wire:model.live='pays_id'>
                                <option value="">-- {{ __('Choisir un pays') }} --</option>
                                @foreach ($pays as $item)
                                    <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                @endforeach
                                @error('pays_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xl-3">
                    <div class="row form-group">
                        <label class="col-md-3 col-sm-3 col-xl-2 required">Ville </label>
                        <div class="col-md-9 col-sm-9 col-xl-10">
                            <select class="form-control" required wire:model.defer='ville_id'>
                                <option value="">-- {{ __('Choisir une ville') }} --</option>
                                @foreach ($villes as $item)
                                    <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                @endforeach
                                @error('ville_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xl-3">
                    <div class="row form-group">
                        <label class="col-md-3 col-sm-3 col-xl-2 required">Quartier </label>
                        <div class="col-md-9 col-sm-9 col-xl-10">
                            <input class="form-control" type="text" placeholder="{{ __('Nom du quartier') }}" required wire:model.defer='nom'>
                            @error('nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xl-3">
                    <button class="btn theme-btn" type="submit" style="margin-right: 15px;" wire:target='store' wire:loading.attr='disabled'>
                        <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                        {{ $buttonLibelle }}
                    </button>
                    @if ($isEdit)
                        <button class="btn btn-danger" type="button" style="margin-right: 15px;" wire:loading.attr='disabled' wire:click='exitEdit'>
                            <i class="fa fa-cancel fa-lg" style="margin-right: 10px;"></i>
                            Annuler
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
