@props(['min' => false, 'required' => false])

<div class="col-md-4 col-xs-12 {{ $min ? 'min-price' : 'max-price' }} p-0">
    <div class="col">
        <h3>{{ $min ? 'Prix minimum' : 'Prix maximum' }}
            @if ($required)
                <b style="color: red; font-size: 100%;">*</b>
            @endif
        </h3>
        <h4>{{ $min ? 'Indiquez le prix minimum' : 'Indiquez le prix maximum' }}</h4>
        <input id="{{ $min ? 'min-price-field' : 'max-price-field' }}"
               class="form-control price-input"
               name="{{ $min ? 'prix_min' : 'prix_max' }}"
               type="text"
               placeholder=""
               wire:model='{{ $min ? 'prix_min' : 'prix_max' }}'
               {{-- pattern="[0-9]*" --}}
               onkeypress="return /[0-9]/i.test(event.key)"
               onfocus="handleFocus(this)"
               onblur="handleBlur(this)"
               {{ $required ? 'required' : '' }}>
        @error($min ? 'prix_min' : 'prix_max')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<script>
    $(document).ready(function() {
        const fieldId = '{{ $min ? '#min-price-field' : '#max-price-field' }}';
        // Initialiser les champs de prix au chargement
        $(fieldId).each(function() {
            if ($(this).val().trim() !== '') {
                formatPriceDisplay($(this));
            }
        });

        $('.price-input').on('blur', function() {
            const numericValue = getNumericValue($(this).val());
            if (numericValue !== '') {
                formatPriceDisplay($(this));
            }
        });

    });

    function handleFocus(input) {
        // Obtenir la valeur numérique pure sans formatage
        $(input).val(getNumericValue($(input).val()));
    }

    function handleBlur(input) {
        // Stocker la valeur numérique avant formatage pour Livewire
        const numericValue = getNumericValue($(input).val());
        const fieldName = '{{ $min ? 'prix_min' : 'prix_max' }}';

        // Formater l'affichage de l'input si une valeur existe
        if (numericValue !== '') {
            formatPriceDisplay($(input));
            // @this.set(fieldName, numericValue);
        }

        // Mettre à jour le modèle Livewire avec la valeur numérique pure
    }

    function formatPriceDisplay($input) {
        // Obtenir la valeur numérique et la formater
        const numericValue = getNumericValue($input.val());
        const formattedNumber = new Intl.NumberFormat('fr-FR').format(numericValue);
        $input.val(formattedNumber + ' F CFA');
    }

    function getNumericValue(value) {
        // Extraire uniquement les chiffres de la valeur
        return value.replace(/[^\d]/g, '');
    }
</script>
