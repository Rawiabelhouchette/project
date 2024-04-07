@props(['caracteristiques'])

<div class="row">
    @forelse ($caracteristiques as $key => $value)
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
