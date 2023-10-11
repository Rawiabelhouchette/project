@extends('layout.app')

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Compte</a></li>
                <li class="active">Profil</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <form action="{{ route('staff.profil.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
                <div class="add-job_container">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Informations personnelles</h4>
                        </div>
                        <div class="card-body">
                            <div class="row no-ext-mrg sm-plix">
                                <div class="col-sm-6">
                                    <label class="required" for="">Nom</label>
                                    <input type="text" class="form-control" name="nom" value="{{ $user->nom }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="required" for="">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" value="{{ $user->prenom }}" required>
                                </div>
                            </div>
                            <div class="row no-ext-mrg sm-plix">
                                <div class="col-sm-6">
                                    <label class="required">E-mail</label>
                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="required">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="add-job_container">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; &nbsp;Mot de passe</h4>
                        </div>
                        <div class="card-body">
                            <div class="row no-ext-mrg sm-plix">
                                <div class="col-sm-6">
                                    <label class="required">Mot de passe</label>
                                    <input type="password" class="form-control" name="password1" placeholder="********" required>
                                </div>
                                <div class="col-sm-6">

                                </div>
                            </div>
                            <div class="row no-ext-mrg sm-plix">
                                <div class="col-sm-6">
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="password" placeholder="********">
                                </div>
                                <div class="col-sm-6">
                                    <label>Rataper le nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="password-confirmation" placeholder="********">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="add-job_container text-right">
                    <button type="submit" class="btn theme-btn" style="background-color: green; border-color: green; margin-right: 15px;">Mettre à jour</button>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
