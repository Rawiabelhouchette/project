<div id="register" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
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

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="registration" value="usager">

                    <div class="row">

                        {{-- Nom --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                        </div>

                        {{-- Prénom --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                        </div>

                        {{-- Sexe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Sexe</label>
                            <select class="form-control" name="sexe" required>
                                <option value="" data-placeholder="Choisir" style="font-style: italic; opacity: 0.4;">Choisir</option>
                                {{-- @if ($sexes && $sexes->reference_valeurs)
                                    @foreach ($sexes->reference_valeurs as $sexe)
                                        <option value="{{ $sexe->valeur }}">{{ $sexe->valeur }}</option>
                                    @endforeach
                                @endif --}}
                            </select>
                        </div>

                        {{-- Nom d'utilisateur --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        {{-- Telephone --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Téléphone</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Téléphone" required>
                        </div>

                        {{-- Mot de passe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                        </div>

                        {{-- Confirmation du mot de passe --}}
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-12 form-group">
                            <label>Rattaper le mot de passe</label>
                            <input type="password" name="mot_de_passe_confirmation" class="form-control" placeholder="Rattaper le mot de passe" required>
                        </div>

                    </div>

                    <span class="custom-checkbox d-block">
                        <input id="remember" type="checkbox" name="remember">
                        <label for="remember"></label>
                        {{ __('Se souvenir de moi') }}
                    </span>

                    <div class="center">
                        <button id="signup" type="submit" class="btn btn-midium theme-btn btn-radius width-200"> Enregistrer </button>
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
