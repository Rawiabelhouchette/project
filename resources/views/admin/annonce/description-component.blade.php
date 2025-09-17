@props(['description' => null, 'required' => false])

<div class="col description">
    <h3>Description @if ($required)
            <b style="color: red; font-size: 100%;">*</b>
        @endif
    </h3>
    <textarea id="description" class="form-control" name="description" data-nom="description" placeholder="" wire:model.defer="description" @if ($required) required @endif>{{ old('description', $description) }}</textarea>
    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
