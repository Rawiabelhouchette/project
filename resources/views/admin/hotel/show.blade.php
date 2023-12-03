@extends('layout.app')

@section('annonce', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('annonces.index') }}">Annonce</a></li>
                <li>Hôtel</li>
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
                        <h4>Détails de l'hôtel</h4>
                        <a href="{{ route('hotels.edit', $hotel->id) }}" type="button" class="btn theme-btn text-right">
                            <i class="fa fa-edit fa-lg" style=""></i>
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                <tbody>
                                    {{-- Entreprise --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Entreprise</td>
                                        <td>
                                            <a class="text-success" href="{{ route('entreprises.show', $hotel->annonce->entreprise->id) }}">
                                                {{ $hotel->annonce->entreprise->nom }}
                                            </a>
                                        </td>
                                    </tr>

                                    {{-- Titre --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Titre</td>
                                        <td>{{ $hotel->annonce->titre }}</td>
                                    </tr>

                                    {{-- Description --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Description</td>
                                        <td>{{ $hotel->annonce->description }}</td>
                                    </tr>

                                    {{-- is_Active --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Statut</td>
                                        <td>
                                            @if ($hotel->annonce->is_active)
                                                <span class="label label-success">Activé</span>
                                            @else
                                                <span class="label label-danger">Désactivé</span>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Date de validite --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Date de validité</td>
                                        <td>{{ $hotel->annonce->date_validite }} | {{ $hotel->annonce->jour_restant }} jour(s) restant(s)</td>

                                        </td>
                                    </tr>

                                    {{-- Nombre de chambre --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de chambre</td>
                                        <td>{{ $hotel->nombre_chambre }}</td>
                                    </tr>

                                    {{-- Nombre de personne --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Nombre de personne</td>
                                        <td>{{ $hotel->nombre_personne }}</td>
                                    </tr>

                                    {{-- Superficie --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Superficie</td>
                                        <td>{{ $hotel->superficie }}</td>
                                    </tr>

                                    {{-- Prix minimum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix minimum</td>
                                        <td>{{ $hotel->prix_min }}</td>
                                    </tr>

                                    {{-- Prix maximum --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Prix maximum</td>
                                        <td>{{ $hotel->prix_max }}</td>
                                    </tr>

                                    {{-- Type hebergement --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Type d'hébergement</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->types_hebergement as $type)
                                                    <li>{{ $type->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- Type lit --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Type de lit</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->types_lit as $type)
                                                    <li>{{ $type->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- commodiites --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Commodités</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->commodites as $commodite)
                                                    <li>{{ $commodite->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- services --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Services</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->services as $service)
                                                    <li>{{ $service->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- Equipement d'hebergement --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Equipement d'hébergement</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->equipements_hebergement as $equipement)
                                                    <li>{{ $equipement->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- Equipement de salle de bain --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Equipement de salle de bain</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->equipements_salle_bain as $equipement)
                                                    <li>{{ $equipement->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- Equipe de cuisine --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%">Equipement de cuisine</td>
                                        <td>
                                            <ul>
                                                @foreach ($hotel->equipements_cuisine as $equipement)
                                                    <li>{{ $equipement->valeur }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>

                                    {{-- Galerie --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="30%" colspan="2">Galerie</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <div class="text-center">
                                                @foreach ($hotel->annonce->galerie as $image)
                                                    <img src="{{ asset('storage/' . $image->chemin) }}" alt="Image Preview" class="img-fluid" style="width: 200px; height: 150px; margin-top: 10px; margin-right: 10px;">
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bott-wid">

            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Prévisualisation de l'annonce</h4>
                    </div>
                </div>
            </div>

            <!-- Single Listing -->
            <div class="col-md-4 col-sm-6">
                <div class="listing-shot grid-style">
                    <a href="listing-detail.html">
                        <div class="listing-shot-img">
                            <img src="http://via.placeholder.com/800x600" class="img-responsive" alt="">
                            <span class="like-listing"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </div>
                        <div class="listing-shot-caption">
                            <h4>Art &amp; Design</h4>
                            <p class="listing-location">Bishop Avenue, New York</p>
                        </div>
                    </a>
                    <div class="listing-shot-info">
                        <div class="row extra">
                            <div class="col-md-12">
                                <div class="listing-detail-info">
                                    <span><i class="fa fa-phone" aria-hidden="true"></i> 807-502-5867</span>
                                    <span><i class="fa fa-globe" aria-hidden="true"></i> www.mysitelink.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listing-shot-info rating">
                        <div class="row extra">
                            <div class="col-md-7 col-sm-7 col-xs-6">
                                <i class="color fa fa-star" aria-hidden="true"></i>
                                <i class="color fa fa-star" aria-hidden="true"></i>
                                <i class="color fa fa-star" aria-hidden="true"></i>
                                <i class="color fa fa-star-half-o" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-6 pull-right">
                                <a href="#" class="detail-link">Open Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
