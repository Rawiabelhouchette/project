@extends('layout.public.app')

@section('title', 'Mes favoris')

@section('content')

    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Favoris']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true" title="Mes favoris"
        :breadcrumbs="$breadcrumbs" />

    <div class="page-name auberge row">
        <div class="container text-left p-0 mt-4 mb-4">
            @livewire('admin.favoris')
        </div>
    </div>
@endsection
