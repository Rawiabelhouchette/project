@extends('layout.public.app')

@section('title', 'Créer un compte professionnel')

@section('content')

    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Tarif']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/cinet_pay.png') }}" :showTitle="true" title="Abonnement"
        :breadcrumbs="$breadcrumbs" />
    <div class="clearfix"></div>

    <section>
        <div class="container">
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

            @foreach ($offres as $offre)
                @include('components.pricing-card', ['offre' => $offre, 'isPro' => $isPro])
            @endforeach
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
