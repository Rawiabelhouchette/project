<div class="row padd-bot-15">
    <div class="col-md-12 form-group text-right pt-3">
        <div class="d-flex flex-column flex-md-row justify-content-md-end align-items-center">
            <a class="btn btn-danger mb-2 mb-md-0" href="{{ route('public.annonces.list') }}"
                style="margin-right: 10px;" wire:loading.attr="disabled">
                <i class="fa fa-times fa-lg" style="margin-right: 10px;"></i>
                Annuler
            </a>
            <button class="btn theme-btn" id="fast-food-form-submit" type="submit" style="margin-right: 30px;"
                wire:loading.attr="disabled">
                <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                Enregistrer Modifications
            </button>
        </div>
    </div>
</div>