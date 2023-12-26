<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="ti-align-left"></i>
        </button>

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                <img src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" class="logo logo-display" alt="">
                <img src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" class="logo logo-scrolled" alt="">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="navbar-menu" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                {{-- <li><a href="javascript:void(0)" data-toggle="modal" data-target="#signin">{{ __('Déposer votre annonce') }}</a></li> --}}
                <li><a href="javascript:void(0)">{{ __('Déposer votre annonce') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                {{-- <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp"> --}}
                <li class="no-pd">
                    <a href="{{ route('login') }}" class="addlist">
                        {{-- <i class="ti-plus" aria-hidden="true"></i> --}}
                        {{ __('Connexion') }}
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
