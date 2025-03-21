@extends('layout.public.app')

@section('css')
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/banner/image-1.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Déposer une annonce</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Déposer une annonce</span>
                </div>
            </div>
        </div>
    </section>

    <div class="page-name edit-annonce row">
        <div class="container">
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
                                        <div class="widget-detail">
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
