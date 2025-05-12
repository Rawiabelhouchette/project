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

        border-radius: 25px;
    }

    body.home-2 a.btn i {
        margin: 0 !important
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
        right: 0;
        width: 80%;
        /* Not full width as per design */
        height: 100%;
        background: white;
        z-index: 1050;
        overflow-y: auto;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-mobile.show {
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
    /* Custom styles for the dropdown menu */
.dropdown-menu {
  width: 360px;
  border-radius: 0.5rem;
}

.dropdown-item {
  transition: background-color 0.2s;
  border-radius: 0.25rem;
  margin: 0 0.5rem;
  width: auto;
}

.dropdown-item:hover {
  background-color: rgba(0, 128, 128, 0.1);
}

.text-teal-700 {
  color: #0f766e;
}



.mobile-user-header {
  text-align: center;
  padding: 0.75rem 1rem;
  border-bottom: 1px solid #dee2e6;
}


.logout-item {
  color: #dc3545;
}

.logout-item:hover {
  background-color: rgba(220, 53, 69, 0.1);
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

            <div class="collapse navbar-collapse" id="navbar-list">
                <ul class="navbar-nav" style="white-space: nowrap;">
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
                <!-- Desktop User Menu -->
                <li class="dropdown list-none">
                    @if (!auth()->check())
                        <a class="btn user-menu-btn theme-btn" data-bs-toggle="modal" data-bs-target="#signin"
                            href="javascript:void(0)" onclick="$('#share').hide()">
                            <span class="user-icon"><i class="fa fa-user-circle"></i></span>
                            <span class="d-none d-md-inline">Se connecter</span>
                        </a>
                    @else
                        <a class="btn user-menu-btn dropdown-toggle" data-bs-toggle="dropdown" href="#"
                            role="button" aria-expanded="false" style="background: #de6600;border: none;color: white;">
                            <span class="user-icon"><i class="fa fa-user-circle"></i></span>
                            <span class="d-none d-md-inline">Connecté</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                            <!-- Mobile only header -->
                            <div class="mobile-user-header d-md-none">
                                <h6>Menu utilisateur</h6>
                                <button type="button" class="mobile-close-btn" data-bs-dismiss="dropdown" aria-label="Close">
                                    <i class="fa fa-times text-teal-700 me-2"></i>
                                </button>
                            </div>
                            
                            <!-- Account section -->
                            <div class="dropdown-section-header d-none d-md-block">Compte</div>
                            <li><a class="dropdown-item" href="{{ route('public.my-account') }}">
                                <i class="text-teal-700 me-2 fa fa-user"></i> Mon compte
                            </a></li>
                            
                            @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                                <!-- Professional section -->
                                <li><a class="dropdown-item" href="{{ route('public.my-business') }}">
                                    <i class="text-teal-700 me-2 fa fa-building"></i> Mon entreprise
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('public.annonces.list') }}">
                                    <i class="text-teal-700 me-2 fa fa-bullhorn"></i> Mes annonces
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('public.my-subscription') }}">
                                    <i class="text-teal-700 me-2 fa fa-credit-card"></i> Mes abonnements
                                </a></li>
                            @endif
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <!-- Activity section -->
                            <div class="dropdown-section-header d-none d-md-block">Activité</div>
                            <li><a class="dropdown-item" href="{{ route('public.my-favorites') }}">
                                <i class="text-teal-700 me-2 fa fa-heart"></i> Mes favoris
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('public.my-comments') }}">
                                <i class="text-teal-700 me-2 fa fa-comments"></i> Mes commentaires
                            </a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <!-- Other section -->
                            @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                                <li><a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="text-teal-700 me-2 fa fa-cog"></i> Espace administrateur
                                </a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('contact') }}">
                                <i class="text-teal-700 me-2 fa fa-envelope"></i> Contact
                            </a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <!-- Logout -->
                            <li ><a class="dropdown-item logout-item text-danger" href="{{ route('logout') }}">
                                <i class="text-danger me-2 fa fa-power-off" style="padding: 6px;border-radius: 50px;color: white;"></i> Me déconnecter
                            </a></li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
</div>

