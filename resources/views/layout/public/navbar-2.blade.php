@props(['login' => true])

<style>
    body.home-2 nav.navbar {
        background-color: #ffffff;
        border-bottom: none;
        -webkit-box-shadow: 0 2px 4px 0 rgba(188, 195, 208, 0.5);
        -moz-box-shadow: 0 2px 4px 0 rgba(188, 195, 208, 0.5);
        box-shadow: 0 2px 4px 0 rgba(188, 195, 208, 0.5);
        z-index: 999;
        padding: 1rem 3rem;
    }

    nav:not(.navbar-transparent) .logo-scrolled,
    nav.navbar-transparent .logo-display {
        display: block;
        width: 70px;
        height: 70px;
        max-height: 80px;
        margin-top: -10px;
    }
</style>

<div class="header">
    <nav class="navbar navbar-expand-lg bg-light fixed-top bootsnav navbar-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                {{-- @if ($active == 'login')
                    <img class="logo logo-display d-inline-block align-text-top" src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">
                @else --}}
                <img class="logo logo-display d-inline-block align-text-top" src="{{ asset('assets/img/logo-vamiyi-vacances-white.svg') }}" alt="">
                {{-- @endif --}}
                <img class="logo logo-scrolled d-inline-block align-text-top" src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">
                <span>Vamiyi</span>
            </a>
            <button class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#navbar-list" type="button" aria-controls="navbar-list" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-list">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search', ['se_loger' => 1]) }}">Se loger</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search', ['se_restaurer' => 1]) }}">Se restaurer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search', ['sortir' => 1]) }}">Sortir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search', ['louer_voiture' => 1]) }}">Louer une voiture</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="user-account">
            <ul>
                <li class="">
                    @if (request()->is('login'))
                        <a class="btn theme-btn" href="{{ route('register') }}">
                            <i class="ti-user" aria-hidden="true"></i> <span>Inscription</span>
                        </a>
                    @else
                        <a class="btn theme-btn" href="{{ route('login') }}">
                            <i class="ti-user" aria-hidden="true"></i> <span>Connexion</span>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
</div>
