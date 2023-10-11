@extends('layout_client.app')

{{-- @section('content_class') --}}

@section('css')
    <!-- Common Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
    <div class="wrapper">
        <!-- Start Navigation -->
        @include('layout_client.navbar')
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- ================ Start Page Title ======================= -->
        <section class="title-transparent page-title" style="background-image:url(/assets_client/img/bibioteque_1200x680_bibl.jpg);" data-overlay="8">
            <div class="container">
                <div class="banner-caption">
                    <div class="col-md-12 col-sm-12 banner-text">
                        @include('layout_client.search-form')
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- ================ End Page Title ======================= -->

        <!-- ================ Listing In Vertical style with Sidebar ======================= -->
        <!-- ================ End Listing In Vertical style with Sidebar ======================= -->

        <style>
            /* .booking-confirm i {
    width: 100px;
    height: 100px;
    display: table;
    margin: 0 auto;
    background: #ffffff;
    line-height: 100px;
    font-size: 45px;
    color: #05bf83;
    border-radius: 50%;
    border: 1px solid #abffe4;
    box-shadow: 0px 0px 10px 1px rgb(175, 255, 229);
    -webkit-box-shadow: 0px 0px 10px 1px rgb(175, 255, 229);
    -moz-box-shadow: 0px 0px 10px 1px rgb(175, 255, 229);
} */
        </style>

        <section>
            <div class="container">
                <div class="booking-confirm padd-top-30 padd-bot-30">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <h2 class="mrg-top-15">Thanks for your booking!</h2>
                    <p>You'll receive a confirmation email at mail@yourgmail.com</p>
                    <a href="invoice.html" class="btn theme-btn-trans mrg-top-20">Check Invoice</a>
                </div>
            </div>
        </section>



        <!-- ================ Start Footer ======================= -->
        @include('layout_client.footer')
        <!-- ================ End Footer Section ======================= -->

        <!-- ================== Login & Sign Up Window ================== -->
        @include('layout.connexion_modal')
        <!-- ===================== End Login & Sign Up Window =========================== -->
        <!-- ===================== End Login & Sign Up Window =========================== -->

        @include('layout_client.scroller')


    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#btn-register').click(function() {
                $('#signin').modal('hide');

                setTimeout(function() {
                    $('#register').modal('show');
                }, 500);
            });

            $('#btn-login').click(function() {
                $('#register').modal('hide');

                // Attendre une seconde avant d'afficher le modal
                setTimeout(function() {
                    $('#signin').modal('show');
                }, 500);
            });

            // Activer ou desactiver autre_motif si motif est autre
            $('#motif').change(function() {
                if ($(this).val() == '0') {
                    $('#autre_motif').prop('disabled', false);
                    $('#autre_motif').prop('required', true);
                } else {
                    $('#autre_motif').prop('disabled', true);
                    $('#autre_motif').val('');
                    $('#autre_motif').prop('required', false);
                }
            });
        });
    </script>
@endsection
