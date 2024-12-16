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

<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
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
                <li>
                    <a href="{{ route('search') }}">
                        Se loger
                    </a>
                </li>
                <li>
                    <a href="{{ route('search') }}">
                        Se restaurer
                    </a>
                </li>
                <li>
                    <a href="{{ route('search') }}">
                        Sortir
                    </a>
                </li>
                <li>
                    <a href="{{ route('search') }}">
                        Louer une voiture
                    </a>
                </li>
                @if (auth()->check() && auth()->user()->hasRole('Professionnel'))
                    <li>
                        <a href="{{ route('search') }}">
                            Mon entreprise
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('search') }}">
                            Mes annonces
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp" style="float: right; margin-right: 167px !important">
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
            </ul>

            {{-- if user is not connected or hasrole Administrateur --}}
            @if (!auth()->check())
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pd">
                        <a class="addlist" data-toggle="modal" data-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
                            <i class="ti-user" aria-hidden="true"></i>
                            Se connecter
                        </a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pd dropdown">
                        <a class="addlist" href="{{ route('home') }}">
                            <img class="img-responsive img-circle avater-img" src="{{ asset('assets_client/img/default-user.svg') }}" alt="" width="50px" height="50px">
                            <strong id="navbar_username">
                                {{-- {{ auth()->user()->nom }} {{ auth()->user()->prenom }} --}}
                                Connecté
                            </strong>
                        </a>
                        <ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
                            <li>
                                <a href="{{ route('accounts.index') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    Mon compte
                                </a>
                            </li>
                            {{-- favoris --}}
                            <li>
                                <a href="{{ route('accounts.favorite.index') }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i> &nbsp;
                                    Mes favoris
                                </a>
                            </li>
                            {{-- Mes commentaires --}}
                            <li>
                                <a href="{{ route('accounts.comment.index') }}">
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
                </ul>
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
