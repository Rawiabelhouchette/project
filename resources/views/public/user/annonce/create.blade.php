@extends('layout.public.app')

@section('title', 'Déposer une annonce')

@section('css')
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')

    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Déposer une annonce']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-1.jpg') }}" :showTitle="true"
        title="Déposer une annonce" :breadcrumbs="$breadcrumbs" />

    <div class="page-name edit-annonce row">
        <div class="container px-5">
            @foreach ($typeAnnonces as $type)
                <div class="col-md-4 col-sm-6">
                    <div class="widget unique-widget">
                        <div class="row">
                            <div class="widget-caption {{ $type->color }}">
                                <a href="{{ route($type->route) }}">
                                    <div class="col-xs-4 no-pad">
                                        <i class="icon {{ $type->icon }}"></i>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="widget-detail" style="padding-left: 15px;">
                                            <h3>{{ $type->nom }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
