@extends('layout.public.template')


    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-1.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Restaurant</h1>
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

@section('page-content')
<div class="page-name restaurant row">
    <div class="container text-left">
      <div class="row align-items-start">
        <div class="col entreprise">
            <h3>Mon entreprise</h3>
            <h4>Saisissez les entreprise du lieu</h4>
            <div class="form-group">
                <div>
                    <button class="btn btn-form" type="button" data-bs-toggle="offcanvas" data-bs-target="#entreprise" aria-controls="entreprise-1">Mon entreprise<i class="fa fa-pencil"></i></button>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="entreprise" aria-labelledby="entreprise">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="entreprise-1">Mon entreprise</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <form>
                     
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Nom
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Téléphone
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control telephone">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Email
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="email" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <label class="">Description
                            {{-- <b style="color: red; font-size: 100%;">*</b> --}}
                        </label> <br>
                        <textarea class="form-control height-100"></textarea>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Whatsapp
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input type="text" class="form-control telephone" id="telephone">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Facebook
                                </label> <br>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
       
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Instagram
                                </label> <br>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                   
                   
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Site web
                                </label> <br>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Longitude
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input id="longitude" type="text" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                   
                    <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="">Latitude
                                    <b style="color: red; font-size: 100%;">*</b>
                                </label> <br>
                                <input id="latitude" type="text" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12" style="margin-top: 10px; padding-left: 40px;padding-right: 40px;">
                        <div id="map" style="width: 100%; height: 400px; z-index: 1;"></div>
                    </div>
                </div>

                <br>
                <h5 class="text-center">
                    <label class="">Heure d'ouverture et de fermeture</label>
                </h5>
                <br>
                    <div class="form-group">
                        <textarea class="form-control" id="description" rows="3"></textarea>
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
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
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
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    
    <div class="container text-left">
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
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
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
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
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
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>

          </div>
        </div>
    </div>
</div>


@endsection
