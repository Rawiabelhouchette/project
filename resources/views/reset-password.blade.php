@extends('layout.public.app-2')

@section('title', 'Reset Password')

@section('content')
    <section class="log-wrapper">
        <div class="container">
            <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">
                <div class="log-box padd-bot-25">
                    <h2>Réinitialiser le mot de passe <span class="theme-cl">!</span></h2>

                    @error('email')
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

                    <form method="POST" action="{{ route('password.reset.post') }}">
                        @csrf

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                        </div>

                        <div class="text-center mrg-top-20 mrg-bot-20">
                            <button type="submit" class="btn theme-btn btn-radius">
                                {{ __('Réinitialiser') }}
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