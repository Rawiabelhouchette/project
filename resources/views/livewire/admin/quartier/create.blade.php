<div class="row">
    <div class="add-listing-box general-info mrg-bot-25 padd-bot-30 padd-top-25 mrg-l-15 mrg-r-15">
        <div class="listing-box-header">
            <i class="fa-files theme-cl"></i>
            <h3>{{ $libelle }}</h3>
            <p>Gérez les informations de vos quartiers</p>
        </div>
        <form wire:submit.prevent="store">
            <div class="row mrg-r-10 mrg-l-10">
                <div class="col-sm-6">
                    <label class="required">Pays</label>
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
                <div class="col-sm-6">
                    <label class="required">Ville</label>
                    <select class="form-control" required wire:model.live='ville_id'>
                        <option value="">-- {{ __('Choisir une ville') }} --</option>
                        @foreach ($villes as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                        @endforeach
                        @error('ville_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="required">Quartier</label>
                    <input class="form-control" type="text" placeholder="{{ __('Nom du quartier') }}" required wire:model.defer='nom'>
                </div>
                <div class="col-sm-12 padd-top-25">
                    @if ($isEdit)
                        <button class="btn" type="button" style="margin-right: 15px;" wire:click='exitEdit'>
                            <i class="fa fa-cancel fa-lg" style="margin-right: 10px;"></i> Annuler
                        </button>
                    @endif
                    <button class="btn theme-btn btnAdd" type="submit" style="margin-right: 15px;" wire:target='store' wire:loading.attr='disabled'>
                        <i class="fa fa-{{ $formIcon }} fa-lg" style="margin-right: 10px;"></i>
                        {{ $buttonLibelle }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
