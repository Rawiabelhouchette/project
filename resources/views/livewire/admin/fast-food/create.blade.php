<div>
    <div class="fast-food-template">
        <form>
            @csrf
            <div class="row align-items-start">
                <div class="col entreprise" wire:ignore>
                    <div>
                        <h3>Entreprise
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
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
                <div class="col nom">
                    <div>
                        <h3>Nom
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <input class="form-control" name="nom" type="text" placeholder="" required wire:model.defer='nom' required>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col description">
                    <div>
                        <h3>Description
                            <b style="color: red; font-size: 100%;">*</b>
                        </h3>
                        <textarea class="form-control" id="description" name="description" placeholder="" required wire:model.defer='description' required></textarea>
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>  
            </div>
            <div class="row align-items-start">
                @include('admin.annonce.reference-select-component', [
                    'title' => 'Équipements',
                    'name' => 'equipements_restauration',
                    'options' => $list_equipements_restauration,
                ])
            </div>
            
              
           <div class="row align-items-start">
               <div class="col plats">
                <h3>Plats
                    <b style="color: red; font-size: 100%;">*</b>
                </h3>
                <h4>Carte des plats</h4>
                <div id="plats-container">
                        <div class="form-group plat-item" id="plat-item">
                            <div>
                                <button class="btn btn-form" data-bs-toggle="offcanvas" data-bs-target="#plat" type="button" aria-controls="plat">
                                    Plat <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            <div class="offcanvas offcanvas-end" id="plat" data-bs-scroll="true" aria-labelledby="plat" tabindex="-1">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title">Plat</h5>
                                    <button class="btn-close text-reset" id="plats-close" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="form-group">
                                        <label for="plat-name">Nom<b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control required-field" id="plat-name" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="plat-description">Accompagnements<b style="color: red; font-size: 100%;">*</b></label>
                                        <textarea class="form-control required-field" id="plat-description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="plat-price">Prix<b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control required-field" id="plat-price" type="number">
                                    </div>
                                    <div class="form-group">
                                        <label for="form-img-plat">Image à la Une <b style="color: red; font-size: 100%;">*</b></label>
                                        <input class="form-control form-control-file" id="form-img-plat" type="file">
                                    </div>
                                    <button class="btn btn-danger mb-2 delete-plat-btn" type="button">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    <button class="btn btn-success btn-square" id="add-plat-btn" type="button"><i class="fa fa-plus"></i></button>
                </div>
            </div>
           </div>
 
           <div class="row align-items-start">
                @include('admin.annonce.location-template', [
                    'pays' => $pays,
                    'villes' => $villes,
                    'quartiers' => $quartiers,
                ])
    
                @include('admin.annonce.create-galery-component', [
                    'galery' => $galerie,
                ])
            </div>

            <div class="row padd-bot-15">
                <div class="form-group">
                    <div class="col text-right">
                        <button class="btn theme-btn" id="fast-food-form-submit" type="submit" style="margin-right: 30px;" wire:loading.attr="disabled">
                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </form>
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

