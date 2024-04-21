@props(['caracteristiques'])

<div class="row">
    <div class="col-md-12 col-xs-12 mrg-bot-5 text-center padd-bot-5">
        <strong class="">ENTREE</strong>
    </div>
    @forelse ($caracteristiques as $key => $value)
        @if ($loop->iteration == 4)
            <div class="col-md-12 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                <strong class="">PLAT</strong>
            </div>
        @elseif ($loop->iteration == 7)
            <div class="col-md-12 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                <strong class="">DESSERT</strong>
            </div>
        @endif
        <div class="col-md-4 col-xs-12 mrg-bot-5 text-center padd-bot-5">
            {{ $key }} <br>
            <strong class="theme-cl">{{ $value }}</strong>
        </div>
    @empty
        <div class="col-md-12">
            Aucune information disponible
        </div>
    @endforelse
</div>
