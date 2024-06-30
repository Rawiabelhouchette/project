<div class="col-md-9 col-sm-12">
    <div class="card-body">
        <div class="col-md-12" style="padding: 0px;">
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Erreur !</strong>
                    {{ session()->get('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Succès !</strong>
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <form wire:submit.prevent='update'>
            @csrf
            <div class="col-md-12" style="padding: 0px;">
                <div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
                    <div class="listing-box-header">
                        <i class="ti-user theme-cl"></i>
                        <h3>Informations personnelles</h3>
                    </div>
                    <div class="text-center">
                        @if ($editInfo || $editPass)
                            <a href="javascript:void(0)" class="btn theme-btn" wire:click='cancel'>Annuler</a>
                        @else
                            <a href="javascript:void(0)" class="btn theme-btn" wire:click='editInformation'>Modifier information</a>
                            <a href="javascript:void(0)" class="btn theme-btn" wire:click='editPassword'>Changer mot de passe</a>
                        @endif
                    </div> <br>

                    <div class="row mrg-r-10 mrg-l-10">
                        <div class="col-sm-6">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" @if (!$editInfo) readonly @endif wire:model='nom' required>
                            @error('nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" @if (!$editInfo) readonly @endif wire:model='prenom' required>
                            @error('prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" @if (!$editInfo) readonly @endif wire:model='email' required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label>Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control" wire:model='username' @if (!$editInfo) readonly @endif required>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @if ($editPass)
                <div wire:transition.fade>
                    <div class="col-md-12" style="padding: 0px;">
                        <div class="add-listing-box opening-day mrg-bot-25 padd-bot-30 padd-top-25">
                            <div class="listing-box-header">
                                <i class="ti-lock theme-cl"></i>
                                <h3>Mot de passe</h3>
                            </div>
                            <div class="row mrg-r-10 mrg-l-10">
                                <div class="col-sm-6">
                                    <label>Ancien mot de passe</label>
                                    <input type="password" wire:model='password_old' class="form-control" placeholder="*********" required>
                                    @error('password_old')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" wire:model='password' class="form-control" placeholder="*********" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mrg-r-10 mrg-l-10">
                                <div class="col-sm-6">
                                    <label>Retaper le nouveau mot de passe</label>
                                    <input type="password" wire:model='password_confirmation' class="form-control" placeholder="*********" required>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn theme-btn" wire:loading.attr='disabled' wire:target='update'>Mettre a jour</button>
                    </div>
                </div>
            @endif

            @if ($editInfo)
                <div class="text-center">
                    <button type="submit" class="btn theme-btn" wire:loading.attr='disabled' wire:target='update'>Mettre a jour</button>
                </div>
            @endif
        </form>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('username:changed', event => {
            $('#navbar_username').text(event.detail[0].username);
        });
    </script>
@endpush
