@extends('layout.app')

@section('comptes', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('comptes.create') }}">Compte</a></li>
                <li class="active">Ajouter un usager</li>
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
                        <h4>Créer un compte usager</h4>
                    </div>

                    <div class="card-body">
                        <br>
                        <form class="form-horizontal" action="{{ route('usagers.store') }}" method="post">
                            @csrf
                            <div class="row">

                                <input type="hidden" name="registration" value="admin">

                                {{-- Nom --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Nom </label> <br>
                                            <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Prénom --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Prénom </label> <br>
                                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Sexe --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Sexe </label> <br>
                                            <select class="form-control" name="sexe" id="type" required>
                                                <option value="" selected disabled>Choisir ...</option>
                                                @if ($sexes && $sexes->reference_valeurs)
                                                    @foreach ($sexes->reference_valeurs as $sexe)
                                                        <option value="{{ $sexe->valeur }}">{{ $sexe->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>


                                {{-- Nom d'utilisateur --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Identifiant </label> <br>
                                            <input type="text" name="username" class="form-control" placeholder="Idenitifiant" required>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Mot de passe --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Mot de passe </label> <br>
                                            <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Confirmer mot de passe --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Confirmer mot de passe </label> <br>
                                            <input type="password" id="confirmer_mot_de_passe" class="form-control" placeholder="Confirmer mot de passe" required>
                                            <p id="error_message" style="color: red;"></p>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Numéro de carte --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Nº de carte </label> <br>
                                            <input type="text" name="numero_carte" disabled class="form-control" placeholder="Numéro de carte">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Actif --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Actif </label> <br>
                                            <select class="form-control" name="actif" id="actif">
                                                <option value="1" selected>OUI</option>
                                                <option value="0">NON</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Pseudo --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Pseudo </label> <br>
                                            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Date de naissance --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Date de naissance </label> <br>
                                            <input type="date" name="date_naissance" class="form-control" placeholder="Date de naissance">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Inscrit à  --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Inscrit à </label> <br>
                                            <select class="form-control" name="inscrit_a">
                                                <option value="" selected disabled>Choisir ...</option>
                                                @if ($sites && $sites->reference_valeurs)
                                                    @foreach ($sites->reference_valeurs as $site)
                                                        <option value="{{ $site->id }}">{{ $site->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Type de carte --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Type de carte </label> <br>
                                            <select class="form-control" name="type_carte" id="type_carte">
                                                <option value="" selected disabled>Choisir ...</option>
                                                @if ($cartes && $cartes->reference_valeurs)
                                                    @foreach ($cartes->reference_valeurs as $carte)
                                                        <option value="{{ $carte->id }}">{{ $carte->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>


                                {{-- Groupe option --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Groupe </label> <br>
                                            <select class="form-control" name="groupe" id="groupe">
                                                <option value="" selected disabled>Choisir ...</option>
                                                @if ($groupes && $groupes->reference_valeurs)
                                                    @foreach ($groupes->reference_valeurs as $groupe)
                                                        <option value="{{ $groupe->id }}">{{ $groupe->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Classe --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Classe </label> <br>
                                            <select class="form-control" name="classe" id="type">
                                                <option selected disabled>Choisir ...</option>
                                                @if ($classes && $classes->reference_valeurs)
                                                    @foreach ($classes->reference_valeurs as $classe)
                                                        <option value="{{ $classe->id }}">{{ $classe->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Filière --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Filière </label> <br>
                                            <select class="form-control" name="filiere" id="type">
                                                <option selected disabled>Choisir ...</option>
                                                @if ($filieres && $filieres->reference_valeurs)
                                                    @foreach ($filieres->reference_valeurs as $filiere)
                                                        <option value="{{ $filiere->id }}">{{ $filiere->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Téléphone --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Téléphone </label> <br>
                                            <input type="text" name="telephone" class="form-control" placeholder="Téléphone">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Adresse --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Adresse </label> <br>
                                            <input type="text" name="adresse" class="form-control" placeholder="Adresse">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Email </label> <br>
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Ville option --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Ville </label> <br>
                                            <select class="form-control" name="ville" id="type">
                                                <option value="" selected disabled>Choisir ...</option>
                                                @if ($villes && $villes->reference_valeurs)
                                                    @foreach ($villes->reference_valeurs as $ville)
                                                        <option value="{{ $ville->id }}">{{ $ville->valeur }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>



                                {{-- Commentaire --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Commentaire </label> <br>
                                            <textarea name="commentaire" class="form-control" placeholder="Commentaire"></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Message --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Message </label> <br>
                                            <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="row" style="margin-top: 25px;">
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
    <script src="{{ asset('custom/js/compte-add-usr.js') }}"></script>
@endsection
