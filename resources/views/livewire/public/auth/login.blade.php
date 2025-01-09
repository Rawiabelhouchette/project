<div class="modal fade" id="signin" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel2">{{ __('Connectez-vous à votre compte') }}</h4>
                <button class="m-close" data-dismiss="modal" type="button" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="wel-back">
                    <h2>{{ __('Bienvenue !') }} <span class="theme-cl"></span></h2>
                </div>

                @if ($error)
                    <div class="alert-group">
                        <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                            <button class="close" data-dismiss="alert" type="button" aria-hidden="true">×</button>
                            {{ $message }}
                        </div>
                    </div>
                @endif

                <form id="demo-form" wire:submit="login()">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Identifiant') }}</label>
                        <input class="form-control form-control-sm" name="email" type="text" minlength="4" placeholder="Username" wire:model='email' required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Mot de passe') }}</label>
                        <input class="form-control" name="password" type="password" placeholder="*******" wire:model='password' required>
                    </div>

                    <div class="form-group">
                        {{-- <div class="form-group" wire:ignore> --}}
                        {!! htmlFormSnippet() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @enderror
                    </div>

                    {{-- <div class="form-group g-recaptcha" data-sitekey="6Lcu0KgqAAAAAJWCA-yj93pHbZWKgLqX9wvKhX5X">
                    </div> --}}

                    @if (Route::has('password.reset'))
                        <div class="text-right">
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
                        <button class="btn btn-midium theme-btn btn-radius width-200" type="submit" wire:target='login' wire:loading.attr='disabled'>
                            <span wire:loading>
                                @include('components.public.loader', ['withText' => false, 'color' => '#fff'])
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
                <a class="theme-cl" id="btn-register" href="javascript:void(0)">{{ __('Créer un compte') }}</a>
            </div>

        </div>
    </div>
</div>
