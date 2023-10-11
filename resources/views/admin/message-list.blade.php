@extends('layout.app')

@section('message', 'active')

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
                <li><a href="#">Message</a></li>
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
            {{-- <span id="token-value" data-token="{{ csrf_token() }}"></span> --}}
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    {{-- <div class="card-header"  id="header-action">
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
                    </div> --}}

                    {{-- <div class="card-header">
                        <h4 style="text-align: center;">Liste des messages </h4>
                    </div> --}}
                    <div class="card-header row">
                        <div class="col-md-6 text-left">
                            <h4>Liste des messages</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('staff.messages.create') }}" class="btn theme-btn" style="background-color: #EA4F0C;">
                                <i class="fa fa-plus"></i> 
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive" style="display: flex; flex-direction: column; height: 500px;">
                            <table id="example1" class="table table-striped table-2 table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            {{-- <input type="checkbox" id="chck-element-0">&nbsp;&nbsp; --}}
                                            <span class="custom-checkbox">ID</span>
                                        </th>
                                        <th>Utilisateur</th>
                                        <th>Email</th>
                                        <th>Motif</th>
                                        <th>Date d'envoi</th>
                                        <th>Lu</th>
                                        <th>Repondu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="list-messages">
                                    @foreach ($messages as $message)
                                        <tr>
                                            {{-- Id avec checkbox --}}
                                            <td>
                                                {{-- <input type="checkbox" id="chck-element-{{ $message->id }}"> --}}
                                                <span class="custom-checkbox">{{ $message->id }}</span>
                                            </td>
                                            <td>
                                                @if ($message->user_id == null)
                                                    {{ $message->nom }} {{ $message->prenom }}
                                                @else
                                                    {{ $message->user->nom }} {{ $message->user->prenom }}
                                                @endif
                                            </td>
                                            {{-- Afficher les 40 premiers caracteres du message --}}
                                            <td>
                                                @if ($message->user_id == null)
                                                    {{ $message->email }}
                                                @else
                                                    {{ $message->user->email }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($message->motif)
                                                    {{ $message->getMotif->valeur }}
                                                @else
                                                    {{ $message->autre_motif }}
                                                @endif
                                            </td>
                                            {{-- <td>{{ substr($message->message, 0, 40) }}...</td> --}}
                                            </td>
                                            <td>{{ $message->created_at }}</td>
                                            <td class="message-body">
                                                @if ($message->lu)
                                                    <h5><span class="pending">Lu</span></h5>
                                                @else
                                                    <h5><span class="unread">Non&nbsp;lu</span></h5>
                                                @endif
                                            </td>
                                            <td class="message-body">
                                                @if ($message->repondu)
                                                    <h5><span class="pending">Repondu</span></h5>
                                                @else
                                                    <h5><span class="unread">Non&nbsp;repondu</span></h5>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('staff.messages.show', $message->id) }}" class="" title="Detail">
                                                    <i class="fa fa-eye" style="color: gray;"></i>
                                                </a>
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
