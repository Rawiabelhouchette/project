@extends('layout_client.app')

@section('content')
    <div class="wrapper">
        <!-- Start Navigation -->
        @include('layout_client.navbar')
        <!-- End Navigation -->
        <div class="clearfix"></div>

        

        <!-- Main Banner Section Start -->
        <div class="banner dark-opacity" style="background-image:url(/assets_client/img/bibioteque_1200x680_bibl.jpg);" data-overlay="8">
            <div class="container">
                <div class="banner-caption">
                    <div class="col-md-12 col-sm-12 banner-text">
                        <form method="GET" action="{{ route('rechercheAnnonce') }}" class="form-verticle">
                            <div class="col-md-4 col-sm-4 no-padd">
                                <div class="form-box">
                                    <i class="banner-icon icon-layers"></i>
                                    <select class="selectpicker form-control " id="type_document" name="type_document" data-live-search="true" tabindex="-98">
                                        <option value="all" selected class="chosen-select">Tous les Documents</option>
                                        <option value="Memoire">Mémoire </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7 no-padd">
                                <div class="form-box btn-search" >
                                    <i class="banner-icon icon-pencil"></i>
                                    <input type="text" class="form-control right-br" id="mot_cle" name="mot_cle" placeholder="Mot clé ...">
                                </div>
                            </div>

                            <div class="col-md-1 col-sm-1 no-padd">
                                <div class="form-box">
                                    <button type="submit" class="btn btn-default" style="background-color: #EA4F0C; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                                        <i class="fa fa-fw fa-search" style="color: white; font-size: 25px;"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- Main Banner Section End -->


        <!-- ================ Start Footer ======================= -->
        @include('layout_client.footer')
        <!-- ================ End Footer Section ======================= -->

        <!-- ================== Login & Sign Up Window ================== -->
        @include('layout.connexion_modal')
        <!-- ===================== End Login & Sign Up Window =========================== -->

        {{-- @include('layout_client.scroller') --}}

        <!-- START JAVASCRIPT -->



    </div>
@endsection

@section('js')
    @error('username')
        <script>
            $(document).ready(function() {
                $('#signin').modal('show');
            });
        </script>
    @enderror

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
        });
    </script>
@endsection
