@props(['offre', 'isPro' => false, 'withButton' => true])

<div class="amiyi-pricing-card">
    <!-- Card Header -->
    <div class="amiyi-card-header">
        <div class="amiyi-icon-wrapper">
            <!-- Crown icon instead of gear -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="amiyi-icon">
                <path d="M2.5 18.5H21.5V20.5H2.5V18.5ZM20 8L14 10L12 4L10 10L4 8L6 15H18L20 8Z" fill="currentColor" />
            </svg>
        </div>
        <h3 class="amiyi-plan-title">{{ $offre->libelle }}</h3>
    </div>

    <!-- Price Section -->
    <div class="amiyi-price-section">
        <h2 class="amiyi-price">{{ number_format($offre->prix, 0, ',', ' ') }}<span class="amiyi-currency">F CFA</span></h2>
        <div class="amiyi-duration">{{ $offre->duree }} {{ $offre->unite_fr }}</div>
    </div>

    <!-- Features List -->
    <div class="amiyi-features-list">
        @foreach ($offre->options as $feature)
            <div class="amiyi-feature">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" class="amiyi-feature-icon">
                    <path d="M16.172 11L10.808 5.636L12.222 4.222L20 12L12.222 19.778L10.808 18.364L16.172 13H4V11H16.172Z" fill="currentColor" />
                </svg>
                <span class="amiyi-feature-text">{{ $feature }}</span>
            </div>
        @endforeach
    </div>

    @if ($withButton)
        <!-- Button Section -->
        <div class="amiyi-card-footer">
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">

            @if ($isPro)
                <form action="{{ route('abonnements.payement.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="offre_id" value="{{ $offre->id }}">
                    <button type="submit" class="amiyi-subscribe-button">Souscrire</button>
                </form>
            @else
                <button type="button" onclick="window.location.href='{{ route('pricing-2', ['subscription' => $offre->id]) }}'" class="amiyi-subscribe-button">Souscrire</button>
            @endif
        </div>
    @endif
</div>

<style>
    /* Pricing Card Styles with AMIYI-specific class names */
    .amiyi-pricing-card {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        margin-bottom: 30px;
        overflow: hidden;
        height: 100%;
        transition: all 0.4s ease;
        border: 1px solid #f0f0f0;
        position: relative;
    }

    .amiyi-pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border-color: #e0e0e0;
    }

    /* Header Styles */
    .amiyi-card-header {
        background: #1e2530;
        /* Original dark background */
        color: #fff;
        text-align: center;
        padding: 30px 20px;
        position: relative;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);
        /* Shaped bottom edge */
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .amiyi-plan-title {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        letter-spacing: 1px;
        text-transform: uppercase;
        position: relative;
        z-index: 1;
    }

    .amiyi-icon-wrapper {
        background-color: rgba(245, 166, 35, 0.2);
        /* Orange with opacity */
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        position: relative;
        z-index: 1;
        border: 2px solid rgba(245, 166, 35, 0.3);
    }

    .amiyi-icon {
        color: #f5a623;
        /* Original orange color */
        filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.2));
    }

    /* Price Section */
    .amiyi-price-section {
        padding: 30px 20px 20px;
        text-align: center;
        position: relative;
        background: #f8f9fa;
    }

    .amiyi-price {
        font-size: 42px;
        font-weight: 800;
        color: #333;
        margin: 0 0 10px;
        line-height: 1;
    }

    .amiyi-currency {
        font-size: 18px;
        color: #666;
        margin-left: 5px;
        font-weight: 500;
    }

    .amiyi-duration {
        background: #f5a623;
        /* Original orange color */
        color: white;
        font-size: 14px;
        font-weight: 600;
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
        margin-top: 5px;
        box-shadow: 0 4px 10px rgba(245, 166, 35, 0.2);
    }

    /* Features List */
    .amiyi-features-list {
        padding: 20px 0 10px;
        background: white;
    }

    .amiyi-feature {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        transition: all 0.2s;
        border-bottom: 1px solid #f0f0f0;
    }

    .amiyi-feature:last-child {
        border-bottom: none;
    }

    .amiyi-feature:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .amiyi-feature-icon {
        color: #f5a623;
        /* Original orange color */
        margin-right: 15px;
        min-width: 16px;
    }

    .amiyi-feature-text {
        font-size: 15px;
        color: #444;
    }

    /* Button */
    .amiyi-card-footer {
        margin-top: auto;
        padding: 20px;
        background: white;
    }

    .amiyi-subscribe-button {
        background: #f5a623;
        /* Original orange color */
        color: white;
        border: none;
        width: 100%;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        display: block;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.2);
        position: relative;
        overflow: hidden;
    }

    .amiyi-subscribe-button:hover {
        background: #e69819;
        /* Darker orange on hover */
        box-shadow: 0 6px 20px rgba(245, 166, 35, 0.4);
        transform: translateY(-2px);
    }

    .amiyi-subscribe-button:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .amiyi-subscribe-button:hover:before {
        left: 100%;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .amiyi-card-header {
            min-height: 140px;
        }

        .amiyi-price {
            font-size: 36px;
        }

        .amiyi-icon-wrapper {
            width: 50px;
            height: 50px;
        }
    }
</style>
