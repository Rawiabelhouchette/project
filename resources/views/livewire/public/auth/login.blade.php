<div id="signin" class="modal fade" data-bs-backdrop="static" role="dialog" aria-labelledby="myModalLabel2"
    aria-hidden="true" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel2" class="modal-title text-white">{{ __('Connexion / Inscription') }}</h4>
                <button class="btn-close text-white" style="float: right;" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="d-flex gap-2 mt-3">
                    <div class="login-tab login-tab-active" id="login-tab" onclick="switchTab('login')">CONNEXION</div>
                    <div class="login-tab" id="register-tab" onclick="switchTab('register')">INSCRIPTION</div>
                </div>

                <!-- Login Form -->
                <div id="login-form" class="auth-form">
                    <div class="wel-back">
                        <h2 style="font-weight: 900;">{{ __('Bienvenue !') }} <span class="theme-cl"></span></h2>
                    </div>

                    @if ($error)
                        <div class="alert-group">
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <form id="demo-form" wire:submit.prevent="login">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user theme-cl"></i></span>
                            <input class="form-control form-control-sm" name="email" type="text" minlength="4"
                                placeholder="Identifiant / Email" wire:model='email' required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="form-group position-relative">
                            <input class="form-control" name="password" type="password"
                                placeholder="Mot de passe" wire:model='password' id="password-field" required>

                            <button type="button" class="btn btn-sm position-absolute translate-middle-y me-2"
                                onclick="togglePasswordVisibility()" style="z-index: 5;background: #de6600;color: #fff;padding: 10px 12px;right: 5px;top: 25px">
                                <i class="fa fa-eye" id="toggle-password-icon"></i>
                            </button>
                        </div> -->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                            <input id="password" class="form-control" type="password" placeholder="Mot de passe" required wire:model="password">
                            <span class="input-group-addon" onclick="togglePasswordVisibility('password')">
                                <i id="toggle-password-icon-password" class="fa fa-eye"></i>
                            </span>
                        </div>

                        <div class="form-group">
                            <div wire:ignore>
                                {!! htmlFormSnippet([
                                    'callback' => 'recaptchaCallback',
                                    'expired-callback' => 'expiredCallbackFunction',
                                ]) !!}
                            </div>

                            @error('recaptcha')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-between ">    
                        @if (Route::has('password.reset'))
                            <div class="text-center">
                                <a style="text-decoration: none;" class="btn-link theme-cl" href="{{ route('password.reset') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            </div>
                        @endif

                        <span class="custom-checkbox d-block">
                            <input id="remember" name="remember" type="checkbox" wire:model='remember'>
                            <label for="remember" style="font-weight: normal;">
                                {{ __('Se souvenir de moi') }}
                            </label>
                        </span>
                        </div>

                        <div class="center">
                            <button class="btn btn-midium theme-btn btn-radius" style="border-radius: 5px; width: 100%;" type="submit"
                                wire:loading.attr='disabled'>
                                <span wire:loading>
                                    @include('components.public.loader', [
                                        'withText' => false,
                                        'color' => '#de6600',
                                    ])
                                </span>
                                <span>
                                    &nbsp;{{ __('Connexion') }}
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <div class="utf-login_with my-3">
                        <span class="txt">Ou conntecter avec</span>
                    </div>
                    <div class="mrg-bot-20 text-center d-flex flex-column justify-content-center align-items-center" style="gap: 5px;">
                        <button type="button" class="login-with-google-btn"
                            onclick="window.location.href='{{ route('google.login') }}'">
                             Google
                        </button>
                    </div>
                    <div class="center mrg-top-5">
                        <div class="bottom-login text-center"> {{ __("Vous n'avez pas de compte ?") }}</div>
                        <a class="theme-cl" href="{{ route('register') }}">{{ __('Créer un compte') }}</a>
                    </div>
                </div>

                <!-- Register Form -->
                <div id="register-form" class="auth-form" style="display: none;">
                    @livewire('public.auth.register')
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Tab switching functionality
        function switchTab(tab) {
            if (tab === 'login') {
                document.getElementById('login-form').style.display = 'block';
                document.getElementById('register-form').style.display = 'none';
                document.getElementById('login-tab').classList.add('login-tab-active');
                document.getElementById('register-tab').classList.remove('login-tab-active');
            } else {
                document.getElementById('login-form').style.display = 'none';
                document.getElementById('register-form').style.display = 'block';
                document.getElementById('login-tab').classList.remove('login-tab-active');
                document.getElementById('register-tab').classList.add('login-tab-active');
            }
        }

        // Login form recaptcha
        function recaptchaCallback() {
            @this.set('recaptcha', grecaptcha.getResponse());
        }

        function expiredCallbackFunction() {
            grecaptcha.reset();
            @this.set('recaptcha', '');
        }

        // Register form recaptcha
        function recaptchaCallbackRegister() {
            @this.set('recaptcha', grecaptcha.getResponse());
        }

        function expiredCallbackFunctionRegister() {
            grecaptcha.reset();
            @this.set('recaptcha', '');
        }

        window.addEventListener('recaptcha:reset', event => {
            expiredCallbackFunction();
        });

        // Password visibility toggle
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

    <style>
        .login-tab {
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px 5px 0 0;
            font-weight: bold;
            flex: 1;
            transition: all 0.3s ease;
            border-bottom: 2px solid #eee;
        }
        
        .login-tab-active {
            border-bottom: 2px solid #de6600;
            color: #de6600;
        }
        
        .auth-form {
            background: #fff;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
@media (max-width: 992px) {
        .form-group {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
    }

    </style>
@endpush