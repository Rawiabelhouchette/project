<div class="row">
    <div class="add-listing-box general-info mrg-bot-25 padd-bot-30 padd-top-25 mrg-l-15 mrg-r-15">
        <div class="listing-box-header">
            <i class="fa-files theme-cl"></i>
            <h3>{{ $libelle }}</h3>
            <p>Créez et modifiez les données de votre référentiel projet</p>
        </div>
        <form wire:submit="store()">
            <div class="row mrg-r-10 mrg-l-10">
                <div class="col-sm-6">
                    <label class="required">Catégorie</label>
                    <select class="form-control" name="type" required wire:model.lazy='type' @if ($isEdit) disabled @endif>
                        <option value="" selected disabled>Sélectionnez une catégorie</option>
                        @foreach ($typeList as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="required">Type</label>
                    <select class="form-control" name="type" required wire:model.lazy='nom'>
                        <option value="" selected disabled>Sélectionnez un type référence</option>
                        @foreach ($nomList as $nom)
                            <option value="{{ $nom }}">{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="required">Nom</label>
                    <input class="form-control" type="text" placeholder="Saisissez un nom" required wire:model.defer='valeur'>
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
