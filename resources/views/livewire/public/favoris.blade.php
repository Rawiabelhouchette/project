<div>
    @php
        $defaultColor = '#de6600';
    @endphp

    @if (Auth::check())
        <button wire:click='updateFavoris' wire:loading.attr="disabled" class="buttons padd-10 favoris-btn-show" style="background: {{ $isEnabled ? $defaultColor : 'white' }}; color: {{ $isEnabled ? 'white' : 'grey' }};">
            <i class="fa fa-heart"></i>
            <!-- <span class="hidden-xs">Favoris</span> -->
        </button>
    @else
        <button data-bs-toggle="modal" data-bs-target="#signin" class="buttons padd-10 favoris-btn-show" style="background: white;" onclick="$('#share').hide()">
            <i class="fa fa-heart"></i>
            <!-- <span class="hidden-xs">Favoris</span> -->
        </button>
    @endif
    




    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.favoris-btn-show').click(function() {
                    $('#share').hide();
                    $('#modal-gallery').hide();
                });
            });
        </script>
    @endpush
</div>

