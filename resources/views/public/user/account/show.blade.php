@extends('layout.public.app')

@section('profil', 'active')

@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#de6600';
    @endphp

    <section class="title-transparent page-title"
        style="background:url({{ asset('assets_client/img/banner/image-2.jpg') }})">
        <div class="container">
            <div class="title-content">
                <h1>Mon profil</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Profil</span>
                </div>
            </div>
        </div>
    </section>

    <div class="page-name auberge row">
        <div class="container text-left">
            @livewire('admin.profile')
        </div>
    </div>
@endsection