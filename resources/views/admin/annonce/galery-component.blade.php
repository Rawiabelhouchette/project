@props(['annonce'])
<tr>
    <td style="font-weight: bold;" width="30%" colspan="2">Galerie</td>
</tr>

<tr>
    <td colspan="2">
        <div class="text-center gallery-box">
            @foreach ($annonce->galerie as $image)
                <a data-fancybox="gallery" href="{{ asset('storage/' . $image->chemin) }}">
                    <img src="{{ asset('storage/' . $image->chemin) }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                </a>
            @endforeach
        </div>
        {{-- <div class="text-center">
            @foreach ($annonce->galerie as $image)
                <img src="{{ asset('storage/' . $image->chemin) }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
            @endforeach
        </div> --}}
    </td>
</tr>
