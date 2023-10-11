@extends('layout.app')

@section('catalogue', 'active')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            overflow-x: hidden;
        }
    </style>


    <style>
        .image-container {
            width: 150px;
            height: 150px;
        }

        .image-container img {
            width: 150px;
            height: 150px;
        }

        .options {
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 150px;
            margin-left: 15px;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            box-sizing: border-box;
            transition: opacity 0.2s ease-in-out;
        }

        .options button {
            margin: 0 10px;
            padding: 5px 10px;
            font-size: 14px;
            color: #fff;
            background-color: #333;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .options a {
            color: white;
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>


@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="{{ route('documents.create') }}">Document</a></li>
                <li class="active">Modifier un mémoire</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="tab style-1" role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#document-side" aria-controls="document-side" role="tab" data-toggle="tab">
                        <h4>Mémoire</h4>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#fichier-side" aria-controls="fichier-side" role="tab" data-toggle="tab">
                        <h4>Fichier associé</h4>
                    </a>
                </li>
            </ul>


            <form class="form-horizontal" action="{{ route('memoires.update', $document->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                @method('PUT')

                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="document-side">
                        <div class="row bott-wid">
                            <div class="col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">

                                            {{-- Titre --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="required">Titre </label> <br>
                                                        <textarea class="form-control" name="titre" id="titre" rows="5" required>{{ $document->titre }}</textarea>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>

                                            {{-- Sous-Titre --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Sous-titre </label> <br>
                                                        <textarea class="form-control" name="sous_titre" id="titre" rows="5">{{ $document->sous_titre }}</textarea>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 col-sm-1 col-xl-1" style="margin-top: 15px;">
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xl-3" style="margin-top: 15px;">
                                                <br>

                                                <div class="image-container">
                                                    <img id="image-show" style="display: none;" src="">

                                                    @if ($document->image != null)
                                                        <img id="image-default" src="{{ asset($document->image->chemin) }}" alt="Aperçu de l'image" data-link="{{ asset($document->image->chemin) }}">
                                                        <img id="image-default-0" data-validation="1" data-link="{{ asset('custom/img/file.png') }}" style="display: none;" src="{{ asset('custom/img/file.png') }}" alt="Example Image">
                                                    @else
                                                        <img id="image-default" data-validation="0" data-link="{{ asset('custom/img/file.png') }}" src="{{ asset('custom/img/file.png') }}" alt="Example Image">
                                                        <img id="image-default-0" data-link="{{ asset('custom/img/file.png') }}" style="display: none;" src="{{ asset('custom/img/file.png') }}" alt="Example Image">
                                                    @endif
                                                    <div class="options">
                                                        <a href="javascript:void(0)" id="btn-edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" id="btn-show">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" id="btn-delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>

                                                        {{-- <a href="javascript:void(0)">
                                                            <i class="fas fa-sync" id="btn-reset"></i>
                                                        </a> --}}
                                                    </div>
                                                </div>
                                                <input type="file" name="image" id="photo" style="display: none;" accept="image/*">
                                            </div>

                                        </div>

                                        <div class="row">


                                            {{-- Auteur --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="required">Auteur </label> <br>
                                                        <input type="text" class="form-control" value="{{ $document->auteur }}" name="auteur" id="auteur" required>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>

                                            {{-- Fonction auteur --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Fonction auteur </label> <br>
                                                        <input type="text" class="form-control" value="{{ $document->memoire->fonction_auteur }}" name="fonction_auteur" id="fonction_auteur">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>

                                            {{-- Pays de publication : un input --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Pays de publication</label> <br>
                                                        <select class="form-control" name="pays_publication" id="pays_publication">
                                                            @php $selectedOption = $document && $document->pays_publication ? $document->pays_publication : ''; @endphp
                                                            <option value="">Choisir ...</option>
                                                            @foreach ($pays_publications->reference_valeurs as $pays_publication)
                                                                <option value="{{ $pays_publication->id }}" {{ $selectedOption == $pays_publication->id ? 'selected' : '' }}>
                                                                    {{ $pays_publication->valeur }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>


                                            {{-- Niveau d'etude --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Niveau d'étude </label> <br>
                                                        <select class="form-control" name="niveau_etude" id="niveau_etude">
                                                            @if ($document->memoire && $document->memoire->niveau_etude)
                                                                <option value="{{ $document->memoire->niveau_etude }}" selected>
                                                                    {{ $document->memoire->ref_niveau_etude->valeur }}
                                                                </option>
                                                            @endif
                                                            <option value="">Choisir ...</option>

                                                            @if ($niveau_etudes && $niveau_etudes->reference_valeurs)
                                                                @foreach ($niveau_etudes->reference_valeurs as $niveau_etude)
                                                                    <option value="{{ $niveau_etude->id }}">
                                                                        {{ $niveau_etude->valeur }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>


                                            {{-- Institut --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Institut </label> <br>
                                                        <select class="form-control" name="institut" id="institut">
                                                            @if ($document->memoire && $document->memoire->institut)
                                                                <option value="{{ $document->memoire->institut }}" selected>{{ $document->memoire->ref_institut->valeur }}
                                                                </option>
                                                            @endif
                                                            <option value="">Choisir ...</option>
                                                            @if ($instituts && $instituts->reference_valeurs)
                                                                @foreach ($instituts->reference_valeurs as $niveau_etude)
                                                                    <option value="{{ $niveau_etude->id }}">
                                                                        {{ $niveau_etude->valeur }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>




                                            {{-- Date de soutenance --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Date de soutenance </label> <br>
                                                        <input type="date" class="form-control" value="{{ $document->memoire->date_soutenance }}" name="date_soutenance" id="date_soutenance">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>


                                            {{-- Année de publication --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Année de publication </label> <br>
                                                        <input type="number" class="form-control" value="{{ $document->annee_publication }}" name="annee_publication" min="1800" max="2025" id="annee_publication">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>


                                            {{-- Directeur de mémoire --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Directeur de mémoire </label> <br>
                                                        <input type="text" class="form-control" value="{{ $document->directeur }}" name="directeur_memoire" id="directeur_memoire">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>


                                            {{-- Langue du document --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Langue du document </label> <br>
                                                        <select class="form-control" name="langue_document" id="langue_document">
                                                            @if ($document && $document->langue)
                                                                <option value="{{ $document->langue }}" selected>
                                                                    {{ $document->ref_langue->valeur }}</option>
                                                            @endif
                                                            <option value="">Choisir ...</option>
                                                            @if ($langues)
                                                                @foreach ($langues->reference_valeurs as $langue)
                                                                    <option value="{{ $langue->id }}">
                                                                        {{ $langue->valeur }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">


                                            {{-- Code --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Code </label> <br>
                                                        <input type="text" class="form-control" value="{{ $document->code }}" name="code" id="code">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>


                                            {{-- url --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Url </label><br>
                                                        <input type="text" class="form-control" value="{{ $document->url }}" name="url" id="url">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>

                                            {{-- Note --}}
                                            {{-- <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Note </label> <br>
                                                        <input type="number" class="form-control" value="{{ $document->note }}" min="0" max="20" name="note" id="note">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div> --}}


                                            {{-- Sujet : option --}}
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Sujet </label> <br>
                                                        <select class="js-example-basic-multiple-single form-control" multiple name="sujets[]" id="sujet">
                                                            @if ($sujets && $sujets->reference_valeurs)
                                                                @foreach ($sujets->reference_valeurs as $sujet)
                                                                    @php $isSelected = false; @endphp
                                                                    @if ($document && $document->ref_sujet)
                                                                        @foreach ($document->ref_sujet as $sujet_document)
                                                                            @if ($sujet_document->sujet_id == $sujet->id)
                                                                                <option value="{{ $sujet->id }}" selected>{{ $sujet->valeur }}</option>
                                                                                @php $isSelected = true; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                @if (!$isSelected)
                                                                    <option value="{{ $sujet->id }}">
                                                                        {{ $sujet->valeur }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Theme --}}
                                        {{-- <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Thème </label> <br>
                                                        <select class="form-control" name="theme" id="theme">
                                                            @if ($document && $document->theme)
                                                                <option value="{{ $document->theme }}" selected>{{ $document->ref_theme->valeur }}</option>
                                                            @endif
                                                            <option value="">Choisir ...</option>
                                                            @if ($themes && $themes->reference_valeurs)
                                                                @foreach ($themes->reference_valeurs as $theme)
                                                                    <option value="{{ $theme->id }}">{{ $theme->valeur }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>
             --}}

                                        {{-- Domaine de formation : input --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Domaine de formation </label> <br>
                                                    <input type="text" class="form-control" value="{{ $document->memoire->domaine_formation }}" name="domaine_formation" id="domaine_formation">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- Specialite : input text --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Spécialité </label> <br>
                                                    <input type="text" class="form-control" value="{{ $document->memoire->specialite }}" name="specialite" id="specialite">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- Type de mémoire --}}
                                        {{-- <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Type de mémoire </label> <br>
                                                        <select class="form-control" name="type_memoire" id="type_memoire">
                                                            @if ($document->memoire && $document->memoire->type_memoire)
                                                                <option value="{{ $document->memoire->type_memoire }}" selected>{{ $document->memoire->ref_type_memoire->valeur }}</option>
                                                            @endif
                                                            <option value="">Choisir ...</option>
                                                            @if ($type_memoires && $type_memoires->reference_valeurs)
                                                                @foreach ($type_memoires->reference_valeurs as $type_memoire)
                                                                    <option value="{{ $type_memoire->id }}">{{ $type_memoire->valeur }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div> --}}


                                        {{-- Filière --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Filière </label> <br>
                                                    <select class="form-control" name="filiere" id="filiere">
                                                        @if ($document->memoire && $document->memoire->filiere)
                                                            <option value="{{ $document->memoire->filiere }}" selected>{{ $document->memoire->ref_filiere->valeur }}
                                                            </option>
                                                        @endif
                                                        <option value="">Choisir ...</option>
                                                        @if ($filieres && $filieres->reference_valeurs)
                                                            @foreach ($filieres->reference_valeurs as $filiere)
                                                                <option value="{{ $filiere->id }}">
                                                                    {{ $filiere->valeur }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- Nombre de page --}}
                                        {{-- <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Nombre de page </label> <br>
                                                        <input type="number" class="form-control" value="{{ $document->nbr_page }}" min="1" name="nbr_page" id="nbr_page">
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div> --}}


                                        {{-- Autorisation : input text --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Autorisation </label> <br>
                                                    <input type="text" class="form-control" value="{{ $document->autorisation }}" name="autorisation" id="autorisation">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- MOt cle --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Mot clé </label> <br>
                                                    <input type="text" class="form-control" value="{{ $document->memoire->mot_cle }}" name="mot_cle" id="mot_cle">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- Materiel d'accompagnement --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Matériel d'accompagnement </label> <br>
                                                    <input type="text" class="form-control" value="{{ $document->materiel_accompagnement }}" name="materiel_accompagnement" id="materiel_accompagnement">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- Site de catalogage --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Site de catalogage </label> <br>
                                                    <select class="form-control" name="site_catalogage" id="site_catalogage">
                                                        @if ($document && $document->site_catalogage)
                                                            <option value="{{ $document->site_catalogage }}" selected>
                                                                {{ $document->ref_site_catalogage->valeur }}</option>
                                                        @endif
                                                        <option value="">Choisir ...</option>
                                                        @if ($instituts && $instituts->reference_valeurs)
                                                            @foreach ($instituts->reference_valeurs as $institut)
                                                                <option value="{{ $institut->id }}">
                                                                    {{ $institut->valeur }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        {{-- Public cible --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Public visé </label> <br>
                                                    <select class="form-control" name="public_cible" id="public_cible">
                                                        @if ($document && $document->public_cible)
                                                            <option value="{{ $document->public_cible }}" selected>
                                                                {{ $document->ref_public_cible->valeur }}</option>
                                                        @endif
                                                        <option value="">Choisir ...</option>
                                                        @if ($public_cibles && $public_cibles->reference_valeurs)
                                                            @foreach ($public_cibles->reference_valeurs as $public_cible)
                                                                <option value="{{ $public_cible->id }}">
                                                                    {{ $public_cible->valeur }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        {{-- Is public --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Diffusé </label> <br>
                                                    <select class="form-control" name="is_public" id="is_public">
                                                        <option value="1" {{ $document->is_public == 1 ? 'selected' : '' }}>Oui
                                                        </option>
                                                        <option value="0" {{ $document->is_public == 0 ? 'selected' : '' }}>Non
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        {{-- Resume : textarea --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Résumé </label> <br>
                                                    <textarea class="form-control" name="resume" id="resume" rows="5">{{ $document->resume }}</textarea>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        {{-- Note --}}
                                        <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <label class="">Note </label> <br>
                                                    <textarea class="form-control" name="note" id="note" rows="5">{{ $document->note }}</textarea>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>




                                        {{-- Categorie --}}
                                        {{-- <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Catégorie </label> <br>
                                                        <select class="form-control" name="categorie" id="categorie">
                                                            @if ($document && $document->categorie)
                                                                <option value="{{ $document->categorie }}" selected>{{ $document->ref_categorie->valeur }}</option>
                                                            @endif
                                                            <option value="">Choisir ...</option>
                                                            @if ($categories && $categories->reference_valeurs)
                                                                @foreach ($categories->reference_valeurs as $categorie)
                                                                    <option value="{{ $categorie->id }}">{{ $categorie->valeur }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div> --}}
                                    </div>

                                    {{-- <div class="row" hidden>
                                            <div class="col-md-4 col-sm-4 col-xl-3" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <h4 style="text-transform: uppercase; text-decoration: black;">Exemplaire</h4>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" hidden>
                                            <div class="col-md-12 col-sm-12 col-xl-10" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">
                                                        <label class="">Groupe </label> <br>
                                                        <select class="form-control js-example-basic-multiple-single" multiple>
                                                            <option value="">Groupe 01</option>
                                                            <option value="">Groupe 02</option>
                                                            <option value="">Groupe 03</option>
                                                            <option value="">Groupe 04</option>
                                                            <option value="">Groupe 05</option>
                                                            <option value="">Groupe 06</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                            </div>
                                        </div> --}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="fichier-side">
                    <div class="row bott-wid">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    {{-- <div class="col-md-4 col-sm-4 col-xs-4"> --}}
                                    <div class="card">
                                        <div class="card-body" style="height: 1000px;">
                                            <div class="row text-right mb-20" style="margin-right: 0px;">
                                                <button type="button" class="btn" id="add-fichier">
                                                    {{-- <i class="fa fa-add fa-lg" style="margin-right: 10px;"></i> --}}
                                                    Choisir un fichier
                                                </button>
                                            </div>

                                            <input type="hidden" name="element_supp" id="element_supp">
                                            <input type="hidden" name="nbr_fichier" id="nbr_fichier" value="{{ $document->fichiers->count() }}">

                                            <div class="row text-center" id="zone-fichier">
                                                @foreach ($document->fichiers as $key => $fichier)
                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12" data-index="{{ $key }}" data-name="{{ $fichier->fichier->nom }}">
                                                        <div class="row widget m-h-5 text-center">
                                                            <a href="#" class="link" data-index="{{ $key }}" data-id="{{ $fichier->id }}" data-chemin="{{ asset($fichier->fichier->chemin) }}">
                                                                <h4> Fichier {{ $key + 1 }}</h4>
                                                            </a>
                                                            <a href="#" class="fichier-link" id="fichier-link-{{ $key }}" data-index="{{ $key }}" style="font-size:90%;color: red;">x</a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                @empty($document->fichiers)
                                                    <h4>Aucun fichier</h4>
                                                @endempty
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div class="card">
                                        <div class="card-body text-center" id="pdf-container" style="height: 1000px;">
                                            @if ($document->fichiers->count() > 0)
                                                <iframe src="{{ asset($document->fichiers[0]->fichier->chemin) }}" style="width: 100%; height: 100%; border: none;"></iframe>
                                            @else
                                                <h4>Aucun fichier sélectionné</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="">

            <div class="row" style="margin-bottom: 30px;">
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 text-right">
                        <button type="submit" class="btn theme-btn" style="background-color: green; border-color: green; margin-right: 20px;">
                            <i class="fa fa-save fa-lg" style="margin-right: 10px;"></i> Modifier
                        </button>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('custom/js/document-edit-memoire.js') }}"></script>

@endsection
