@extends('layout.public.app-2')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
    <section class="log-wrapper">
        <div class="container">
            <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">
                <div class="log-box padd-bot-25">
                    <h2>Changement de mot de passe <span class="theme-cl">!</span></h2>
                    @error('email')
                        <div class="alert-group">
                            <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror

                    @error('password')
                        <div class="alert-group">
                            <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror

                    @error('success')
                        <div class="alert-group">
                            <div class="alert alert-success alert-dismissable" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nouveau mot de passe" required autocomplete="new-password">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmer le mot de passe" required autocomplete="new-password">
                        </div>

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="mrg-top-20 mrg-bot-20 text-center">
                            <button type="submit" class="btn theme-btn btn-radius">
                                {{ __('Enregistrer') }}
                            </button>
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