<!-- Mobile Header -->
<div id="header-mobile">
    <header class="container-fluid py-3">
        <div class="row align-items-center">
            <div class="col-6 d-flex align-items-center">

                <div class="logo ms-2">
                    <img onclick="window.location.href='/'"
                        style="width: 70px;
                                height: 70px;
                                max-height: 80px;"
                        class="logo logo-scrolled d-inline-block align-text-top"
                        src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">

                </div>
            </div>
            <div class="col-3"></div>
            <div class="col-3 d-flex justify-content-end" style="gap: 5px;">
                        <div class="d-flex align-items-center justify-content-center">
               
             
                <form style="width: auto;">
                    @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                        <a class="btn add-annonce" id="btn-deposer-annonce" style="padding: 10px 15px; "
                            href="{{ route('public.annonces.create') }}">
                            <i class="fa-solid fa-plus"></i>Annonce
                        </a>
                    @elseif (auth()->check() && auth()->user()->hasRole('Usager'))
                        <a class="btn add-annonce" style="padding: 10px 15px;" id="btn-deposer-annonce"
                            href="{{ route('pricing') }}">
                            <i class="fa-solid fa-plus"></i>Annonce
                        </a>
                    @else
                        <a class="btn add-annonce" style="padding: 10px 15px;" id="btn-deposer-annonce"
                            data-bs-toggle="modal" data-bs-target="#signin" href="javascript:void(0)"
                            onclick="$('#share').hide()">
                            <i class="fa-solid fa-plus"></i>Annonce
                        </a>
                    @endif
                </form>   
        </div>


                <div>

                    @if (!auth()->check())
                        <li class="list-none">
                            <a data-bs-toggle="modal" data-bs-target="#signin"
                                href="javascript:void(0)" onclick="$('#share').hide()">
                                <i class="fa fa-user-circle btn theme-btn" style="padding: 10px;font-size: 20px;" aria-hidden="true"></i><span></span>
                            </a>

                        </li>
                    @else
                        <li class="dropdown list-none">
                            <a data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false">
                                <i class="fa fa-user-circle btn theme-btn" style="padding: 10px;font-size: 20px;" aria-hidden="true"></i> <span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-0">
                                <!-- Menu Header -->
                                <li class="py-3 text-center border-bottom">
                                    <h4 class="mb-0 fw-semibold text-secondary">Menu utilisateur</h4>
                                </li>
                                
                                <!-- Account section -->
                                <li class="d-none d-md-block px-3 py-2 small text-muted fw-medium">Compte</li>
                                <li>
                                    <a class="dropdown-item py-4 px-3" href="{{ route('public.my-account') }}">
                                        <i class="bi bi-person text-teal-700 me-2"></i> Mon compte
                                    </a>
                                </li>
                                
                                @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                                    <!-- Professional section -->
                                    <li>
                                        <a class="dropdown-item py-4 px-3" href="{{ route('public.my-business') }}">
                                            <i class="bi bi-building text-teal-700 me-2"></i> Mon entreprise
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-4 px-3" href="{{ route('public.annonces.list') }}">
                                            <i class="bi bi-megaphone text-teal-700 me-2"></i> Mes annonces
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-4 px-3" href="{{ route('public.my-subscription') }}">
                                            <i class="bi bi-credit-card text-teal-700 me-2"></i> Mes abonnements
                                        </a>
                                    </li>
                                @endif
                                
                                <li><hr class="dropdown-divider my-1"></li>
                                
                                <!-- Activity section -->
                                <li class="d-none d-md-block px-3 py-2 small text-muted fw-medium">Activité</li>
                                <li>
                                    <a class="dropdown-item py-4 px-3" href="{{ route('public.my-favorites') }}">
                                        <i class="bi bi-heart text-teal-700 me-2"></i> Mes favoris
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-4 px-3" href="{{ route('public.my-comments') }}">
                                        <i class="bi bi-chat-square-text text-teal-700 me-2"></i> Mes commentaires
                                    </a>
                                </li>
                                
                                <li><hr class="dropdown-divider my-1"></li>
                                
                                <!-- Other section -->
                                @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                                    <li>
                                        <a class="dropdown-item py-4 px-3" href="{{ route('home') }}">
                                            <i class="bi bi-gear text-teal-700 me-2"></i> Espace administrateur
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item py-4 px-3" href="{{ route('contact') }}">
                                        <i class="bi bi-envelope text-teal-700 me-2"></i> Contact
                                    </a>
                                </li>
                                
                                <li><hr class="dropdown-divider my-1"></li>
                                
                                <!-- Logout -->
                                <li>
                                    <a class="dropdown-item py-4 px-3 text-danger" href="{{ route('logout') }}">
                                        <i class="bi bi-power text-danger me-2"></i> Me déconnecter
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </div>

                 <button class="btn p-0 border-0 ms-1" id="menuToggle">
                    <i class="bi bi-list fs-4" style="font-size:32px !important"></i>
                </button>
            </div>


        </div>

    </header>

    <!-- Background Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar Menu -->
    <div class="sidebar-mobile" id="sidebar">
        <div class="p-4">
            <div class="d-flex justify-content-between mb-4">
                <img onclick="window.location.href='/'" style="width: 70px;
    height: 70px;
    max-height: 80px;"
                    class="logo logo-scrolled d-inline-block align-text-top"
                    src="{{ asset('assets/img/logo-vamiyi-vacances-togo.svg') }}" alt="">

                <button class="close-btn" id="closeSidebar">
                    <i class="bi bi-x fs-4"></i>
                </button>
            </div>


            <div class="category-white d-flex justify-content-between align-items-center"
                onclick="window.location.href='{{ route('search', ['se_loger' => 1]) }}'">
                <div class="d-flex align-items-center">

                    <a class="nav-link">Se loger</a>
                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            <div class="category-white d-flex justify-content-between align-items-center"
                onclick="window.location.href='{{ route('search', ['se_restaurer' => 1]) }}'">
                <div class="d-flex align-items-center">
                    <a class="nav-link">Se restaurer</a>
                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            <div class="category-white d-flex justify-content-between align-items-center"
                onclick="window.location.href='{{ route('search', ['sortir' => 1]) }}'">
                <div class="d-flex align-items-center">
                    <a class="nav-link">Sortir</a>
                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            <div class="category-white d-flex justify-content-between align-items-center"
                onclick="window.location.href='{{ route('search', ['louer_voiture' => 1]) }}'">
                <div class="d-flex align-items-center">
                    <a class="nav-link">Louer une voiture</a>

                </div>
                <i class="bi bi-chevron-right"></i>
            </div>

            

        </div>
    </div>


    <script>
        // Toggle sidebar
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
            document.getElementById('overlay').classList.add('show');
        });

        document.getElementById('closeSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
        });
    </script>
</div>

