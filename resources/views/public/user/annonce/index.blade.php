@extends('layout.public.app')

@section('title', 'Mes annonces')

@section('content')

    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Annonces']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true" title="Mes annonces" :showSearchButton="true"
        :breadcrumbs="$breadcrumbs" />

    <div class="page-name auberge row">
        <div class="container text-left p-0">
            @livewire('admin.annonce')
        </div>
    </div>
@endsection
