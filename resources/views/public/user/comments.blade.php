@extends('layout.public.app')

@section('title', 'Mes commentaires')

@section('content')


    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Commentaires']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true"
        title="Mes commentaires" :breadcrumbs="$breadcrumbs" />

    <div class="page-name auberge row">
        <div class="container text-left">
            @livewire('admin.comment')
        </div>
    </div>
@endsection
