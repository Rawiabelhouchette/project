@props(['currentStep', 'lastStep', 'showSubmit' => false])

<div class="d-flex justify-content-between my-4">
    @if($currentStep > 0)
        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep">
            Retour
        </button>
    @else
        <div></div>
    @endif
    
    @if($currentStep < $lastStep)
        <button type="button" class="btn theme-btn" wire:click="nextStep">
            Continuer
        </button>
    @elseif($showSubmit)
        <button id="submit-btn" class="btn theme-btn" type="submit" wire:loading.attr='disabled'>
            <i class="fa fa-save fa-lg"></i>
            Enregistrer
        </button>
    @endif
</div>