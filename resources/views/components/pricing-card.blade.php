@props(['offre', 'isPro' => false])

<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="pricing-card">
        <!-- Card Header -->
        <div class="pricing-header">
            <div class="gear-icon">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </div>
            <h3>{{ $offre->libelle }}</h3>
        </div>

        <!-- Price Section -->
        <div class="pricing-price">
            <h2>{{ number_format($offre->prix, 0, ',', ' ') }}<span class="currency">F CFA</span><span class="duration">/ {{ $offre->duree }} Mois</span></h2>
        </div>

        <!-- Features List -->
        <div class="pricing-features">
            @foreach ($offre->options as $feature)
                <div class="feature-item">
                    <i class="fa fa-check check-icon"></i>
                    <span>{{ $feature }}</span>
                </div>
            @endforeach
        </div>

        <!-- Button Section -->
        <div class="pricing-footer">
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">

            @if ($isPro)
                <form action="{{ route('abonnements.payement.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="offre_id" value="{{ $offre->id }}">
                    <button type="submit" class="subscribe-btn">Souscrire</button>
                </form>
            @else
                <button type="button" onclick="window.location.href='{{ route('pricing-2', ['subscription' => $offre->id]) }}'" class="subscribe-btn">Souscrire</button>
            @endif
        </div>
    </div>
</div>
<style>
    /* Pricing Card Styles */
    .pricing-card {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 8px;
        /* Ajout des coins arrondis */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        overflow: hidden;
        height: 100%;
    }

    /* Header Styles */
    .pricing-header {
        background-color: #1e2530;
        color: #fff;
        /* Changé de #6c7a94 à blanc */
        text-align: center;
        padding: 20px 15px;
        position: relative;
        border-top-left-radius: 8px;
        /* Coins arrondis pour le header */
        border-top-right-radius: 8px;
    }

    .pricing-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 500;
        color: #fff;
        /* Assurez-vous que le texte est blanc */
    }

    .gear-icon {
        background-color: rgba(255, 255, 255, 0.2);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }

    .gear-icon i {
        font-size: 18px;
        color: #fff;
    }

    /* Price Section */
    .pricing-price {
        padding: 25px 15px;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
    }

    .pricing-price h2 {
        font-size: 36px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .pricing-price .currency {
        font-size: 16px;
        color: #777;
        margin-left: 5px;
        font-weight: normal;
    }

    .pricing-price .duration {
        font-size: 16px;
        color: #777;
        margin-left: 5px;
        font-weight: normal;
    }

    /* Features List */
    .pricing-features {
        padding: 0;
    }

    .feature-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .feature-item:last-child {
        border-bottom: none;
    }

    .check-icon {
        color: #2ecc71;
        margin-right: 10px;
        font-size: 14px;
    }

    /* Button */
    .pricing-footer {
        margin-top: auto;
    }

    .subscribe-btn {
        background-color: #f5a623;
        color: white;
        border: none;
        width: 100%;
        padding: 15px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        text-align: center;
        display: block;
        border-bottom-left-radius: 8px;
        /* Coins arrondis pour le bouton */
        border-bottom-right-radius: 8px;
    }

    .subscribe-btn:hover {
        background-color: #e69819;
    }
</style>
