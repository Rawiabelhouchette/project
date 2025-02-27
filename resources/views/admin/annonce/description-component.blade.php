<div class="col description">
    <h3>Description</h3>
    <h4>Donnez une description de votre patisserie</h4>
    <textarea id="description" class="form-control" name="description" placeholder=""
        wire:model.defer='description'></textarea>
    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>