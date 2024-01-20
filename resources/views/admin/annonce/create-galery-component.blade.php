@props(['galery', 'required' => false])

<div class="row">
    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 20px; padding-left: 40px;padding-right: 40px;">
        <label class="">Image à la une @error('image') wewewew @enderror
            <b style="color: red; font-size: 100%;">*</b>
        </label> <br>
        <label for="upload-image" class="btn btn-sm theme-btn-outlined" style="padding: 6px">
            <i class="fa fa-upload fa-lg" style="margin-left: 10px;"></i>
            &nbsp; &nbsp; &nbsp;
            @if ($image)
                1 image sélectionnée
            @else
                Aucune image sélectionnée
            @endif
            &nbsp; &nbsp;
        </label>
        <input id="upload-image" type="file" wire:model="image" accept="image/*" style="display: none;" required> <br>
        <div class="text-center gallery-box">
            @if ($image)
                <a data-fancybox="gallery" href="{{ $image->temporaryUrl() }}">
                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                </a>
            @endif
        </div>

        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 40px; padding-left: 40px;padding-right: 40px;">
        <label class="">Galérie
            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
        </label> <br>
        <label for="upload" class="btn btn-sm theme-btn-outlined" style="padding: 6px">
            <i class="fa fa-upload fa-lg" style="margin-left: 10px;"></i>
            &nbsp; &nbsp; &nbsp;
            @if ($galerie)
                {{ count($galerie) }} image(s) sélectionnée(s)
            @else
                Aucune image sélectionnée
            @endif
            &nbsp; &nbsp;
        </label>
        <input id="upload" type="file" wire:model="galerie" accept="image/*" multiple style="display: none;"> <br>
        <div class="text-center gallery-box">
            @foreach ($galerie as $index => $image)
                <a data-fancybox="gallery" href="{{ $image->temporaryUrl() }}">
                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                </a>
            @endforeach
        </div>

        @error('galerie')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
