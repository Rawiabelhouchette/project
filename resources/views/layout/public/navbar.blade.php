@props(['active' => null])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

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

    /* Smartphones (portrait) */
    @media (max-width: 480px) {
        .header {
            display: none
        }

        #header-mobile {
            display: block !important
        }
    }

    /* Smartphones (landscape) */
    @media (min-width: 481px) and (max-width: 767px) {
        .header {
            display: none
        }

        #header-mobile {
            display: block !important
        }
    }

    /* Tablets (portrait and landscape) */
    @media (min-width: 768px) and (max-width: 1024px) {
        .header {
            display: none
        }

        #header-mobile {
            display: block !important
        }
    }


    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }

    .nav-tabs .nav-link {
        color: #333;
        font-weight: bold;
        border: none;
        padding: 0.5rem 0;
        margin-right: 2rem;
        position: relative;
    }

    .nav-tabs .nav-link.active {
        color: #000;
        font-weight: bold;
        border: none;
        background: none;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #000;
    }

    .search-container {
        background-color: #f5f5f7;
        border-radius: 25px;
    }

    .search-input {
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        padding: 10px 15px;
    }

    .search-input:focus {
        outline: none;
    }

    .category-item {
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .jardin-bg {
        background-color: #d1f5f0;
    }

    .chambre-bg {
        background-color: #ffd6d1;
    }

    .category-white {
        background-color: #f5f5f7;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .sidebar-mobile {
        position: fixed;
        top: 0;
        left: 0;
        width: 80%;
        /* Not full width as per design */
        height: 100%;
        background: white;
        z-index: 1050;
        overflow-y: auto;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-mobile .show {
        transform: translateX(0);
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
    }

    .overlay.show {
        display: block;
    }

    .search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        z-index: 1050;
        overflow-y: auto;
        transform: translateY(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .search-overlay.show {
        transform: translateY(0);
    }

    .search-result {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .close-btn {
        background-color: #f0f0f0;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
    }

    .category-icon {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .tab-icon {
        font-size: 1.2rem;
        margin-right: 8px;
    }

    #header-mobile {
        display: none
    }

    .list-none {
        list-style: none;
    }
</style>
<!-- Main Header -->

<div class="header">

    <nav class="navbar navbar-expand-lg bg-light fixed-top bootsnav navbar-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                @if ($active == 'login')
                    <img class="logo logo-display d-inline-block align-text-top"
                        src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">
                @else
                    <img class="logo logo-display d-inline-block align-text-top"
                        src="{{ asset('assets/img/logo-vamiyi-vacances-white.svg') }}" alt="">
                @endif
                <img class="logo logo-scrolled d-inline-block align-text-top"
                    src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">
                <span>Vamiyi</span>
            </a>
            <button class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#navbar-list"
                type="button" aria-controls="navbar-list" aria-expanded="false" aria-label="Toggle navigation">
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

                    <form>
                        @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                            <a class="btn add-annonce" id="btn-deposer-annonce"
                                href="{{ route('public.annonces.create') }}">
                                <i class="fa-solid fa-plus"></i>Déposer une annonce
                            </a>
                        @elseif (auth()->check() && auth()->user()->hasRole('Usager'))
                            <a class="btn add-annonce" id="btn-deposer-annonce" href="{{ route('pricing') }}">
                                <i class="fa-solid fa-plus"></i>Déposer une annonce
                            </a>
                        @else
                            <a class="btn add-annonce" id="btn-deposer-annonce" data-bs-toggle="modal"
                                data-bs-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
                                <i class="fa-solid fa-plus"></i>Déposer une annonce
                            </a>
                        @endif
                    </form>

                </ul>
            </div>
        </div>
        <div class="user-account">
            <ul>
                {{-- if user is not connected or hasrole Administrateur --}}
                @if (!auth()->check())
                    <li class="">
                        <a class="btn theme-btn" data-bs-toggle="modal" data-bs-target="#signin"
                            href="javascript:void(0)" onclick="$('#share').hide()">
                            <i class="ti-user" aria-hidden="true"></i> <span>Connexion</span>
                        </a>
                    </li>
                @else
                    <li class="dropdown">
                        <a class="btn theme-btn dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            {{-- {{ auth()->user()->nom }} {{ auth()->user()->prenom }} --}}
                            <i class="fa fa-user" aria-hidden="true"></i> <span>Connecté</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('public.my-account') }}">Mon compte</a></li>
                            @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                                <li><a class="dropdown-item" href="{{ route('public.my-business') }}">Mon
                                        entreprise</a></li>
                                <li><a class="dropdown-item" href="{{ route('public.annonces.list') }}">Mes
                                        annonces</a></li>
                                <li><a class="dropdown-item" href="{{ route('public.my-subscription') }}">Mes
                                        abonnements</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('public.my-favorites') }}">Mes favoris</a></li>
                            <li><a class="dropdown-item" href="{{ route('public.my-comments') }}">Mes commentaires</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                                <li><a class="dropdown-item" href="{{ route('home') }}">Espace administrateur</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('contact') }}">Contact</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"
                                        aria-hidden="true"></i> <span>Me déconnecter</span></a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>

