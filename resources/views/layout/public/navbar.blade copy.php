@props(['active' => null])

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

        <style>
            #navbar-menu > ul > li {
                padding-left: 5px !important;
                padding-right: 5px !important;
            }
        </style>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            {{-- <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp"> --}}
            <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp">
                <li>
                    <a href="#">
                        Se loger
                    </a>
                </li>
                <li>
                    <a href="#">
                        Se restaurer
                    </a>
                </li>
                <li>
                    <a href="#">
                        Sortir
                    </a>
                </li>
                <li>
                    <a href="#">
                        Louer une voiture
                    </a>
                </li>
                <li>
                    <a href="#">
                        Mon entreprise
                    </a>
                </li>
                <li>
                    <a href="#">
                        Mes annonces
                    </a>
                </li>
                <li>
                    <a href="#">
                        Contact
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('accueil') }}">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">
                        Contactez-nous
                    </a>
                </li>
                @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                    <li>
                        <a href="{{ route('home') }}" target="_blank">
                            Accès professionnel
                        </a>
                    </li>
                @endif
                @if (auth()->check() && auth()->user()->hasRole('Usager'))
                    <li>
                        <a href="{{ route('pricing') }}">
                            Déposer une annonce
                        </a>
                    </li>
                @endif --}}
            </ul>
            {{-- <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                <li class="">
                    <a class="" href="{{ route('pricing') }}" onclick="$('#share').hide()">
                        <i class="ti-plus" aria-hidden="true"></i>Déposer une annonce
                    </a>
                </li>
            </ul> --}}

            <style>
                #btn-deposer-annonce {
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    padding: 10px 20px !important;
                    background-color: #005870 !important;
                    /* Couleur de fond */
                    color: #fff !important;
                    /* Couleur du texte */
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
                    background-color: #003f50 !important;
                    /* Couleur de fond au survol */
                }

                #btn-deposer-annonce::before {
                    content: "+" !important;
                    display: inline-block !important;
                    margin-right: 8px !important;
                    /* Espacement avec le texte */
                    font-size: 20px !important;
                }

                /*  ================  */
                /* un bg circulaire entourant l'icon */
                #btn-deposer-annonce-2 {
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    background-color: #ff3a72 !important;
                    padding: 10px 10px !important;
                    margin-top: 6px !important;
                    border-radius: 50% !important;
                    margin-left: 10px !important;
                }
            </style>

            <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp" style="float: right;">
                <li style="padding-right: 0px !important">
                    <a class="addlist" id="btn-deposer-annonce" href="#">
                        Déposer une annonce
                    </a>
                    {{-- <a id="btn-deposer-annonce-2" href="#">
                        <i class="ti-user" aria-hidden="true" style="margin-right: 0 !important; color: white !important;"></i>
                    </a> --}}
                    {{-- <a class="addlist" data-toggle="modal" data-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()" style="display: inline-flex !important;">
                        <i class="ti-user" aria-hidden="true"></i>Connexion
                    </a> --}}
                </li>
                <li class="no-pad">
                    <a class="addlist" data-toggle="modal" data-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()" style="display: inline-flex !important;">
                        <i class="ti-user" aria-hidden="true"></i>Connexion
                    </a>
                </li>
            </ul>

            {{-- if user is not connected or hasrole Administrateur --}}
            @if (!auth()->check())
                {{-- <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pad">
                        <a class="addlist" data-toggle="modal" data-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
                            <i class="ti-user" aria-hidden="true"></i>Connexion
                        </a>
                    </li>
                </ul> --}}
            @else
                {{-- <ul class="navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                  
                    <li class="no-pd dropdown">
                        <a class="addlist" href="javascript:void(0)" onclick="$('#share').hide()">
                            <i class="ti-user" aria-hidden="true" style="margin-right: 0px !important;"></i>
                        </a>
                        <ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    Mon compte
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                {{-- <li class="no-pd dropdown">
                        <a class="addlist" href="{{ route('home') }}">
                            <img class="img-responsive img-circle avater-img" src="{{ asset('assets_client/img/default-user.svg') }}" alt="" width="50px" height="50px">
                            <strong id="navbar_username">
                                {{ auth()->user()->nom }} {{ auth()->user()->prenom }}
                            </strong>
                        </a>
                        <ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    Mon compte
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                {{-- </ul> --}}
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
