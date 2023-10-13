@extends('layout.app')

@section('reference', 'active')

@section('content')
<div class="row bg-title" style="padding-top: 20px;">
    <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
        <ol class="breadcrumb" style="text-align: left;">
            <li><a href="#">Référence</a></li>
            <li class="active">Ajouter une Référence</li>
        </ol>
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
                    <h4>Créer une Référence</h4>
                </div>
                
                <div class="card-body">
                    <br>
                    <form class="form-horizontal" action="{{ route('references.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <label class="col-md-2 col-sm-3 required">Type </label>
                                    <div class="col-md-8 col-sm-9">
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="" selected disabled>Type de référence</option>
                                            <option value="Exemplaire">Exemplaire</option>
                                            <option value="Document">Document</option>
                                            <option value="Comptes">Comptes</option>
                                            <option value="Agenda">Agenda</option>
                                            <option value="Contact">Contact</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row form-group">
                                    <label class="col-md-2 col-sm-3 required">Nom </label>
                                    <div class="col-md-8 col-sm-9">
                                        <select class="form-control" name="nom" required id="nom">
                                            <option value="" selected disabled>Nom de référence </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="col-md-2"></div>
                                    <label class="col-md-2 col-sm-3 required">Valeur ajoutée </label>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="valeur" class="form-control" placeholder="Ajouter une valeur" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 text-right">
                                    <button type="submit" class="btn theme-btn" style="background-color: green; border-color: green; margin-right: 15px;">
                                        <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i> Enregistrer
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script src="{{ asset('custom/js/reference-add.js')}}"></script>

@endsection