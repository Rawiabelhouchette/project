@extends('layout.admin.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Restaurant</li>
                <li class="active">Détails</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Détails du restaurant</h4>
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>

                                    @include('admin.annonce.annonce-component', ['annonce' => $restaurant->annonce])

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Entrée</td>
                                        <td>
                                            <span style="font-weight: bold;"> Nom : </span> {{ $restaurant->e_nom }} <br>
                                            <span style="font-weight: bold;"> Ingredients : </span> {{ $restaurant->e_ingredients }} <br>
                                            <span style="font-weight: bold;"> Prix minimum : </span> {{ $restaurant->e_prix_min }} <br>
                                            <span style="font-weight: bold;"> Prix maximum : </span> {{ $restaurant->e_prix_max }} 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Plat</td>
                                        <td>
                                            <span style="font-weight: bold;"> Nom : </span> {{ $restaurant->p_nom }} <br>
                                            <span style="font-weight: bold;"> Ingredients : </span> {{ $restaurant->p_ingredients }} <br>
                                            <span style="font-weight: bold;"> Prix minimum : </span> {{ $restaurant->p_prix_min }} <br>
                                            <span style="font-weight: bold;"> Prix maximum : </span> {{ $restaurant->p_prix_max }} 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Dessert</td>
                                        <td>
                                            <span style="font-weight: bold;"> Nom : </span> {{ $restaurant->d_nom }} <br>
                                            <span style="font-weight: bold;"> Ingredients : </span> {{ $restaurant->d_ingredients }} <br>
                                            <span style="font-weight: bold;"> Prix minimum : </span> {{ $restaurant->d_prix_min }} <br>
                                            <span style="font-weight: bold;"> Prix maximum : </span> {{ $restaurant->d_prix_max }} 
                                        </td>
                                    </tr>

                                    @include('admin.annonce.reference-component', ['annonce' => $restaurant->annonce])

                                    @include('admin.annonce.galery-component', ['annonce' => $restaurant->annonce])

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.annonce.preview-component', ['annonce' => $restaurant->annonce])

    </div>
@endsection
