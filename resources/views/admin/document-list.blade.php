@extends('layout.app')

@section('catalogue', 'active')

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
                <li><a href="#">Document</a></li>
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
                    color: white; /* Couleur normale du texte */
                    background-color: transparent; /* Couleur normale de fond */
                    text-decoration: none; /* Désactiver la soulignement */
                }
            </style>
            {{-- <span id="token-value" data-token="{{ csrf_token() }}"></span> --}}
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header"  id="header-action">
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" href="javascript:void(0)">Exporter</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" href="{{ route('documents.create') }}">Créer un document</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" href="javascript:void(0)">Imprimer</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" id="disable-element" href="javascript:void(0)" >Désactiver</a>
                        </div>
                        <div class="col-md-2 col-xs-6 text-center">
                            <a class="link" id="delete-element" href="javascript:void(0)">Supprimer</a>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4 style="text-align: center;">Liste des documents </h4>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive" style="display: flex; flex-direction: column; height: 500px;">
                            <table id="example1" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            {{-- <input type="checkbox" id="chck-element-0">&nbsp;&nbsp; --}}
                                            <span class="custom-checkbox">ID</span></th>
                                        <th>Type</th>
                                        <th>Titre</th>
                                        <th>Fichier</th>
                                        <th>Sous-titre </th>
                                        <th>Auteur</th>
                                        <th>Pays de publication </th>
                                        <th>Année de publication</th>
                                        <th>Langue </th>
                                        {{-- <th>Nombre de page</th> --}}
                                        {{-- <th>Categorie</th> --}}
                                        {{-- <th>Directeur</th> --}}
                                        <th>URL</th>
                                        {{-- <th>Note</th> --}}
                                        <th>Diffusé</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="list-documents">
                                    @foreach ($documents as $key => $document)
                                        <tr id="tr-{{ $document->id }}">
                                            <td>
                                                <input type="checkbox" id="checkbox1" name="options[]" id="chk-element-{{ $document->id }}" class="chck-element" data-id="{{ $document->id }}">&nbsp;&nbsp;
                                                <span class="custom-checkbox" for="chk-element-{{ $document->id }}">{{ $document->id }}</span>
                                            </td>

                                            <td>
                                                {{ $document->type }}
                                            </td>

                                            <td>{{ $document->titre }}</td>

                                            <td>
                                                @if (count($document->fichiers) > 0)
                                                    <i class="fa fa-circle cl-success font-10 mrg-r-5"></i> Oui
                                                @else
                                                    <i class="fa fa-circle cl-danger font-10 mrg-r-5"></i> Non
                                                @endif
                                            </td>

                                            <td> {{ $document->sous_titre }} </td>

                                            <td> {{ $document->auteur }}</td>

                                            <td>
                                                @if ($document->ref_pays_publication)
                                                    {{ $document->ref_pays_publication->valeur }}
                                                @endif
                                            </td>

                                            <td> {{ $document->annee_publication }}</td>

                                            <td>
                                                @if ($document->ref_langue)
                                                    {{ $document->ref_langue->valeur }}
                                                @endif
                                            </td>

                                            {{-- <td> {{ $document->nbr_page }}</td> --}}

                                            {{-- <td> 
                                                @if ($document->ref_categorie)
                                                    {{ $document->ref_categorie->valeur }}
                                                @endif
                                            </td> --}}

                                            {{-- <td> {{ $document->directeur }}</td> --}}

                                            <td> {{ $document->url }}</td>

                                            {{-- <td> {{ $document->note }}</td> --}}
                                            <td>
                                                @if ($document->is_public)
                                                    <i id="ico-is-public-{{ $document->id }}" class="fa fa-circle cl-success font-10 mrg-r-5"> &nbsp;Oui</i> 
                                                @else
                                                    <i id="ico-is-public-{{ $document->id }}" class="fa fa-circle cl-danger font-10 mrg-r-5"> &nbsp; Non</i> 
                                                @endif
                                            </td>

                                            <td>
                                                @if ($document->memoire)
                                                    <a href="{{ route('memoires.edit', $document->id) }}" class="edit" title="" data-toggle="tooltip" data-original-title="edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('memoires.show', $document->id) }}" class="" title="Detail">
                                                        <i class="fa fa-eye" style="color: gray;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="delete" title="Supprimer" data-token="{{ csrf_token() }}" data-id="{{ $document->id }}" data-link="{{ route('memoires.destroy', $document->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @else
                                                    {{-- <a href="{{ route('usagers.edit', $document->id) }}" class="edit"
                                                        title="" data-toggle="tooltip" data-original-title="edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="deleterefer/{{ $document->id }}"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')"
                                                        id="delete-button" class="delete" title="" data-toggle="tooltip"
                                                        data-original-title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a> --}}
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

    <script src="{{ asset('custom/js/document-list.js') }}"></script>



@endsection
