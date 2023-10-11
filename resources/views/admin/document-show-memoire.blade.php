@extends('layout.app')

@section('catalogue', 'active')

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
                <li><a href="{{ route('documents.create') }}">Document</a></li>
                <li class="active">Détail d'un mémoire</li>
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
                                    <a href="{{ route('memoires.edit', $document->id)}}" type="button" class="btn theme-btn text-right" style="background-color: #EA4F0C;">
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
                                                <style>
                                                    .image-container {
                                                        height: 100%;
                                                        width: 250px;
                                                    }

                                                    .image-icon {
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        width: 90%;
                                                        height: 250px;
                                                        background-color: #f2f2f2;
                                                        border: 2px solid #999999;
                                                        border-radius: 5px;
                                                        /* margin-left: 10px; */
                                                    }

                                                    .image-icon i {
                                                        font-size: 50px;
                                                        color: #999999;
                                                    }
                                                </style>

                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">TITRE</td>
                                                    <td>{{ $document->titre }}</td>
                                                    <td rowspan="4" width="30%">
                                                        <div class="image-icon" id="ico-zone">
                                                            @if ($document->image == null) 
                                                                <i class="fas fa-image" id="ico"></i>
                                                            @else
                                                                <img id="preview" src="{{ asset($document->image->chemin) }}" width="100%" height="100%" src="#"
                                                                    alt="Aperçu de l'image">
                                                            @endif
                                                            {{-- <i class="fas fa-image" id="ico"></i> --}}
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">SOUS-TITRE</td>
                                                    <td>{{ $document->sous_titre }}</td>
                                                    {{-- <td></td> --}}
                                                </tr>

                                                {{-- resume --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">RESUME</td>
                                                    <td>{{ $document->resume }}</td>
                                                    {{-- <td></td> --}}
                                                </tr>

                                                {{-- Auteur --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">AUTEUR</td>
                                                    <td>{{ $document->auteur }}</td>
                                                    {{-- <td></td> --}}
                                                </tr>

                                                {{-- Fonction auteur --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">FONCTION AUTEUR</td>
                                                    <td>
                                                        {{ $document->memoire->fonction_auteur }}
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Pays publication --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">PAYS PUBLICATION</td>
                                                    <td>
                                                        @if ($document && $document->pays_publication)
                                                            {{ $document->ref_pays_publication->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Niveau d'etude --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">NIVEAU D'ETUDE</td>
                                                    <td>
                                                        @if ($document->memoire && $document->memoire->niveau_etude)
                                                            {{ $document->memoire->ref_niveau_etude->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Institut --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">INSTITUT</td>
                                                    <td>
                                                        @if ($document->memoire && $document->memoire->institut)
                                                            {{ $document->memoire->ref_institut->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Date de soutenance --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">DATE DE SOUTENANCE</td>
                                                    <td>
                                                        @if ($document->memoire && $document->memoire->date_soutenance)
                                                            {{ date('d-m-Y', strtotime($document->memoire->date_soutenance)) }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Année de publication --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">ANNEE DE PUBLICATION</td>
                                                    <td>
                                                        @if ($document->annee_publication)
                                                            {{ $document->annee_publication }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Directeur de mémoire --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">DIRECTEUR DE PUBLICATION</td>
                                                    <td>
                                                        @if ($document->directeur)
                                                            {{ $document->directeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Langue du document --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">LANGUE DU DOCUMENT</td>
                                                    <td>
                                                        @if ($document && $document->langue)
                                                            {{ $document->ref_langue->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- url --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">URL</td>
                                                    <td>
                                                        @if ($document->url)
                                                            <a href="{{ $document->url }}" target="blank">{{ $document->url }}</a>
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Note --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">NOTE</td>
                                                    <td>
                                                        @if ($document->note)
                                                            {{ $document->note }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Sujet --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">SUJET</td>
                                                    <td>
                                                        @if ($document->ref_sujet)
                                                            @foreach ($document->ref_sujet as $sujet)
                                                                - {{ $sujet->sujet->valeur }} <br>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Theme --}}
                                                {{-- <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">THEME</td>
                                                    <td>
                                                        @if ($document->theme)
                                                            {{ $document->ref_theme->valeur }}
                                                        @endif
                                                    </td>
                                                </tr> --}}

                                                {{-- Domaine de formation : input --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">DOMAINE DE FORMATION</td>
                                                    <td>
                                                        @if ($document->memoire)
                                                            {{ $document->memoire->domaine_formation }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Specialite : input text --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">SPECIALITE</td>
                                                    <td>
                                                        @if ($document->memoire)
                                                            {{ $document->memoire->specialite }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Type de mémoire --}}
                                                {{-- <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">TYPE DE MEMOIRE</td>
                                                    <td>
                                                        @if ($document->memoire && $document->memoire->type_memoire)
                                                            {{ $document->memoire->ref_type_memoire->valeur }}
                                                        @endif
                                                    </td>
                                                </tr> --}}

                                                {{-- Filière --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">FILIERE</td>
                                                    <td>
                                                        @if ($document->memoire && $document->memoire->filiere)
                                                            {{ $document->memoire->ref_filiere->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Nombre de page --}}
                                                {{-- <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">NOMBRE DE PAGE</td>
                                                    <td>
                                                        @if ($document->nbr_page)
                                                            {{ $document->nbr_page }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr> --}}

                                                {{-- Autorisation : input text --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">AUTORISATION</td>
                                                    <td>
                                                        @if ($document)
                                                            {{ $document->autorisation }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- MOt cle --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">MOT CLE</td>
                                                    <td>
                                                        @if ($document->memoire)
                                                            {{ $document->memoire->mot_cle }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Materiel d'accompagnement --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">MATERIEL D'ACCOMPAGNEMENT</td>
                                                    <td>
                                                        @if ($document->materiel_accompagnement)
                                                            {{ $document->materiel_accompagnement }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Site de catalogage --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">SITE DE CATALOGAGE</td>
                                                    <td>
                                                        @if ($document->site_catalogage)
                                                            {{ $document->ref_site_catalogage->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Public cible --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">PUBLIC VISÉ</td>
                                                    <td>
                                                        @if ($document->public_cible)
                                                            {{ $document->ref_public_cible->valeur }}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Is public --}}
                                                <tr id="show-fichier">
                                                    <td class="" style="font-weight: bold;" width="30%">DIFFUSÉ</td>
                                                    <td>
                                                        @if ($document->is_public)
                                                            <i class="fa fa-circle cl-success font-10 mrg-r-5"></i> Oui
                                                        @else
                                                            <i class="fa fa-circle cl-danger font-10 mrg-r-5"></i> Non
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                {{-- Fichier --}}
                                                <tr>
                                                    <td class="" style="font-weight: bold;" width="30%">FICHIERS</td>
                                                    <td>
                                                        @foreach ($document->fichiers as $key => $fichier)
                                                            <div style="display: inline-block; margin-right: 10px;" class="" data-index="{{ $key }}" data-name="{{ $fichier->fichier->nom }}">
                                                                <a href="#show-fichier" class="link" data-index="{{ $key }}" data-id="{{ $fichier->id }}" data-chemin="{{ asset($fichier->fichier->chemin) }}">
                                                                    <h5>Fichier {{ $key + 1 }}</h5>
                                                                </a>
                                                            </div>
                                                        @endforeach

                                                        @if(count($document->fichiers) == 0)
                                                            Aucun fichier
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                @if(count($document->fichiers) != 0)
                                                <tr>
                                                    <td colspan="3" id="pdf-container"></td>
                                                </tr>
                                                @endif
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
        $(document).ready(function() {
            $(".link").click(function () {
                var pdfUrl = $(this).data('chemin');
                $("#pdf-container").html('<embed src="' + pdfUrl + '#toolbar=1&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />');
            });
        });

    </script>

@endsection
