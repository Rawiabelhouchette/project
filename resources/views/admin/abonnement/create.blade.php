@extends('layout.admin.app')

@section('abonnement', 'active')

@section('css')
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-6 col-md-10 col-sm-6 col-xs-12">
            <ol class="breadcrumb" style="text-align: left;">
                <li><a href="#">Abonnement</a></li>
                <li class="active">Ajouter</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row bott-wid">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    @foreach ($offres as $offre)
                        @include('components.pricing-card', ['offre' => $offre])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#pricing-submit-btn').click(function() {
                Swal.fire({
                    title: 'Confirmation',
                    html: "<span style='font-size: 13px;'>Vous êtes sur le point de souscrire à un abonnement!</span>",
                    icon: 'warning',
                    width: '40%',
                    height: '40%',
                    showCancelButton: true,
                    confirmButtonColor: defaultColor,
                    confirmButtonText: '<span style="font-size: 15px;">Oui, souscrire!</span>',
                    cancelButtonText: '<span style="font-size: 15px;">Annuler</span>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#pricing-submit-form').submit();
                    }
                });
            });
        });
    </script>
@endpush
