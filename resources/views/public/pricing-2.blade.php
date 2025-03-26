@extends('layout.public.app')

@section('content')
    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/cinet_pay.png') }}) no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="title-content">
                <h1>Abonnement</h1>
                <div class="breadcrumbs">
                    <a href="{{ route(name: 'accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <a href="{{ route(name: 'pricing') }}">Tarif</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Créer une entreprise</span>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

    <section>
        <div class="container">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="package-box">
                    <div class="package-header">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <h3>{{ $offre->libelle }}</h3>
                    </div>
                    <div class="package-price" style="">
                        <h3 class="mrg-top-0" style="font-family: 'Poppins', sans-serif; font-size: 27px !important; color: #26354e; margin-bottom: .25em; ">{{ number_format($offre->prix, 0, ',', ' ') }} <sup style="font-size: 15px;">F CFA </sup><sub>/ {{ $offre->duree }} Mois</sub></h3>
                    </div>
                    <div class="package-info" style="font-family: 'Muli', sans-serif;">
                        <ul>
                            <li>3 Designs</li>
                            <li>3 PSD Designs</li>
                            <li>4 color Option</li>
                            <li>10GB Disk Space</li>
                            <li>Full Support</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="p-3">
                    <div class="wel-back">
                        <h2>Création d'une <span class="theme-cl">Entreprise</span></h2>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('abonnements.payement.check') }}" method="POST">
                        @csrf
                        <input type="hidden" name="offre_id" value="{{ $offre->id }}">

                        <div class="row p-2 px-4">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa fa-building theme-cl"></i></span>
                                    <input id="company" class="form-control" type="text" placeholder="Nom de votre entreprise" required name="nom_entreprise" value="{{ old('nom_entreprise') }}">
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa fa-phone theme-cl"></i></span>
                                    <input id="phone" class="form-control" type="text" placeholder="Numéro de téléphone (+228 xxxxxxxxxx)" required name="numero_telephone"  value="{{ old('numero_telephone') }}">
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa-brands fa-whatsapp theme-cl" style="font-size: 17px;"></i></span>
                                    <input id="whatsapp_phone" class="form-control" type="text" placeholder="Numéro whatsapp (+228 xxxxxxxxxx)" required name="numero_whatsapp" value="{{ old('numero_whatsapp') }}">
                                </div>
                            </div>
                        </div>

                        <div class="center mt-3">
                            <button id="signup" class="btn btn-midium theme-btn btn-radius width-200" type="submit">
                                <span style="display: inline-flex; align-items: center;">
                                    {{ __('Enregistrer') }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

{{-- @if ($withModal)
                        <div id="abonnement-{{ $offre->id }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content" style="padding-bottom: 10px;">
            
                                    <div class="modal-header">
                                        <h4 id="modalLabel2" class="modal-title">Création d'entreprise</h4>
                                        <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                                            <i class="ti-close"></i>
                                        </button>
                                    </div>
            
                                    <div class="modal-body padd-top-10">
            
                                        <div class="wel-back">
                                            <h3>Veuillez créer <span class="theme-cl">une entreprise !</span></h3>
                                        </div>
            
                                        <div class="form-group">
                                            <label>Nom de votre entreprise</label>
                                            <input type="text" name="nom_entreprise" class="form-control" placeholder="" required>
                                        </div>
            
                                        <div class="form-group">
                                            <label>Numéro de téléphone</label>
                                            <input type="text" name="numero_telephone" class="form-control telephone" data-country="Togo" placeholder="" required>
                                        </div>
            
                                        <div class="form-group">
                                            <label>Numéro de whatsapp</label>
                                            <input type="text" name="numero_whatsapp" class="form-control telephone" data-country="Togo" placeholder="" required>
                                        </div>
            
                                        <div class="center">
                                            <button id="login-btn" type="submit" class="btn btn-midium theme-btn btn-radius width-200"> Continuer </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif --}}
