<div id="signin" class="modal fade" data-bs-backdrop="static" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel2" class="modal-title">{{ __('Connectez-vous à votre compte') }}</h4>
                <button class="btn-close m-close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="wel-back">
                    <h2>{{ __('Bienvenue !') }} <span class="theme-cl"></span></h2>
                </div>

                @if ($error)
                    <div class="alert-group">
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <form id="demo-form" wire:submit.prevent="login">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Identifiant / Email') }}</label>
                        <input class="form-control form-control-sm" name="email" type="text" minlength="4" placeholder="Identifiant" wire:model='email' required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Mot de passe') }}</label>
                        <input class="form-control" name="password" type="password" placeholder="*******" wire:model='password' required>
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

                    @if (Route::has('password.reset'))
                        <div class="text-end">
                            <a class="btn-link theme-cl" href="{{ route('password.reset') }}">
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

                    <div class="center">
                        <button class="btn btn-midium theme-btn btn-radius width-200" type="submit" wire:loading.attr='disabled'>
                            <span wire:loading>
                                @include('components.public.loader', ['withText' => false, 'color' => '#de6600'])
                            </span>
                            <span>
                                &nbsp;{{ __('Connexion') }}
                            </span>
                        </button>
                    </div>

                </form>
            </div>

            <div class="center mrg-top-5">
                <div class="bottom-login text-center"> {{ __("Vous n'avez pas de compte ?") }}</div>
                <a class="theme-cl" href="{{ route('register') }}">{{ __('Créer un compte') }}</a>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        function recaptchaCallback() {
            // console.log('Captcha resolved');
            @this.set('recaptcha', grecaptcha.getResponse());
        }

        function expiredCallbackFunction() {
            // console.log('Captcha expired');
            grecaptcha.reset();
            @this.set('recaptcha', '');
        }

        window.addEventListener('recaptcha:reset', event => {
            expiredCallbackFunction();
        });
    </script>
@endpush
