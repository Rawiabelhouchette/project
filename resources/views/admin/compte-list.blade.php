@extends('layout.app')

@section('comptes', 'active')

@section('css')
    <style>
        #example1 tfoot {
            position: fixed;
            bottom: 0;
            width: 100%;
            max-height: 20vh;
            margin-top: calc(100vh - 20vh);
        }

        #example1 .dataTables_paginate {
            bottom: 5000px;
            position: fixed;
        }

        #example1 {
            border: 1px solid black;
        }

        #example1 td {
            border: 1px solid black;
        }

        #example1_filter {
            display: none;
        }
    </style>
@endsection


@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb" style="text-align: left">
                <li><a href="#">Comptes</a></li>
                <li class="active">Recherche </li>
            </ol>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <input type="text" width="90%" style="background-color: #ADD8E6; color: black;font-weight: bold;" class="form-control" id="recherche" placeholder="Saisir votre recherche ici" style="margin-left : 15px;" width="100%">
                    </div>
                </div>
            </div>
            <style>
                #header-action {
                    background-color: #EA4F0C;
                }

                .link {
                    color: white;
                    background-color: transparent;
                    font-weight: bold;
                    text-decoration: none;
                }

                a:visited {
                    color: white;
                    /* Couleur normale du texte */
                    background-color: transparent;
                    /* Couleur normale de fond */
                    text-decoration: none;
                    /* Désactiver la soulignement */
                }
            </style>
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header" id="header-action">
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" href="javascript:void(0)">Exporter</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" href="{{ route('comptes.create') }}">Créer un compte</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" href="javascript:void(0)">Imprimer</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" id="disable-element" href="javascript:void(0)">Désactiver</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" id="delete-element" href="javascript:void(0)">Supprimer</a>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 style="text-align: center;">Liste des comptes </h4>
                        {{-- <a href="{{ route('references.create') }}" class="btn theme-btn">Ajouter Une Référence</a> --}}
                    </div>

                    <div class="card-body">

                        <div class="table-responsive" style="display: flex; flex-direction: column; height: 500px;">
                            <table id="example1" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th><span class="custom-checkbox">ID</span></th>
                                        <th>Compte</th>
                                        <th>Nom </th>
                                        <th>Prénom</th>
                                        <th>Sexe </th>
                                        <th>Date de naissance</th>
                                        {{-- <th>Créateur </th> --}}
                                        <th>Identifiant</th>
                                        <th>Téléphone</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="list-documents">
                                    @foreach ($comptes as $key => $compte)
                                        <tr id="tr-{{ $compte->id }}">
                                            <td>
                                                <input type="checkbox" id="checkbox1" name="options[]" id="chk-element-{{ $compte->id }}" class="chck-element" data-id="{{ $compte->id }}">&nbsp;&nbsp;
                                                <span class="custom-checkbox"> {{ $compte->id }} </span>
                                            </td>

                                            <td>
                                                @if ($compte->professionnel)
                                                    Professionnel
                                                @else
                                                    Usager
                                                @endif
                                            </td>

                                            <td> {{ $compte->user->nom }} </td>

                                            <td> {{ $compte->user->prenom }}</td>

                                            <td> {{ $compte->sexe }}</td>

                                            <td> {{ date('d-m-Y', strtotime($compte->date_naissance)) }}</td>

                                            <td> {{ $compte->user->username }}</td>

                                            <td> {{ $compte->telephone }}</td>

                                            <td>
                                                @if ($compte->user->is_active == 1)
                                                    <i class="fa fa-circle cl-success font-10 mrg-r-5"></i> Actif
                                                @else
                                                    <i class="fa fa-circle cl-danger font-10 mrg-r-5"></i> Inactif
                                                @endif
                                            </td>

                                            <td>
                                                @if ($compte->professionnel)
                                                    <a href="{{ route('professionnels.edit', $compte->id) }}" class="edit" title="" data-toggle="tooltip" data-original-title="edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="{{ route('professionnels.show', $compte->id) }}" class="" title="Detail">
                                                        <i class="fa fa-eye" style="color: gray;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="delete" title="Supprimer" data-token="{{ csrf_token() }}" data-id="{{ $compte->id }}" data-link="{{ route('professionnels.destroy', $compte->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('usagers.edit', $compte->id) }}" class="edit" title="" data-toggle="tooltip" data-original-title="edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="{{ route('usagers.show', $compte->id) }}" class="" title="Detail">
                                                        <i class="fa fa-eye" style="color: gray;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="delete" title="Supprimer" data-token="{{ csrf_token() }}" data-id="{{ $compte->id }}" data-link="{{ route('usagers.destroy', $compte->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot style="flex-shrink: 0;">

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/intl.js"></script>

    <script src="{{ asset('custom/js/compte-list.js') }}"></script>

@endsection
