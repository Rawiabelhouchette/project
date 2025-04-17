@props([
    'withCancel' => true,
    'cancelLink' => route('public.annonces.list'),
    'cancelText' => 'Annuler',
])

<div class="row padd-bot-15">
    <div class="col-md-12 form-group pt-3 text-right">
        <div class="d-flex flex-column flex-md-row justify-content-md-end align-items-center">
            @if ($withCancel)
                <a class="btn btn-danger mb-md-0 mb-2" href="{{ $cancelLink }}" style="margin-right: 10px;" wire:loading.attr="disabled">
                    <i class="fa fa-times fa-lg" style="margin-right: 10px;"></i>
                    {{ $cancelText }}
                </a>
            @endif
            <button id="fast-food-form-submit" class="btn theme-btn" type="submit" style="margin-right: 30px;" wire:loading.attr="disabled">
                <i class="fa fa-edit fa-lg" style="margin-right: 10px;"></i>
                Enregistrer Modifications
            </button>
        </div>
    </div>
</div>
