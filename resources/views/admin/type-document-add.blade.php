@extends('layout.app')

@section('catalogue', 'active')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('documents.create') }}">Document</a></li>
                <li class="active">Ajouter un type de memoire</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="tab style-1" role="tabpanel">


            <!-- Tab panes -->

            <form class="form-horizontal" id="addForm" action="{{ route('type-documents.store') }}" method="post">
                <div class="row bott-wid">
                    @csrf
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            
                            <div class="card-header">
                                <h4>Créer un type de document</h4>
                            </div>

                            <div class="card-body" id="ligns">
                                <div class="row">

                                    <div class="col-md-4 col-sm-4 col-xl-4" style="margin-top: 15px;">
                                        <label class="required">Nom du type de mémoire</label> <br>
                                        <input type="text" class="form-control" name="libelle" required>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <button class="btn theme-btn mrg-top-30" type="button" id="add-lign">
                                            <i class="fa fa-plus fa-lg"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                        <label for="">Nombre de colonne</label> <br>
                                        <input type="number" class="form-control" name="lign_count" id="lign_count" min="3" value="3" disabled>
                                    </div>


                                </div>

                                {{-- Auteur --}}
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label class="">Type de colonne </label> <br>
                                        <select class="form-control select2" disabled required>
                                            <option value="">Sélectionner</option>
                                            <option value="int">Entier</option>
                                            <option value="string" selected>Chaîne</option>
                                            <option value="boolean">Booléen</option>
                                            <option value="float">Flottant</option>
                                            <option value="text">Texte</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                        <label class="">Nom de colonne</label> <br>
                                        <input type="text" class="form-control" value="Auteur" disabled required>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label class="required">Obligatoire ?</label>
                                        <select class="form-control select2" disabled required>
                                            <option value="1" selected>Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label>Minimum</label>
                                        <input type="number" class="form-control" value="3" value="" disabled>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label>Maximum</label>
                                        <input type="number" class="form-control" value="" disabled>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label class="required">Type de colonne </label> <br>
                                        <select class="form-control select2" disabled required>
                                            <option value="">Sélectionner</option>
                                            <option value="int">Entier</option>
                                            <option value="string" selected>Chaîne</option>
                                            <option value="boolean">Booléen</option>
                                            <option value="float">Flottant</option>
                                            <option value="text">Texte</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                        <label class="required">Nom de colonne</label> <br>
                                        <input type="text" class="form-control" value="Titre" disabled required>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label class="required">Obligatoire ?</label>
                                        <select class="form-control select2" disabled required>
                                            <option value="1" selected>Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label>Minimum</label>
                                        <input type="number" class="form-control" value="3" disabled>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label>Maximum</label>
                                        <input type="number" class="form-control" value="" disabled>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label class="required">Type de colonne </label> <br>
                                        <select class="form-control select2" name="type_colonne[]" required>
                                            <option value="">Sélectionner</option>
                                            <option value="int">Entier</option>
                                            <option value="string">Chaîne</option>
                                            <option value="boolean">Booléen</option>
                                            <option value="float">Flottant</option>
                                            <option value="text">Texte</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                        <label class="required">Nom de colonne</label> <br>
                                        <input type="text" class="form-control" name="colonne[]" required>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label class="required">Obligatoire ?</label>
                                        <select class="form-control select2" name="is_required[]" required>
                                            <option value="1" selected>Oui</option>
                                            <option value="0">Non</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label>Minimum</label>
                                        <input type="number" class="form-control" name="min[]" value="">
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                                        <label>Maximum</label>
                                        <input type="number" class="form-control" name="max[]" value="">
                                    </div>

                                    <div class="col-md-1 col-sm-1 col-xl-1" style="margin-top: 15px;">
                                        <button class="btn theme-btn remove-lign mrg-top-30" type="button" style="background-color: transparent; border-color: transparent;">
                                            <i class="fa fa-minus fa-lg" style="color: red;"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="text-right" style="margin-bottom: 30px;">
                    <button type="submit" class="btn theme-btn" style="background-color: green; border-color: green; margin-right: 15px;">
                        <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i>
                        Enregistrer
                    </button>
                </div>
            </form>



        </div>

    </div>



    </div>
@endsection

@section('js')

    <script src="{{ asset('custom/js/document-add-memoire.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            var lign_counter = 3;
            $('#add-lign').click(function() {
                lign_counter++;
                $('#lign_count').val(lign_counter);
                var ligne = `
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                            <label class="required">Type de colonne </label> <b style="color: red; font-size: 100%;">*</b> <br>
                            <select class="form-control select2" name="type_colonne[]" required>
                                <option value="">Sélectionner</option>
                                <option value="int">Entier</option>
                                <option value="string">Chaîne</option>
                                <option value="boolean">Booléen</option>
                                <option value="float">Flottant</option>
                                <option value="text">Texte</option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                            <label class="required">Nom de colonne</label><b style="color: red; font-size: 100%;">*</b> <br>
                            <input type="text" class="form-control" name="colonne[]" required>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                            <label class="required">Obligatoire ?</label> <b style="color: red; font-size: 100%;">*</b>
                            <select class="form-control select2" name="is_required[]" required>
                                <option value="1" selected>Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                            <label>Minimum</label>
                            <input type="number" class="form-control" name="min[]" value="">
                        </div>

                        <div class="col-md-2 col-sm-2 col-xl-2" style="margin-top: 15px;">
                            <label>Maximum</label>
                            <input type="number" class="form-control" name="max[]" value="">
                        </div>

                        <div class="col-md-1 col-sm-1 col-xl-1" style="margin-top: 15px;">
                            <button class="btn theme-btn remove-lign mrg-top-30" type="button" style="background-color: transparent; border-color: transparent;">
                                <i class="fa fa-minus fa-lg" style="color: red;"></i>
                            </button>
                        </div>

                    </div>
                `;
                // Append after $('#ligns')
                $('#ligns').append(ligne);
            });


            $(document).on('click', '.remove-lign', function() {
                console.log('ok');
                $(this).parent().parent().remove();
                lign_counter--;
                $('#lign_count').val(lign_counter);
            });

            $('#addForm').on('submit', function(e) {
                // check if lign_counter is greater than 3
                var lign_counter = $('#lign_count').val();
                if (lign_counter < 3) {
                    e.preventDefault();
                    alert('Vous devez ajouter au moins 1 colonne de plus');
                    return;
                }
                $(this).submit();
            });
        });
    </script>

@endsection
