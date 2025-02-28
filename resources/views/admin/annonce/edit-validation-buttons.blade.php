<div class="row padd-bot-15">
    <div class="form-group">
        <div class="col text-right">
            <a class="btn btn-danger" href="{{ route('public.annonces.list') }}" style="margin-right: 30px;"
                wire:loading.attr="disabled">
                <i class="fa fa-times fa-lg" style="margin-right: 10px;"></i>
                Annuler
            </a>
            <button class="btn theme-btn" id="fast-food-form-submit" type="submit"
                style="margin-right: 30px;" wire:loading.attr="disabled">
                <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                Enregistrer Modifications
            </button>
        </div>
    </div>
</div>