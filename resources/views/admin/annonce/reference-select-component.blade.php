@props(['title', 'name', 'options', 'required' => false])

<div class="col">
    <div wire:ignore>
        <h3 class="">{{ $title }}
            @if ($required)
                <b style="color: red; font-size: 100%;">*</b>
            @endif
        </h3>
        <h4>Sélectionnez un élément dans la liste</h4>
        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='{{ $name }}' data-nom="{{ $name }}" @if ($required) required @endif name="{{ $name }}[]">
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->valeur }}</option>
            @endforeach
        </select>
    </div>

    <div class="px-2">
        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
