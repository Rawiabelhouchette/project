<div>

    <div class="modal-body">

        <div class="wel-back">
            <h3>Bienvenue! <span class="theme-cl">Nouveau compte ?</span></h3>
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

                {{-- Nom --}}
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 form-group">
                    <label for="nom">Nom</label>
                    <input class="form-control" id="nom" type="text" placeholder="Nom" required wire:model="nom">
                </div>

                {{-- Prénom --}}
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6 form-group">
                    <label for="prenom">Prénom</label>
                    <input class="form-control" id="prenom" type="text" placeholder="Prénom" required wire:model="prenom">
                </div>

                {{-- Nom d'utilisateur --}}
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input class="form-control" id="username" type="text" placeholder="Nom d'utilisateur" required wire:model="username">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email" placeholder="Email" required wire:model="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Type --}}
                {{-- <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label for="type">Type de compte</label>
                            <select class="form-control" required data-nom="type" wire:model.lazy="type">
                                <option style="font-style: italic; opacity: 0.4;">Choisir</option>
                                <option value="Usager">Usager</option>
                                <option value="Professionnel">Professionnel</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                {{-- Mot de passe --}}
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                    <label for="password">Mot de passe</label>
                    <input class="form-control" id="password" type="password" placeholder="Mot de passe" required wire:model="password">
                </div>

                {{-- Confirmation du mot de passe --}}
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                    <label for="password_confirmation">Rattaper le mot de passe</label>
                    <input class="form-control" id="password_confirmation" type="password" placeholder="Rattaper le mot de passe" required wire:model="password_confirmation">
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

            <span class="custom-checkbox d-block">
                <input id="remember" name="remember" type="checkbox" wire:model="remember">
                <label for="remember">
                    {{ __('Se souvenir de moi') }}
                </label>
            </span>

            <div class="center">
                <button class="btn btn-midium theme-btn btn-radius width-200" id="signup" type="submit" wire:loading.attr='disabled'>
                    <span wire:loading>
                        @include('components.public.loader', ['withText' => false, 'color' => '#fff'])
                    </span>
                    <span>
                        &nbsp;{{ __('Enregistrer') }}
                    </span>
                </button>
            </div>

        </form>
    </div>

    <div class="center mrg-top-5">
        <div class="bottom-login text-center">Déjà un compte ? </div>
        <a class="theme-cl" id="btn-login" href="javascript:void(0)">{{ __('Se Connecter') }}</a>
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
    </script>
@endpush
