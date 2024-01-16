@props(['galery', 'required' => false])

<div class="row">
    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 20px; padding-left: 40px;padding-right: 40px;">
        <label class="">Image à la une
            <b style="color: red; font-size: 100%;">*</b>
        </label> <br>
        <label for="upload-image" class="btn btn-sm theme-btn-outlined" style="padding: 6px">
            <i class="fa fa-upload fa-lg" style="margin-left: 10px;"></i>
            &nbsp; &nbsp; &nbsp;
            @if ($old_image)
                1 image sélectionnée
            @else
                Aucune image sélectionnée
            @endif
            &nbsp; &nbsp;
        </label>
        <input id="upload-image" type="file" wire:model="image" accept="image/*" style="display: none;"> <br>
        <div class="text-center gallery-box">
            <div class="text-center gallery-box">
                @if ($image)
                    <a data-fancybox="gallery" href="{{ $image->temporaryUrl() }}">
                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                    </a>
                @else
                    @if ($old_image)
                        <a data-fancybox="gallery" href="{{ asset('storage/' . $old_image->chemin) }}">
                            <img src="{{ asset('storage/' . $old_image->chemin) }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                        </a>
                    @endif
                @endif
            </div>
        </div>

        @error('old_image')
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
            @elseif (count($old_galerie) > 0)
                {{ count($old_galerie) }} image(s) sélectionnée(s)
            @else
                Aucune image sélectionnée
            @endif
            &nbsp; &nbsp;
        </label>
        <input id="upload" type="file" wire:model="galerie" accept="image/*" multiple style="display: none;"> <br>
        <div class="text-center">
            <div class="text-center gallery-box">
                @foreach ($galerie as $index => $image)
                    <a data-fancybox="gallery" href="{{ $image->temporaryUrl() }}">
                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                    </a>
                @endforeach
            </div>
            @if (empty($galerie))
                @foreach ($old_galerie as $image)
                    <a data-fancybox="gallery" href="{{ asset('storage/' . $image->chemin) }}">
                        <img src="{{ asset('storage/' . $image->chemin) }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                    </a>
                @endforeach
            @endif
        </div>

        @error('galerie')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
