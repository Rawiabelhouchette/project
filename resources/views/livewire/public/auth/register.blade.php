<div wire:ignore.self id="register" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modalLabel3" class="modal-title">{{ __('Créer un nouveau compte') }}</h4>
                <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <div class="wel-back">
                    <h3>Bienvenue! <span class="theme-cl">Nouveau compte ?</span></h3>
                </div>

                @if($error)
                    <div class="alert-group">
                        <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ $message }}
                        </div>
                    </div>
                @endif

                <form wire:submit="register()">
                    @csrf

                    <input type="hidden" name="registration" value="usager">

                    <div class="row">

                        {{-- Nom --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Nom" required wire:model="nom">
                        </div>

                        {{-- Prénom --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required wire:model="prenom">
                        </div>

                        {{-- Sexe --}}
                        {{-- <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Sexe</label>
                            <select class="form-control" name="sexe" required wire:model="sexe">
                                <option value="" data-placeholder="Choisir" style="font-style: italic; opacity: 0.4;">Choisir</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Féminin">Féminin</option>
                            </select>
                        </div> --}}

                        {{-- Nom d'utilisateur --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required wire:model="username">
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required wire:model="email">
                        </div>

                        {{-- Telephone --}}
                        {{-- <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Téléphone</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Téléphone" required>
                        </div> --}}

                        {{-- Mot de passe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required wire:model="password">
                        </div>

                        {{-- Confirmation du mot de passe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Rattaper le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Rattaper le mot de passe" required wire:model="password_confirmation">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <span class="custom-checkbox d-block">
                        <input id="remember" type="checkbox" name="remember" wire:model="remember">
                        <label for="remember"></label>
                        {{ __('Se souvenir de moi') }}
                    </span>

                    <div class="center">
                        <button id="signup" wire:target='register' wire:loading.attr='disabled' type="submit" class="btn btn-midium theme-btn btn-radius width-200"> Enregistrer </button>
                    </div>
            </div>

            </form>

            <div class="center mrg-top-5">
                <div class="bottom-login text-center">Déjà un compte ? </div>
                <a id="btn-login" href="javascript:void(0)" class="theme-cl">{{ __('Se Connecter') }}</a>
            </div>

        </div>
    </div>
</div>
