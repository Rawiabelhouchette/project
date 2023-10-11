<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="ti-align-left"></i>
        </button>

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('custom/img/logo9.png') }}" class="logo logo-display" alt="">
                <img src="{{ asset('custom/img/logo9.png') }}" class="logo logo-scrolled" alt="">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                <li>
                    <a href="{{ route('welcome') }}">Accueil</a>
                </li>
                @if (auth()->check())
                    <li>
                        <a href="{{ route('messages.index') }}">Contact</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('messages.create') }}">Contact</a>
                    </li>
                @endif
                @if (auth()->check() && auth()->user()->is_admin)
                    <li>
                        <a href="{{ route('home') }}" target="_blank">Accès professionnel</a>
                    </li>
                @endif

            </ul>

            @if (!auth()->check())
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pd">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#signin" class="addlist">
                            <i class="ti-user" aria-hidden="true"></i>Connexion
                        </a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pd dropdown">
                        <a href="javascript:void(0)" class="addlist">
                            <img src="{{ asset('assets_client/img/avatar.jpg') }}" class="img-responsive img-circle avater-img" alt="">
                            <strong>{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</strong>
                        </a>
                        <ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
                            <li>
                                <a href="{{ route('profil.index') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    Mon compte
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('messages.index') }}">
                                    <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;
                                    Contact
                                </a>
                            <li>
                                <a href="{{ route('favoris.index') }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i> &nbsp;
                                    Favoris
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;
                                    Déconnexion
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