<!-- Mobile Header -->
<div id="header-mobile">
    <header class="container-fluid py-3">
        <div class="row align-items-center">
            <div class="col-2">
                <button class="btn p-0 border-0" id="menuToggle">
                    <i class="bi bi-list fs-4" style="font-size:32px !important"></i>
                </button>
            </div>
            <div class="col-8 text-center">
                <div class="logo">
                    <img onlick="window.location.href='/'"
                        style="width: 70px;
    height: 70px;
    max-height: 80px;"
                        class="logo logo-scrolled d-inline-block align-text-top"
                        src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">

                </div>
            </div>
            <div class="col-2 d-flex justify-content-end">

                <a>
                    <i>
                        @if (!auth()->check())
                            <li class="list-none">
                                <a class="btn theme-btn" data-bs-toggle="modal" data-bs-target="#signin"
                                    href="javascript:void(0)" onclick="$('#share').hide()">
                                    <i class="ti-user" aria-hidden="true"></i> <span>Connexion</span>
                                </a>
                            </li>
                        @else
                            <li class="dropdown list-none">
                                <a class="btn theme-btn dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false">
                                    {{-- {{ auth()->user()->nom }} {{ auth()->user()->prenom }} --}}
                                    <i class="fa fa-user" aria-hidden="true"></i> <span>Connecté</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('public.my-account') }}">Mon
                                            compte</a></li>
                                    @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                                        <li><a class="dropdown-item" href="{{ route('public.my-business') }}">Mon
                                                entreprise</a></li>
                                        <li><a class="dropdown-item" href="{{ route('public.annonces.list') }}">Mes
                                                annonces</a></li>
                                        <li><a class="dropdown-item" href="{{ route('public.my-subscription') }}">Mes
                                                abonnements</a></li>
                                    @endif
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('public.my-favorites') }}">Mes
                                            favoris</a></li>
                                    <li><a class="dropdown-item" href="{{ route('public.my-comments') }}">Mes
                                            commentaires</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                                        <li><a class="dropdown-item" href="{{ route('home') }}">Espace
                                                administrateur</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('contact') }}">Contact</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                                class="fa fa-power-off" aria-hidden="true"></i> <span>Me
                                                déconnecter</span></a></li>
                                </ul>
                            </li>
                        @endif
                    </i>
                </a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="search-container d-flex align-items-center" id="searchToggle">
                    <i class="bi bi-search ms-3"></i>
                    <input type="text" class="search-input" placeholder="Que recherchez-vous ?">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">

                <hr class="mt-2 mb-3">
            </div>
        </div>
    </header>

    <!-- Background Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar Menu -->
    <div class="sidebar-mobile" id="sidebar-mobile">
        <div class="p-4">
            <div class="d-flex justify-content-between mb-4">
                <img style="width: 70px;
    height: 70px;
    max-height: 80px;"
                    class="logo logo-scrolled d-inline-block align-text-top"
                    src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">

                <button class="close-btn" id="closeSidebar">
                    <i class="bi bi-x fs-4"></i>
                </button>
            </div>


            <div class="category-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                    <a class="nav-link" href="{{ route('search', ['se_loger' => 1]) }}">Se loger</a>
                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            <div class="category-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a class="nav-link" href="{{ route('search', ['se_restaurer' => 1]) }}">Se restaurer</a>
                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            <div class="category-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a class="nav-link" href="{{ route('search', ['sortir' => 1]) }}">Sortir</a>
                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            <div class="category-white d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a class="nav-link" href="{{ route('search', ['louer_voiture' => 1]) }}">Louer une voiture</a>

                </div>
                <i class="bi bi-chevron-right"></i>
            </div>
            <form class="mt-4">
                @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                    <a class="btn add-annonce" id="btn-deposer-annonce"
                        href="{{ route('public.annonces.create') }}">
                        <i class="fa-solid fa-plus"></i>Déposer une annonce
                    </a>
                @elseif (auth()->check() && auth()->user()->hasRole('Usager'))
                    <a class="btn add-annonce" id="btn-deposer-annonce" href="{{ route('pricing') }}">
                        <i class="fa-solid fa-plus"></i>Déposer une annonce
                    </a>
                @else
                    <a class="btn add-annonce" id="btn-deposer-annonce" data-bs-toggle="modal"
                        data-bs-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
                        <i class="fa-solid fa-plus"></i>Déposer une annonce
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="search-overlay" id="searchOverlay">
        <div class="p-3">
            <div class="d-flex align-items-center mb-4">
                <button class="btn p-0 border-0 me-2">
                    <i class="bi bi-arrow-left fs-4"></i>
                </button>
                <div class="search-container d-flex align-items-center flex-grow-1">
                    <input type="text" class="search-input" value="car">
                </div>
                <button class="btn p-0 border-0 ms-2" id="closeSearch">
                    <i class="bi bi-x-circle fs-5"></i>
                </button>
            </div>

            <h5 class="mb-3">Mot(s) clé(s) suggéré(s)</h5>

            <div class="search-results">
                <div class="search-result">Caracos femme</div>
                <div class="search-result">Cartables</div>
                <div class="search-result">Cardigan femme</div>
                <div class="search-result">Caracos</div>
                <div class="search-result">Carafe</div>
                <div class="search-result">Cartable a roulette</div>
                <div class="search-result">Cardigan</div>
                <div class="search-result">Carreau</div>
                <div class="search-result">Caradou</div>
                <div class="search-result">Caradou 90x190</div>
            </div>
        </div>
    </div>
    <script>
        // Toggle sidebar
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar-mobile').classList.add('show');
            document.getElementById('overlay').classList.add('show');
        });

        document.getElementById('closeSidebar').addEventListener('click', function() {
            document.getElementById('sidebar-mobile').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar-mobile').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
        });

        // Toggle search overlay
        document.getElementById('searchToggle').addEventListener('click', function() {
            document.getElementById('searchOverlay').classList.add('show');
        });

        document.getElementById('closeSearch').addEventListener('click', function() {
            document.getElementById('searchOverlay').classList.remove('show');
        });
    </script>
</div>
