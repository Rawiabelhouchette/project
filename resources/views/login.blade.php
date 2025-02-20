@extends('layout.public.app-2')

@section('title', 'Connexion')

@section('content')
    <section class="log-wrapper">
        <div class="container">
            <div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1">
                <div class="log-box padd-bot-25">
                    <h2>Connexion <span class="theme-cl">!</span></h2>

                    @error('email')
                        <div class="alert-group">
                            <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                <button class="close" data-dismiss="alert" type="button" aria-hidden="true">×</button>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror

                    @if (session('status'))
                        <div class="alert-group">
                            <div class="alert alert-success alert-dismissable" style="text-align: center;">
                                <button class="close" data-dismiss="alert" type="button" aria-hidden="true">×</button>
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" type="text" value="{{ old('email') }}" placeholder="Identifiant" required autocomplete="email" autofocus>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                            <input id="password" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Mot de Passe" required autocomplete="current-password">
                        </div>

                        @if (Route::has('password.reset'))
                            <div class="text-right">
                                <a class="btn-link theme-cl" href="{{ route('password.reset') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            </div>
                        @endif

                        <span class="custom-checkbox d-block">
                            <input id="remember" name="remember" type="checkbox">
                            <label for="remember"></label>
                            {{ __('Se souvenir de moi') }}
                        </span>

                        <div class="form-group">
                            {{-- <div class="form-group" wire:ignore> --}}
                            {!! htmlFormSnippet() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            @enderror
                    </div>

                    <div class="mrg-bot-20 text-center">
                        <button class="btn theme-btn width-200 btn-radius" type="submit">
                            {{ __('Connexion') }}
                        </button>
                    </div>

                    <div class="center mrg-top-5">
                        <div class="bottom-login text-center"> {{ __("Vous n'avez pas de compte ?") }}</div>
                        <a class="theme-cl" data-toggle="modal" data-target="#register" href="{{ route('register') }}">{{ __('Créer un compte') }}</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $('.navbar').removeClass('navbar-transparent');
</script>
@endsection
