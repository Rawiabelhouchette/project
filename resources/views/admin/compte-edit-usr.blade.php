@extends('layout.app')

@section('comptes', 'active')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('comptes.create') }}">Compte</a></li>
                <li class="active">Modifier un usager</li>
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
                        <h4>Modifier un compte usager</h4>
                    </div>

                    <div class="card-body">
                        <br>
                        <form class="form-horizontal" action="{{ route('usagers.update', $compte->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                {{-- Nom --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="required">Nom </label> <br>
                                            <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ $compte->user->nom }}" required>
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
                                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="{{ $compte->user->prenom }}" required>
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
                                            <select class="form-control" name="sexe" required>
                                                @if ($compte && $compte->sexe)
                                                    <option value="{{ $compte->sexe }}" selected>{{ $compte->sexe }}</option>
                                                @endif

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
                                            <input type="text" name="username" class="form-control" placeholder="Idenitifiant" value="{{ $compte->user->username }}" required>
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
                                            <select class="form-control" name="actif">
                                                <option value="{{ $compte->user->is_active }}" selected>
                                                    @if ($compte->user->is_active == 1)
                                                        OUI
                                                    @else
                                                        NON
                                                    @endif
                                                </option>
                                                <option value="1">OUI</option>
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
                                            <input type="text" name="pseudo" value="{{ $compte->usager->pseudo }}" class="form-control" placeholder="Pseudo">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Date de naissance --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Date de naissance </label> <br>
                                            <input type="date" name="date_naissance" class="form-control" value="{{ $compte->date_naissance }}" placeholder="Date de naissance">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>

                                {{-- Inscrit à --}}
                                <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="">Inscrit à </label> <br>
                                            <select class="form-control" name="inscrit_a">
                                                @if ($compte->usager && $compte->usager->inscrit_a)
                                                    <option value="{{ $compte->usager->inscrit_a }}" selected>{{ $compte->usager->ref_inscrit_a->valeur }}</option>
                                                @endif
                                                <option value="">Choisir ...</option>

                                                @if ($sites && $sites->reference_valeurs)
                                                    @foreach ($sites->reference_valeurs as $inscrit_a)
                                                        <option value="{{ $inscrit_a->id }}">{{ $inscrit_a->valeur }}</option>
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
                                            <label class="">Type de carte </label> <br>
                                            <select class="form-control" name="type_carte" id="type_carte">
                                                @if ($compte->usager && $compte->usager->type_carte)
                                                    <option value="{{ $compte->usager->type_carte }}" selected>{{ $compte->usager->ref_type_carte->valeur }}</option>
                                                @endif
                                                <option value="">Choisir ...</option>

                                                @if ($cartes && $cartes->reference_valeurs)
                                                    @foreach ($cartes->reference_valeurs as $type_carte)
                                                        <option value="{{ $type_carte->id }}">{{ $type_carte->valeur }}</option>
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
                                            <label class="">Groupe </label> <br>
                                            <select class="form-control" name="groupe" id="groupe">
                                                @if ($compte && $compte->groupe)
                                                    <option value="{{ $compte->groupe }}" selected>{{ $compte->ref_groupe->valeur }}</option>
                                                @endif
                                                <option value="">Choisir ...</option>

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
                                            <label class="">Classe </label> <br>
                                            <select class="form-control" name="classe">
                                                @if ($compte->usager && $compte->usager->classe)
                                                    <option value="{{ $compte->usager->classe }}" selected>{{ $compte->usager->ref_classe->valeur }}</option>
                                                @endif
                                                <option value="">Choisir ...</option>

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
                                            <label class="">Filière </label> <br>
                                            <select class="form-control" name="filiere">
                                                @if ($compte->usager && $compte->usager->filiere)
                                                    <option value="{{ $compte->usager->filiere }}" selected>{{ $compte->usager->ref_filiere->valeur }}</option>
                                                @endif
                                                <option value="">Choisir ...</option>

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
                                            <input type="text" name="telephone" value="{{ $compte->telephone }}" class="form-control" placeholder="Téléphone">
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
                                            <input type="text" name="adresse" value="{{ $compte->adresse }}" class="form-control" placeholder="Adresse">
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
                                            <input type="email" name="email" class="form-control" value="{{ $compte->user->email }}" placeholder="Email">
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
                                            <select class="form-control" name="ville">
                                                @if ($compte->ville)
                                                    <option value="{{ $compte->ville }}" selected>{{ $compte->ref_ville->valeur }}</option>
                                                @endif
                                                <option value="">Choisir ...</option>

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
                                            <textarea name="commentaire" class="form-control" placeholder="Commentaire">{{ $compte->commentaire }}</textarea>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>


                                <div class="form-group" style="margin-top: 15px;">
                                    <div class="col-md-12 col-sm-12 text-right">
                                        <button type="submit" class="btn theme-btn" style="background-color: green; border-color: green; margin-right: 30px;">
                                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i> Modifier
                                        </button>
                                    </div>
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

@endsection
