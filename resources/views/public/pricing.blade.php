@extends('layout.public.app')

@section('content')
    <section class="title-transparent page-title" style="background:url(http://via.placeholder.com/1920x850);">
        <div class="container">
            <div class="title-content">
                <h1>Abonnement</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Tarif</span>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

    <section>
        <div class="container">
            {{-- display errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach ($offres as $offre)
                <div class="col-md-4 col-sm-4">
                    <form action="{{ route('abonnements.store') }}" method="POST">
                        @csrf
                        <div class="package-box">
                            <div class="package-header">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <h3>{{ $offre->libelle }}</h3>
                            </div>
                            <div class="package-price">
                                <h3 class="">{{ number_format($offre->prix, 0, ',', ' ') }} <sup style="font-size: 15px;">F CFA </sup><sub>/ {{ $offre->duree }} Mois</sub></h3>
                            </div>
                            <div class="package-info">
                                <ul>
                                    <li>3 Designs</li>
                                    <li>3 PSD Designs</li>
                                    <li>4 color Option</li>
                                    <li>10GB Disk Space</li>
                                    <li>Full Support</li>
                                </ul>
                            </div>
                            <input type="hidden" name="offer_id" value="{{ $offre->id }}">
                            <button type="button" data-toggle="modal" data-target="#abonnement-{{ $offre->id }}" class="btn btn-package">Souscrire</button>
                        </div>

                        <div class="modal fade in" id="abonnement-{{ $offre->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modalLabel2">Création d'entreprise</h4>
                                        <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                                            <i class="ti-close"></i>
                                        </button>
                                    </div>

                                    <div class="modal-body padd-top-10">

                                        <div class="wel-back">
                                            <h3>Veuillez créer <span class="theme-cl">une entreprise !</span></h3>
                                        </div>

                                        <div class="form-group">
                                            <label>Nom de l'entreprise</label>
                                            <input type="text" name="nom_entreprise" class="form-control" placeholder="" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Numéro de téléphone</label>
                                            <input type="text" name="numero_telephone" class="form-control" placeholder="" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Numéro de whatsapp</label>
                                            <input type="text" name="numero_whatsapp" class="form-control" placeholder="" required>
                                        </div>

                                        <div class="center">
                                            <button type="submit" id="login-btn" class="btn btn-midium theme-btn btn-radius width-200"> Continuer </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
