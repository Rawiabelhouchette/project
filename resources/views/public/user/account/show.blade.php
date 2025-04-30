@extends('layout.public.app')

@section('title', 'Mon profil')

@section('profil', 'active')

@section('content')


    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Profil']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true" title="Mon profil"
        :breadcrumbs="$breadcrumbs" />

    <div class="page-name auberge row">
        <div class="container text-left">
            @livewire('admin.profile')
        </div>
    </div>
@endsection
