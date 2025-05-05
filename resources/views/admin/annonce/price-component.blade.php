@props(['title', 'description', 'name', 'required' => true])

<div class="col-md-4 col-xs-12 max-price p-0">
    <div class="col">
        <h3>{{ $title }}</h3>
        <h4>{{ $description }}</h4>
        <input 
            class="form-control price-input" 
            name="{{ $name }}" 
            type="text" 
            placeholder="" 
            wire:model='{{ $name }}' 
            pattern="[0-9]*" 
            onkeypress="return /[0-9]/i.test(event.key)"
            onfocus="handleFocus(this)"
            onblur="handleBlur(this)"
            {{ $required ? 'required' : '' }}
        >
        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<script>
    function handleFocus(input) {
        // Remove 'F CFA' when focused
        input.value = input.value.replace(' F CFA', '');
    }

    function handleBlur(input) {
        // Add 'F CFA' when blurred if there's a value
        if (input.value.trim() !== '' && !input.value.includes(' F CFA')) {
            input.value = input.value + ' F CFA';
        }
        
        // Update the Livewire model with the clean value (without 'F CFA')
        const cleanValue = input.value.replace(' F CFA', '');
        @this.set('{{ $name }}', cleanValue);
    }
</script>
