@props(['galerie'])

<div id="modal-gallery" class="modal fade mrg-top-40" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true" style="z-index: 9999 !important;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document" style="width: 80vw; max-width: 80vw;">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel3" class="modal-title">Galerie ({{ count($galerie) }} images)</h4>
                <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body padd-top-0" style="max-height: 80vh; overflow-y: auto;">
                <div class="row padd-0">
                    @foreach ([1, 2, 3, 4, 5, 6] as $i)
                        @foreach ($galerie as $image)
                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <div class="listing-shot grid-style">
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <a id="image-{{ $image->id }}" data-fancybox="gallery" href="{{ asset('storage/' . $image->chemin) }}">
                                            <img class="listing-shot-img" src="{{ asset('storage/' . $image->chemin) }}" class="img-responsive" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
