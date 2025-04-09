<div>
    <div class="wel-back">
        <h2>Bienvenue! <span class="theme-cl">Nouveau compte ?</span></h2>
    </div>

    @if ($error)
        <div class="alert-group">
            <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                <button class="close" data-dismiss="alert" type="button" aria-hidden="true">×</button>
                {{ $message }}
            </div>
        </div>
    @endif

    <form wire:submit.prevent="register">
        @csrf

        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 mb-4">
                <div class="input-group mb-2">
                    <span class="input-group-addon"><i class="fa fa-user theme-cl"></i></span>
                    <input id="nom" class="form-control" type="text" placeholder="Nom" required wire:model="nom">
                </div>
                @error('nom')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 mb-4">
                <div class="input-group mb-2">
                    <span class="input-group-addon"><i class="fa fa-user theme-cl"></i></span>
                    <input id="prenom" class="form-control" type="text" placeholder="Prénom" required wire:model="prenom">
                </div>
                @error('prenom')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 mb-4">
                <div class="input-group mb-2">
                    <span class="input-group-addon"><i class="fa fa-user-lock theme-cl"></i></span>
                    <input id="username" class="form-control" type="text" placeholder="Nom d'utilisateur" required wire:model="username">
                </div>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 mb-4">
                <div class="input-group mb-2">
                    <span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
                    <input id="email" class="form-control" type="email" placeholder="Email" required wire:model="email">
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 mb-4">
                <div class="input-group mb-2">
                    <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                    <input id="password" class="form-control" type="password" placeholder="Mot de passe" required wire:model="password">
                    <span class="input-group-addon" onclick="togglePasswordVisibility('password')">
                        <i id="toggle-password-icon-password" class="fa fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 mb-4">
                <div class="input-group mb-2">
                    <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                    <input id="password_confirmation" class="form-control" type="password" placeholder="Rattaper le mot de passe" required wire:model="password_confirmation">
                    <span class="input-group-addon" onclick="togglePasswordVisibility('password_confirmation')">
                        <i id="toggle-password-icon-password_confirmation" class="fa fa-eye"></i>
                    </span>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div wire:ignore>
                {!! htmlFormSnippet([
                    'callback' => 'recaptchaCallbackRegister',
                    'expired-callback' => 'expiredCallbackFunctionRegister',
                ]) !!}
            </div>

            @error('recaptcha')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- <span class="custom-checkbox d-block">
            <input id="remember" name="remember" type="checkbox" wire:model="remember">
            <label for="remember">
                {{ __('Se souvenir de moi') }}
            </label>
        </span> --}}

        <div class="center">
            <button id="signup" class="btn btn-midium theme-btn btn-radius width-200" type="submit" wire:loading.attr='disabled'>
                <span style="display: inline-flex; align-items: center;">
                    <b wire:loading>@include('components.public.loader', ['withText' => false, 'color' => '#de6600'])</b>
                    {{ __('Enregistrer') }}
                </span>
            </button>
        </div>
    </form>

    <div class="center mt-4">
        <div class="bottom-login text-center">Déjà un compte ? </div>
        <a id="btn-login" class="theme-cl" href="{{ route('login') }}">{{ __('Se Connecter') }}</a>
    </div>
</div>

@push('scripts')
    <script>
        function recaptchaCallbackRegister() {
            // console.log('Captcha resolved');
            @this.set('recaptcha', grecaptcha.getResponse());
        }

        function expiredCallbackFunctionRegister() {
            // console.log('Captcha expired');
            grecaptcha.reset();
            @this.set('recaptcha', '');
        }

        window.addEventListener('recaptcha:reset', event => {
            expiredCallbackFunctionRegister();
        });

        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(`toggle-password-icon-${fieldId}`);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endpush
