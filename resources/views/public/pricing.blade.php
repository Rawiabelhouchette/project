@extends('layout.public.app')

@section('title', 'Créer un compte professionnel')

@section('content')

    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Tarif']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/cinet_pay.png') }}" :showTitle="true" title="Abonnement" :breadcrumbs="$breadcrumbs" />
    <div class="clearfix"></div>

    <section>
        <div class="container">
            <div class="mx-auto my-5 max-w-3xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Choisissez votre abonnement</h2>
                <p class="mt-4 text-lg text-gray-600">
                    Des offres adaptées à vos besoins avec un excellent rapport qualité-prix
                </p>
            </div>

            {{-- display errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row gy-5 mb-2">
                @foreach ($offres as $offre)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        @include('components.pricing-card', ['offre' => $offre, 'isPro' => $isPro])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            applyMask('Togo');
        });
    </script>
@endpush
