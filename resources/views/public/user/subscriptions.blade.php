@extends('layout.public.app')

@section('title', 'Mes abonnements')

@section('content')


    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Abonnements']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true"
        title="Mes abonnements" :breadcrumbs="$breadcrumbs" />

    <div class="page-name auberge row">
        <div class="container text-left">
            @livewire('admin.subscription')
        </div>
    </div>
@endsection
