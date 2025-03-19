<div>
    <div class="">
        <form wire:submit.prevent="update">
            @csrf
            <div class="row align-items-start">
                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le nom de l'entreprise</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- telephone --}}
                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Téléphone
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le numéro de téléphone</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='telephone' required>
                        @error('telephone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- email --}}
                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Email
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez l'adresse email</h4>
                        <input class="form-control" type="email" placeholder="" wire:model.defer='email' required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                @include('admin.annonce.description-component', [
                    'description' => 'Donnez une description de votre entreprise',
                ])
            </div>

            {{-- whatsapp, facebook, Instagram --}}
            <div class="row align-items-start">
                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>WhatsApp
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <h4>Indiquez le numéro WhatsApp</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='whatsapp' required>
                        @error('whatsapp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Facebook</h3>
                        <h4>Indiquez le lien Facebook</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='facebook'>
                        @error('facebook')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 col-xs-12 p-0">
                    <div class="col">
                        <h3>Instagram</h3>
                        <h4>Indiquez le lien Instagram</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='instagram'>
                        @error('instagram')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                <div class="col-md-12 col-xs-12 p-0">
                    <div class="col">
                        <h3>Site web</h3>
                        <h4>Indiquez le lien du site web</h4>
                        <input class="form-control" type="text" placeholder="" wire:model.defer='site_web'>
                        @error('site_web')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            @include('admin.annonce.location-template', [
                'pays' => $pays,
                'villes' => $villes,
                'quartiers' => $quartiers,
            ])

            {{-- planning --}}
            <h5 class="mb-4 text-center">
                <label class="font-weight-bold">Heure d'ouverture et de fermeture</label>
            </h5>

            @foreach ($plannings as $key => $planning)
                <div class="row align-items-center mb-3">
                    {{-- Jour : dropdown --}}
                    <div class="col-md-4 col-sm-6">
                        <label class="font-weight-bold">Jour
                            <b style="color: red;">*</b>
                        </label>
                        <div class="input-group">
                            @if ($key == 0 && $autreJour)
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary" type="button" wire:click='addPlanning'>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            @elseif ($key > 0)
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-danger" type="button" wire:click="removePlanning({{ $key }})">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            @endif
                            <select class="form-control jour" required wire:model.defer='plannings.{{ $key }}.jour'>
                                <option value="">-- Sélectionnez un jour --</option>
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                                <option value="Dimanche">Dimanche</option>
                                @if ($key == 0)
                                    <option value="Tous les jours">Tous les jours</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    {{-- Heure ouverture : time --}}
                    <div class="col-md-4 col-sm-6">
                        <label class="font-weight-bold">Heure d'ouverture
                            <b style="color: red;">*</b>
                        </label>
                        <input type="time" class="form-control" required wire:model.defer='plannings.{{ $key }}.heure_debut'>
                    </div>

                    {{-- Heure fermeture : time --}}
                    <div class="col-md-4 col-sm-6">
                        <label class="font-weight-bold">Heure de fermeture
                            <b style="color: red;">*</b>
                        </label>
                        <input type="time" class="form-control" required wire:model.defer='plannings.{{ $key }}.heure_fin'>
                    </div>
                </div>
            @endforeach

            @include('admin.annonce.edit-validation-buttons', [
                'withCancel' => false,
            ])

        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            if ($('.jour').val() == 'Tous les jours') {
                Livewire.dispatch('changerJour', [false]);
            }

            $('.jour').on('change', function() {
                var jour = $(this).val();
                if (jour == 'Tous les jours') {
                    Livewire.dispatch('changerJour', [false]);
                } else {
                    Livewire.dispatch('changerJour', [true]);
                }
            });
        });
    </script>
@endpush
