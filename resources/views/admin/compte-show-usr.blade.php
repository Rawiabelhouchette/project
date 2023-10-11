@extends('layout.app')

@section('comptes', 'active')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            overflow-x: hidden;
        }
    </style>

@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('comptes.create') }}">Compte</a></li>
                <li class="active">Détail d'un compte usager</li>
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
                        <h4>Informations</h4>
                        <a href="{{ route('usagers.edit', $compte->id) }}" type="button" class="btn theme-btn text-right" style="background-color: #EA4F0C;">
                            <i class="fa fa-edit fa-lg" style="margin-right: 10px;"></i> Modifier
                        </a>
                    </div>

                    <div class="card-body" style="background-color: white;">
                        <div class="table-responsive">
                            <table class="table table-striped table-2 table-hover">
                                {{-- <thead>
												<tr>
													<th>ID</th>						
													<th>Title</th>
													<th>Parent</th>
													<th>Status</th>
													<th>Listing</th>
													<th>Create Date</th>
													<th>Action</th>
												</tr>
											</thead> --}}
                                <tbody>

                                    {{-- Nom --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">NOM</td>
                                        <td>{{ $compte->user->nom }}</td>
                                    </tr>

                                    {{-- Prénom --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">PRENOM(S)</td>
                                        <td>{{ $compte->user->prenom }}</td>
                                    </tr>

                                    {{-- Sexe --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">SEXE</td>
                                        <td>
                                            @if ($compte->user)
                                                {{ $compte->sexe }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Username --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">IDENTIFIANT</td>
                                        <td>{{ $compte->user->username }}</td>
                                    </tr>

                                    {{-- Numero de carte : dans usager --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">NUMERO DE CARTE</td>
                                        <td>
                                            @if ($compte->usager)
                                                {{ $compte->usager->numero_carte }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Is active : label : actif --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">ACTIF</td>
                                        <td>
                                            @if ($compte->user->is_active == 1)
                                                <i class="fa fa-circle cl-success font-10 mrg-r-5"></i> Oui
                                            @else
                                                <i class="fa fa-circle cl-danger font-10 mrg-r-5"></i> Non
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Pseudo dans usager --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">PSEUDO</td>
                                        <td>
                                            @if ($compte->usager)
                                                {{ $compte->usager->pseudo }}
                                            @endif
                                        </td>
                                    </tr>


                                    {{-- Date naissance : label : Date de naissance : format : d-m-Y --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">DATE DE NAISSANCE</td>
                                        <td>
                                            @if ($compte->date_naissance)
                                                {{ date('d-m-Y', strtotime($compte->date_naissance)) }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Rattache a : in USager -> inscrit_a -> valeur --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">INSCRIT A</td>
                                        <td>
                                            @if ($compte->usager && $compte->usager->inscrit_a)
                                                {{ $compte->usager->ref_inscrit_a->valeur }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Type de carte dans usager --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">TYPE DE CARTE</td>
                                        <td>
                                            @if ($compte->usager && $compte->usager->type_carte)
                                                {{ $compte->usager->ref_type_carte->valeur }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Groupe --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">GROUPE</td>
                                        <td>
                                            @if ($compte->ref_groupe)
                                                {{ $compte->ref_groupe->valeur }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Classe dans usager --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">CLASSE</td>
                                        <td>
                                            @if ($compte->usager && $compte->usager->classe)
                                                {{ $compte->usager->ref_classe->valeur }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- FIliere dans usager --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">FILIERE</td>
                                        <td>
                                            @if ($compte->usager && $compte->usager->filiere)
                                                {{ $compte->usager->ref_filiere->valeur }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Telephone --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">TELEPHONE</td>
                                        <td>
                                            @if ($compte->telephone)
                                                {{ $compte->telephone }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Adresse --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">ADRESSE</td>
                                        <td>
                                            @if ($compte->adresse)
                                                {{ $compte->adresse }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Email --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">EMAIL</td>
                                        <td>
                                            @if ($compte->user->email)
                                                {{ $compte->user->email }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Ville --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">VILLE</td>
                                        <td>
                                            @if ($compte->ville)
                                                {{ $compte->ref_ville->valeur }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Commentaire --}}
                                    <tr>
                                        <td class="" style="font-weight: bold;" width="30%">COMMENTAIRE</td>
                                        <td>
                                            @if ($compte->commentaire)
                                                {{ $compte->commentaire }}
                                            @endif
                                        </td>
                                    </tr>




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(compte).ready(function() {
            $(".link").click(function() {
                var pdfUrl = $(this).data('chemin');
                $("#pdf-container").html('<embed src="' + pdfUrl +
                    '#toolbar=1&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />'
                    );
            });
        });
    </script>

@endsection
