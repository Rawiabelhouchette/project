@props(['description' => null])

<div class="col description">
    <h3>Description</h3>
    <textarea id="description" class="form-control" name="description" data-nom="description" placeholder="" wire:model.defer='description'></textarea>
    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
