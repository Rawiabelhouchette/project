@extends('layout.public.app')


@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp

    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-1.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Ajouter un restaurant</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('public.annonces.create') }}">Déposer une annonce</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Restaurant</span>
                </div>
            </div>
        </div>
    </section>

<div class="page-name restaurant row">
    <div class="container text-left">
      <div class="row align-items-start">
        <div class="col entreprise">
            <h3>Établissement</h3>
            <h4>Saisissez les coordonnées de l'établissement</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#entreprise" aria-controls="entreprise-1">Mon établissement<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="entreprise" aria-labelledby="entreprise">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="entreprise-1">Mon entreprise</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom<b style="color: red; font-size: 100%;">*</b></label>
                        <input type="text" class="form-control" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Téléphone<b style="color: red; font-size: 100%;">*</b></label>
                        <input type="text" class="form-control telephone" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="ets-email" class="form-label">Email<b style="color: red; font-size: 100%;">*</b></label>
                        <input type="email" class="form-control" id="ets-email" aria-describedby="email">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" aria-describedby="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">Whatsapp</label>
                        <input type="number" class="form-control" id="whatsapp" aria-describedby="whatsapp">
                    </div>
                    <div class="mb-3">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="url" class="form-control" id="facebook" aria-describedby="facebook">
                    </div>
                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="url" class="form-control" id="instagram" aria-describedby="instagram">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Site web</label>
                        <input type="url" class="form-control" id="website" aria-describedby="website">
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="country">Pays</label>
                            <select class="form-control" id="country">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="city">Ville</label>
                            <select class="form-control" id="city">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="location">Quartier</label>
                            <select class="form-control" id="location">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" class="form-control" id="longitude" aria-describedby="longitude">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" class="form-control" id="latitude" aria-describedby="latitude">
                    </div>
                    <div class="mb-3">
                        <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-center">Heure d'ouverture et de fermeture</h6>
                        <div class="form-group">
                            <label for="horaire">Tableau des horaires à intégrer une fois le code prêt</label>
                            <select class="form-control" id="horaire">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                    </div>
                
                <button type="submit" class="btn btn-sucess mb-2">Enregistrer</button>
                <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                </form>
            </div>
        </div>
        </div>
        <div class="col equipments">
            <h3>Equipements</h3>
            <h4>Ajoutez des équipements</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#equipement-1" aria-controls="equipement-1">Equipement 1<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="equipement-1" aria-labelledby="equipement-1">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="equipement-1">Equipement 1</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                    <div class="form-group">
                        <label for="equipement-1">Sélectionner un équipement</label>
                        <select class="form-control" id="equipement-1">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sucess mb-2">Enregistrer</button>
                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                </form>
            </div>
        </div>
            <button type="button" class="btn btn-success btn-square"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col consomations">
            <h3>Boissons</h3>
            <h4>Saisissez la carte des boissons</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#boisson-1" aria-controls="boisson-1">Boisson 1<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="boisson-1" aria-labelledby="boisson-1">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="boisson-1">Boisson 1</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                    <div class="form-group">
                        <label for="name-1">Nom</label>
                        <input type="text" class="form-control" id="name-1">
                    </div>
                    <div class="form-group">
                        <label for="description">Ingrédients</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price-1">Prix</label>
                        <input type="text" class="form-control" id="price-1">
                    </div>
                    <div class="form-group">
                        <label for="form-img-1">Image à la Une</label>
                        <input type="file" class="form-control-file" id="form-img-1">
                    </div>
                    <button type="submit" class="btn btn-sucess mb-2">Enregistrer</button>
                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                </form>
            </div>
        </div>
            <button type="button" class="btn btn-success btn-square"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    
      <div class="row align-items-start">
        <div class="col entrees">
            <h3>Entrées</h3>
            <h4>Carte des entrées</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#entree-1" aria-controls="entree-1">Entrée 1<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="entree-1" aria-labelledby="entree-1">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="entree-1">Entrée 1</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                    <div class="form-group">
                        <label for="name-1">Nom</label>
                        <input type="text" class="form-control" id="name-1">
                    </div>
                    <div class="form-group">
                        <label for="description">Ingrédients</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price-1">Prix</label>
                        <input type="text" class="form-control" id="price-1">
                    </div>
                    <div class="form-group">
                        <label for="form-img-1">Image à la Une</label>
                        <input type="file" class="form-control-file" id="form-img-1">
                    </div>
                    <button type="submit" class="btn btn-sucess mb-2">Enregistrer</button>
                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                </form>
            </div>
        </div>
            <button type="button" class="btn btn-success btn-square"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col plats">
            <h3>Plats</h3>
            <h4>Carte des plats</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#plat-1" aria-controls="entree-1">Plat 1<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="plat-1" aria-labelledby="plat-1">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="entree-1">Plat 1</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                    <div class="form-group">
                        <label for="name-1">Nom</label>
                        <input type="text" class="form-control" id="name-1">
                    </div>
                    <div class="form-group">
                        <label for="description">Ingrédients</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price-1">Prix</label>
                        <input type="text" class="form-control" id="price-1">
                    </div>
                    <div class="form-group">
                        <label for="form-img-1">Image à la Une</label>
                        <input type="file" class="form-control-file" id="form-img-1">
                    </div>
                    <button type="submit" class="btn btn-sucess mb-2">Enregistrer</button>
                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                </form>
            </div>
        </div>
            <button type="button" class="btn btn-success btn-square"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col desserts">
            <h3>Desserts</h3>
            <h4>Carte des desserts</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#dessert-1" aria-controls="dessert-1">Dessert 1<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="dessert-1" aria-labelledby="dessert-1">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="dessert-1">Dessert 1</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                    <div class="form-group">
                        <label for="name-1">Nom</label>
                        <input type="text" class="form-control" id="name-1">
                    </div>
                    <div class="form-group">
                        <label for="description">Ingrédients</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price-1">Prix</label>
                        <input type="text" class="form-control" id="price-1">
                    </div>
                    <div class="form-group">
                        <label for="form-img-1">Image à la Une</label>
                        <input type="file" class="form-control-file" id="form-img-1">
                    </div>
                    <button type="submit" class="btn btn-sucess mb-2">Enregistrer</button>
                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                </form>
            </div>
        </div>
            <button type="button" class="btn btn-success btn-square"><i class="fa fa-plus"></i></button>

          </div>
        </div>
    <div class="row align-items-end">
        <button type="submit" class="btn btn-danger mb-2">Supprimer l'annonce</button>
        <button type="submit" class="btn btn-success mb-2">Sauvegarder l'annonce</button>
    </div>
</div>

</div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mymap);

        var marker;

        mymap.on('click', function(e) {
            if (marker) {
                mymap.removeLayer(marker); // Supprimez le marqueur existant s'il y en a un.
            }

            marker = L.marker(e.latlng).addTo(mymap);
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;



            Livewire.dispatch('setLocation', [{
                lon,
                lat
            }]);
        });
    </script>

@endsection
