@extends('public.template')

@section('breadcrumb')
    <h5>
        <a class="text-underlined" href="{{ route('accueil') }}" title="Revenir à l'accueil">Accueil</a> &nbsp;
        &gt; &nbsp;
        <a class="text-underlined" href="{{ route('public.annonces.create') }}" title="Revenir à la recherche">Déposer une annonce</a> &nbsp;
        &gt; &nbsp;
        <a href="javascript:void(0)">
            Restaurant
        </a>
    </h5>
@endsection

@section('page-content')
@endsection
