<div id="signin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel2" class="modal-title">{{ __('Connectez-vous à votre compte') }}</h4>
                <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="wel-back">
                    <h2>{{ __('Bienvenue !') }} <span class="theme-cl"></span></h2>
                </div>

                @error('username')
                    <div class="alert-group">
                        <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ $message }}
                        </div>
                    </div>
                @enderror

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Identifiant') }}</label>
                        {{-- <label>Email</label> --}}
                        <input type="text" minlength="4" name="username" class="form-control form-control-sm" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Mot de passe') }}</label>
                        <input type="password" name="password" class="form-control" placeholder="*******" required>
                    </div>

                    <span class="custom-checkbox d-block">
                        <input id="remember1" type="checkbox" name="remember">
                        <label for="remember1"></label>
                        {{ __('Se souvenir de moi') }}
                    </span>

                    <div class="center">
                        <button type="submit" class="btn btn-midium theme-btn btn-radius width-200"> {{ __('Connexion') }} </button>
                    </div>

                </form>
            </div>

            <div class="center mrg-top-5">
                <div class="bottom-login text-center"> {{ __("Vous n'avez pas de compte ?") }}</div>
                <a id="btn-register" href="javascript:void(0)" class="theme-cl">{{ __('Créer un compte') }}</a>

            </div>

        </div>
    </div>
</div>