@props(['active' => null])
<div class="header">
    <nav class="navbar navbar-expand-lg bg-light fixed-top bootsnav navbar-transparent">
        <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('accueil') }}">
                    @if ($active == 'login')
                        <img class="logo logo-display" src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" alt="">
                    @else
                        <img class="logo logo-display" src="{{ asset('assets/img/logo-vamiyi-by-numrod-white.png') }}" alt="">
                    @endif
                    <img class="logo logo-scrolled" src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" alt="">
                </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-list" aria-controls="navbar-list" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-list">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('search') }}">Se loger</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('search') }}">Se restaurer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('search') }}">Sortir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('search') }}">Louer une voiture</a>
            </li>
             
            <form> 
                @if (auth()->check() && (auth()->user()->hasRole('Professionnel') || auth()->user()->hasRole('Administrateur')))
                    <a class="btn btn-sm add-annonce" id="btn-deposer-annonce" href="{{ route('public.annonces.create') }}">
                        <i class="fa-solid fa-plus"></i>Déposer une annonce
                    </a>
                @elseif (auth()->check() && auth()->user()->hasRole('Usager'))
                    <a class="btn btn-sm add-annonce" id="btn-deposer-annonce" href="{{ route('pricing') }}">
                        <i class="fa-solid fa-plus"></i>Déposer une annonce
                    </a>
                @else
                    <a class="btn btn-sm add-annonce" id="btn-deposer-annonce" data-toggle="modal" data-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
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
                    <a class="btn theme-btn" data-bs-toggle="modal" data-bs-target="#signin" href="javascript:void(0)" onclick="$('#share').hide()">
                        <i class="ti-user" aria-hidden="true"></i> <span>Connexion</span>
                    </a>
                </li>
            @else
            <li class="dropdown">
                <a class="btn theme-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- {{ auth()->user()->nom }} {{ auth()->user()->prenom }} --}}
                        <i class="fa fa-user" aria-hidden="true"></i> <span>Connecté</span>
                </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('public.my-account') }}">Mon compte</a></li>
                {{-- @if (auth()->check() && auth()->user()->hasRole('Professionnel') && auth()->user()->hasRole('Administrateur')) --}}
                    <li><a class="dropdown-item" href="{{ route('public.my-business') }}">Mon entreprise</a></li>
                    <li><a class="dropdown-item" href="{{ route('public.annonces.list') }}">Mes annonces</a></li>
                {{-- @endif --}} 
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('public.my-favorites') }}">Mes favoris</a></li>
                <li><a class="dropdown-item" href="{{ route('public.my-comments') }}">Mes commentaires</a></li>
                <li><hr class="dropdown-divider"></li>
                @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                    <li><a class="dropdown-item" href="{{ route('home') }}">Espace administrateur</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ route('contact') }}">Contact</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off" aria-hidden="true"></i> <span>Me déconnecter</span></a></li>
              </ul>
            </li>
            @endif
          </ul>
        </div>
    </nav>
</div>
