@extends('public.template')

@section('breadcrumb')
    <h5>
        <a href="{{ route('accueil') }}" class="text-underlined" title="Revenir à l'accueil">Accueil</a> &nbsp;
        &gt; &nbsp;
        <a href="{{ route('public.annonces.create') }}" class="text-underlined" title="Revenir à la recherche">Déposer une annonce</a> &nbsp;
        &gt; &nbsp;
        <a href="javascript:void(0)">
            Boite de nuit
        </a>
    </h5>
@endsection

@section('page-content')
@endsection
