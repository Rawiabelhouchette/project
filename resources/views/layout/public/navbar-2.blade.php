@props(['active' => null])

<style>
    .header-menu-zone>li {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }

    /* --- */
    #btn-deposer-annonce {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 10px 20px !important;
        font-size: 16px !important;
        font-family: Arial, sans-serif !important;
        font-weight: 500 !important;
        border: none !important;
        border-radius: 20px !important;
        /* Bords arrondis */
        cursor: pointer !important;
        text-decoration: none !important;
        /*  */
        margin-top: 6px !important;
    }

    #btn-deposer-annonce:hover {
        color: #FF3A72 !important;
    }

    #btn-deposer-annonce::before {
        content: "+" !important;
        display: inline-block !important;
        margin-right: 8px !important;
        /* Espacement avec le texte */
        font-size: 20px !important;
    }

    /*  */
    @media only screen and (min-width : 993px) {
        body nav.navbar.bootsnav ul.nav>li>a.add-annonce {
            color: #fff !important;
            background-color: #005870 !important;
        }

        body.home-2 nav.navbar.bootsnav.navbar-transparent ul.nav>li>a.add-annonce {
            background-color: #fff !important;
            color: #005870 !important;
        }
    }

    /* small screen */
    @media only screen and (max-width : 992px) {
        .btn-deposer-annonce-li {
            float: left !important;
            margin-right: 0px !important;
        }
    }
</style>

<nav class="navbar navbar-default navbar-fixed white bootsnav">
    <div class="container-fluid">
        <button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu" type="button">
            <i class="ti-align-left"></i>
        </button>

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                @if ($active == 'login')
                    <img class="logo logo-display" src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" alt="">
                @else
                    <img class="logo logo-display" src="{{ asset('assets/img/logo-vamiyi-by-numrod-white.png') }}" alt="">
                @endif
                <img class="logo logo-scrolled" src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" alt="">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav header-menu-zone" data-in="fadeInDown" data-out="fadeOutUp">

                @yield('navbar-2')

                {{-- @if (auth()->check() && auth()->user()->hasRole('Professionnel') && auth()->user()->hasRole('Administrateur')) --}}
                <li>
                    <a href="{{ route('public.my-business') }}">
                        Mon entreprise
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.annonces.list') }}">
                        Mes annonces
                    </a>
                </li>
                {{-- @endif --}}

                {{-- <li>
                    <a href="{{ route('contact') }}">
                        Contact
                    </a>
                </li> --}}
            </ul>

            <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp" style="float: right;">
                <li class="btn-deposer-annonce-li" style="padding-right: 0px !important">
                    @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                        <a class="add-annonce" id="btn-deposer-annonce" href="{{ route('public.annonces.create') }}">
                            Déposer une annonce
                        </a>
                    @elseif (auth()->check() && auth()->user()->hasRole('Usager'))
                        <a class="add-annonce" id="btn-deposer-annonce" href="{{ route('pricing') }}">
                            Déposer une annonce
                        </a>
                    @else
                        <a class="add-annonce" id="btn-deposer-annonce" data-toggle="modal" data-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
                            Déposer une annonce
                        </a>
                    @endif
                </li>
                <style>
                    .add-annonce-2 {
                        padding-top: 7px !important;
                        padding-bottom: 0px !important;
                        padding-left: 0 !important;
                        padding-right: 0 !important;
                    }

                    .add-annonce-2>svg {
                        fill: #005870 !important;
                    }
                </style>

                @if (auth()->check())
                    <li class="btn-deposer-annonce-li no-pd dropdown">
                        <a class="add-annonce-2" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="38" height="38"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M406.5 399.6C387.4 352.9 341.5 320 288 320l-64 0c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3l64 0c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z" />
                            </svg>

                            {{-- <img src="{{ asset('assets_client/img/default-user.svg') }}" alt="Déposer une annonce" style="width: 35px; height: 35px;"> --}}
                        </a>

                        <style>
                            .dropdown-menu-zone {
                                left: -155px;
                            }
                        </style>

                        <ul class="dropdown-menu animated navbar-left dropdown-menu-zone fadeOutUp" style="display: none; opacity: 1;">
                            <li>
                                <a href="{{ route('public.my-account') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    Mon compte
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.my-favorites') }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i> &nbsp;
                                    Mes favoris
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.my-comments') }}">
                                    <i class="fa fa-comment" aria-hidden="true"></i> &nbsp;
                                    Mes commentaires
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;
                                    Me déconnecter
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="btn-deposer-annonce-li no-pd">
                        <a class="add-annonce-2" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="38" height="38"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M406.5 399.6C387.4 352.9 341.5 320 288 320l-64 0c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3l64 0c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z" />
                            </svg>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
