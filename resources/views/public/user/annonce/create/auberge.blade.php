@extends('layout.public.app')


@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp

    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-2.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Ajouter une auberge</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route('public.annonces.create') }}">Déposer une annonce</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Auberge</span>
                </div>
            </div>
        </div>
    </section>

<div class="page-name auberge row">
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
            <div class="col type-hebergement">
                <h3>Hébergement</h3>
                <h4>Ajoutez un type d'hébergement</h4>
                <form>
                    <div class="form-group ad-types">
                        <label id="hebergement" for="hebergement" aria-label="Sélectionner un type d'hébergement"></label>
                        <select class="form-control" id="hebergement">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col type-beds">
                <h3>Literie</h3>
                <h4>Saisissez un types de lit</h4>
                <form>
                    <div class="form-group ad-types">
                        <label id="beds" for="beds" aria-label="Sélectionner un type de lit"></label>
                        <select class="form-control" id="beds">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col type-commodites">
                <h3>Commodités</h3>
                <h4>Ajoutez des commodités</h4>
                <form>
                    <select class="form-select" multiple aria-label="multiple select example">
                      <option selected>Sélectionnez des commodités</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                </form>
            </div>
            <div class="col type-hebergement">
                <h3>Type d'hébergement</h3>
                <h4>Ajoutez un type d'hébergement</h4>
                <form>
                    <div class="form-group ad-types">
                        <label id="hebergement" for="hebergement" aria-label="Sélectionner un type d'hébergement"></label>
                        <select class="form-control" id="hebergement">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col type-beds">
                <h3>Literie</h3>
                <h4>Saisissez un types de lit</h4>
                <form>
                    <div class="form-group ad-types">
                        <label id="beds" for="beds" aria-label="Sélectionner un type d'hébergement"></label>
                        <select class="form-control" id="beds">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                    </div>
                </form>
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
