@props(['offre', 'isPro' => false])

<div class="col-md-4 col-sm-6 col-xs-12 mb-2">
    <div class="package-box">
        <div class="package-header">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <h3>{{ $offre->libelle }}</h3>
        </div>
        <div class="package-price" style="">
            <h3 class="mrg-top-0" style="font-family: 'Poppins', sans-serif; font-size: 27px !important; color: #26354e; margin-bottom: .25em; ">{{ number_format($offre->prix, 0, ',', ' ') }} <sup style="font-size: 15px;">F CFA </sup><sub>/ {{ $offre->duree }} {{ $offre->unite_fr }}</sub></h3>
        </div>
        <div class="package-info" style="font-family: 'Muli', sans-serif;">
            <ul>
                @foreach ($offre->options as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        </div>
        <input type="hidden" name="offre_id" value="{{ $offre->id }}">

        @if ($isPro)
            <form action="{{ route('abonnements.payement.check') }}" method="POST">
                @csrf
                <input type="hidden" name="offre_id" value="{{ $offre->id }}">
                <button type="submit" class="btn btn-package pricing-submit-btn">Souscrire</button>
            </form>
        @else
            <button type="button" onclick="window.location.href='{{ route('pricing-2', ['subscription' => $offre->id]) }}'" class="btn btn-package">Souscrire</button>
        @endif
    </div>
</div>
