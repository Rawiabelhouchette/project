@extends('layout.app')

@section('reference', 'active')

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
</style>
@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb" style="text-align: left">
                <li><a href="#">Reférences</a></li>
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
            @include('admin.reference.menu')

        </div>

        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4 style="text-align: center;">Liste des Références </h4>
                        {{-- <a href="{{ route('references.create') }}" class="btn theme-btn">Ajouter Une Référence</a> --}}
                    </div>

                    <div class="card-body">

                        <div class="table-responsive" style="display: flex; flex-direction: column; height: 500px;">
                            <table id="example1" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th><span class="custom-checkbox"></span></th>
                                        <th>Type </th>
                                        <th>Noms de référence</th>
                                        <th>Valeur ajoutée </th>
                                        {{-- <th>Créateur </th> --}}
                                        <th>Date de création </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($reference_valeurs as $key => $reference_valeur)
                                        <tr>

                                            <td><span class="custom-checkbox"> {{ $key + 1 }} </span></td>

                                            <td> {{ $reference_valeur->reference->type }} </td>

                                            <td> {{ $reference_valeur->reference->nom }}</td>

                                            <td> {{ $reference_valeur->valeur }}</td>

                                            {{-- <td> {{($herbergement->createur)}}</td>       --}}
                                            <td>
                                                <span class="custom-checkbox">
                                                    {{ $reference_valeur->created_at }}
                                                </span>
                                            </td>

                                            <td>
                                                <a href="{{ route('references.edit', $reference_valeur->id) }}" class="edit" title="" data-id="{{ $reference_valeur->id }}" data-toggle="tooltip" data-original-title="edit">
                                                    <i class="fa fa-pencil"></i></a>
                                                {{-- <a href="#" data-type="{{ $reference_valeur->reference->type  }}" data-id="{{ $reference_valeur->id }}" 
                                                    data-nom="{{ $reference_valeur->reference->nom }}" data-valeur="{{ $reference_valeur->valeur }}"
                                                    id="delete-button" class="delete" title="" data-toggle="tooltip"
                                                    data-original-title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a> --}}
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

    <script src="{{ asset('custom/js/reference-list.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/intl.js"></script>

    <script>
        $(document).ready(function() {
            let headers = document.querySelectorAll("#example1 th");
            headers.forEach(header => {
                header.style.border = "1px solid black";
                header.style.backgroundColor = "lightblue";
            });


            var datatable = $('#example1').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "pageLength": 50,
                "lengthChange": true,
                "searching": true,
                "scrollCollapse": true,
                fixedHeader: {
                    header: true,
                    footer: true,
                    offsetTop: 5000
                },


                "oLanguage": {

                    "sProcessing": "Traitement en cours...",
                    "sSearch": "Rechercher&nbsp;:",
                    "sLengthMenu": "Afficher _MENU_ éléments",
                    "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix": "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Pr&eacute;c&eacute;dent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                    },

                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    }
                }

            });
        });
    </script>

@endsection
