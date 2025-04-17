<div class="row">
    <div class="add-listing-box general-info mrg-bot-25 padd-bot-30 padd-top-25 mrg-l-15 mrg-r-15">
        <div class="listing-box-header">
            <i class="fa-files theme-cl"></i>
            <h3>{{ $libelle }}</h3>
            <p>Gérez les informations de vos pays</p>
        </div>

        <form wire:submit.prevent="store">
            <div class="row mrg-r-10 mrg-l-10">
                <div class="col-sm-6">
                    <label class="required">Indicatif </label>
                    <input class="form-control" type="text" placeholder="{{ __('Indicatif du pays (ex: +228)') }}" required wire:model.defer='indicatif'>
                    @error('indicatif')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <label class="required">Nom </label>
                    <input class="form-control" type="text" placeholder="{{ __('Nom du pays') }}" required wire:model.defer='nom'>
                    @error('nom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mrg-r-10 mrg-l-10">
                <div class="col-sm-6">
                    <label class="required">Code </label>
                    <input class="form-control" type="text" placeholder="{{ __('Coed du pays (ex: TG)') }}" required wire:model.defer='code'>
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="col-sm-6">
                    <label class="required">Langue </label>
                    <input class="form-control" type="text" placeholder="{{ __('Langue du pays') }}" required wire:model.defer='langue'>
                    @error('langue')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mrg-r-10 mrg-l-10">
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
