<div class="page-name restaurant row">

    <div>
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" type="button" aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button>

        <div class="offcanvas offcanvas-start" id="offcanvasWithBothOptions" data-bs-scroll="true" aria-labelledby="offcanvasWithBothOptionsLabel" tabindex="-1">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdroped with scrolling</h5>
                <button class="btn-close text-reset" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <p>Try scrolling the rest of the page to see this option in action.</p>
            </div>
        </div>
    </div>

    -------------------------
    <div class="col-md-12">
        <div class="card title">
            <div class="card-header">
                <h4>Ajouter un restaurant</h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="panel-group style-1" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" id="designing" role="tab">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                            Restaurant
                        </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="designing">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form wire:submit="store()">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12" style="margin-top: 15px;" wire:ignore>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <label class="">Entreprise
                                                    <b style="color: red; font-size: 100%;">*</b>
                                                </label>
                                                <select class="select2" data-nom="entreprise_id" wire:model.defer='entreprise_id' required>
                                                    <option value="">-- Sélectionner --</option>
                                                    @foreach ($entreprises as $entreprise)
                                                        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                                    @endforeach
                                                </select>
                                                @error('entreprise_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <label class="required">Nom
                                                    <b style="color: red; font-size: 100%;">*</b>
                                                </label>
                                                <input class="form-control" type="text" placeholder="" required wire:model.defer='nom' required>
                                                @error('nom')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <label class="">Date de validité
                                                    <b style="color: red; font-size: 100%;">*</b>
                                                </label>
                                                <input class="form-control" type="date" min="{{ now()->toDateString() }}" placeholder="" wire:model.defer='date_validite' required>
                                                @error('date_validite')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="">Description
                                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                        </label>
                                        <textarea class="form-control height-100" id="description" placeholder="" wire:model.defer='description'></textarea>
                                    </div>

                                    <div class="col-md-12">

                                        @include('admin.annonce.reference-select-component', [
                                            'title' => 'Type de cuisine',
                                            'name' => 'specialites',
                                            'options' => $list_specialites,
                                        ])

                                        @include('admin.annonce.reference-select-component', [
                                            'title' => 'Equipements restaurant',
                                            'name' => 'equipements_restauration',
                                            'options' => $list_equipements_restauration,
                                        ])

                                        @include('admin.annonce.reference-select-component', [
                                            'title' => 'Boissons disponibles',
                                            'name' => 'carte_consommation',
                                            'options' => $list_carte_consommation,
                                        ])

                                        @include('admin.annonce.reference-select-component', [
                                            'title' => 'Services proposés',
                                            'name' => 'services',
                                            'options' => $list_services,
                                        ])

                                    </div>

                                    @include('admin.annonce.create-galery-component', [
                                        'galery' => $galerie,
                                    ])

                                </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" id="entrees" role="tab">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                Entrées ({{ count($entrees) }})
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapseTwo" role="tabpanel" aria-labelledby="entrees">
                        <div class="panel-body">
                            <div class="">

                                <div class="card-body">
                                    @foreach ($entrees as $key => $entree)
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Nom
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" required wire:model.defer='entrees.{{ $key }}.nom' required></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Ingrédients
                                                                {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                            </label>
                                                            <textarea class="form-control" type="text" placeholder="" wire:model.defer='entrees.{{ $key }}.ingredients'></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label class="">Prix minimum
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <input class="form-control" type="number" wire:model.defer='entrees.{{ $key }}.prix_min'>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">Prix maximum
                                                                <b style="color: red; font-size: 100%;">*</b>
                                                            </label>
                                                            <input class="form-control" type="number" placeholder="" wire:model.defer='entrees.{{ $key }}.prix_max'>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            @if ($key == 0)
                                                                <button class="btn theme-btn btnAdd" type="button" style="background-color: green; border-color: green" wire:click="addEntree">
                                                                    <i class="fa fa-plus fa-lg text-center" style=""></i>
                                                                    Ajouter une entrée
                                                                </button>
                                                            @else
                                                                <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removeEntree({{ $key }})">
                                                                    <i class="fa fa-minus fa-lg text-center" style=""></i>
                                                                    Ajouter une entrée
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($entrees_error && $key == count($entrees) - 1)
                                                    <div class="col-md-6 col-xs-12 text-center">
                                                        <span class="text-danger">{{ $entrees_error }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" id="plats" role="tab">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                Plats ({{ count($plats) }})
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapseThree" role="tabpanel" aria-labelledby="plats">
                        <div class="panel-body">
                            <div class="">

                                @foreach ($plats as $key => $plat)
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Nom
                                                            <b style="color: red; font-size: 100%;">*</b>
                                                        </label>
                                                        <textarea class="form-control" type="text" placeholder="" required wire:model.defer='plats.{{ $key }}.nom' required></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Ingrédients
                                                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                        </label>
                                                        <textarea class="form-control" type="text" placeholder="" wire:model.defer='plats.{{ $key }}.ingredients'></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Accompagnements
                                                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                        </label>
                                                        <textarea class="form-control" type="text" placeholder="" wire:model.defer='plats.{{ $key }}.accompagnements'></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Prix minimum
                                                            <b style="color: red; font-size: 100%;">*</b>
                                                        </label>
                                                        <input class="form-control" type="number" wire:model.defer='plats.{{ $key }}.prix_min'>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Prix maximum
                                                            <b style="color: red; font-size: 100%;">*</b>
                                                        </label>
                                                        <input class="form-control" type="number" placeholder="" wire:model.defer='plats.{{ $key }}.prix_max'>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-1 col-sm-4 col-xl-12" style="margin-top: 15px;">
                                                <label class="">&nbsp;</label>
                                                @if ($key == 0)
                                                    <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addPlat">
                                                        <i class="fa fa-plus fa-lg text-center" style=""></i>
                                                    </button>
                                                @else
                                                    <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removePlat({{ $key }})">
                                                        <i class="fa fa-minus fa-lg text-center" style=""></i>
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($plats_error && $key == count($plats) - 1)
                                                <div class="col-md-6 col-xs-12 text-center">
                                                    <span class="text-danger">{{ $plats_error }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" id="desserts" role="tab">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" role="button" aria-expanded="false" aria-controls="collapseFour">
                                Desserts ({{ count($desserts) }})
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapseFour" role="tabpanel" aria-labelledby="desserts">
                        <div class="panel-body">
                            <div class="">

                                @foreach ($desserts as $key => $dessert)
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xl-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Nom
                                                            <b style="color: red; font-size: 100%;">*</b>
                                                        </label>
                                                        <textarea class="form-control" type="text" placeholder="" required wire:model.defer='desserts.{{ $key }}.nom' required></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Ingrédients
                                                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                                                        </label>
                                                        <textarea class="form-control" type="text" placeholder="" wire:model.defer='desserts.{{ $key }}.ingredients'></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Prix minimum
                                                            <b style="color: red; font-size: 100%;">*</b>
                                                        </label>
                                                        <input class="form-control" type="number" wire:model.defer='desserts.{{ $key }}.prix_min'>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="">Prix maximum
                                                            <b style="color: red; font-size: 100%;">*</b>
                                                        </label>
                                                        <input class="form-control" type="number" placeholder="" wire:model.defer='desserts.{{ $key }}.prix_max'>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="margin-top: 15px;">
                                                <label class="">&nbsp;</label>
                                                @if ($key == 0)
                                                    <button class="btn theme-btn" type="button" style="background-color: green; border-color: green" wire:click="addDessert">
                                                        <i class="fa fa-plus fa-lg text-center" style=""></i>
                                                    </button>
                                                @else
                                                    <button class="btn theme-btn" type="button" style="background-color: red; border-color: red" wire:click="removeDessert({{ $key }})">
                                                        <i class="fa fa-minus fa-lg text-center" style=""></i>
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($desserts_error && $key == count($desserts) - 1)
                                                <div class="col-md-6 col-xs-12 text-center">
                                                    <span class="text-danger">{{ $desserts_error }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row padd-bot-15">
            <div class="form-group" style="margin-top: 15px;">
                <div class="col-md-6 col-xs-12 text-right">
                    <button class="btn theme-btn btnAdd" type="submit" style="margin-right: 30px;" wire:target='store'>
                        <i class="fa fa-add fa-lg" style="margin-right: 10px;"></i>
                        Enregistrer le restaurant
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>

</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                height: '25px',
                width: '100%',
            });
            $('.select2').on('change', function(e) {
                var data = $(this).val();
                var nom = $(this).data('nom');
                @this.set(nom, data);
            });
        });
    </script>
@endpush
