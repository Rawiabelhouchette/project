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
        <section class="show-case">
            <div class="container">
                <div class="row">
                    <!-- Start Sidebar -->
                    <div class="col-md-3 col-sm-12">
                        <div class="sidebar">
                            <!-- Start: Search By Price -->
                            <div class="widget-boxed facette-color" style="padding-bottom: 0px;">
                                {{-- <div class="widget-boxed-header">
                                    <h4><i class="ti-money padd-r-10"></i>Top Categories</h4>
                                </div> --}}

                                <div class="widget-boxed-body padd-top-10 padd-bot-0">
                                    <div class="side-list">
                                        <ul class="price-range">
                                            @if (auth()->check())
                                                <li>
                                                    <a href="{{ route('profil.index') }}">
                                                        <span class="custom-checkbox d-block" style="font-size: 18px;">
                                                            <i class="fa-solid fa-user"></i> &nbsp;
                                                            Mon profil
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('messages.index') }}">
                                                    <span class="custom-checkbox d-block orange-color" style="font-size: 18px;">
                                                        <i class="fa-solid fa-comment"></i> &nbsp;
                                                        Message
                                                    </span>
                                                </a>
                                            </li>
                                            @if (auth()->check())
                                                <li>
                                                    <a href="{{ route('favoris.index') }}">
                                                        <span class="custom-checkbox d-block" style="font-size: 18px;">
                                                            <i class="fa-solid fa-star"></i> &nbsp;
                                                            Favoris
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Start Sidebar -->
                    <div class="col-md-9 col-sm-12">
                        <div class="row">
                            <div class="col-md-12" style="padding-left: 0px;">
                                <div class="comments" style="border-radius: 0;">
                                    <div class="comments-title facette-color">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <h4>
                                                    <i class="fa fa-comment" style="font-size: 15px;"></i> &nbsp;Discussion
                                                </h4>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <a href="{{ route('messages.create') }}">
                                                    <h4 class="orange-color">
                                                        <i class="fa fa-plus orange-color" style="font-size: 15px;"></i>
                                                        Ecrire
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="comments-title text-center" style="padding: 5px;">
                                        Motif : <b>
                                            @if ($message->motif)
                                                {{ $message->getMotif->valeur }}
                                            @else
                                                {{ $message->autre_motif }}
                                            @endif
                                        </b>
                                    </div>

                                    <!-- Single Comment -->
                                    <div style=" max-height: 600px; overflow-y: auto;" id="message-client">
                                        @foreach ($message->discussions as $discussion)
                                            @if (!$discussion->sent_by_admin)
                                                <div class="single-comment" style="padding-bottom: 3px;">
                                                    <div class="text-holder" style="padding-bottom: 5px; padding-top: 5px;  background-color: #fffaf7;">
                                                        <div class="text">
                                                            <p>
                                                            <h5>{{ $discussion->message }}</h5>
                                                            </p>
                                                        </div>

                                                        <span class="small">Envoyé le {{ $discussion->created_at->format('d-m-Y H:i:s') }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="single-comment" style="padding-bottom: 3px; padding-left: 10px; padding-right: 80px; ">
                                                    <div class="text-holder" style="padding-bottom: 5px; padding-top: 5px; background-color: #f0faff;">
                                                        <div class="text">
                                                            <p>
                                                            <h5>{{ $discussion->message }}</h5>
                                                            </p>
                                                        </div>

                                                        <span class="small">Reçu le {{ $discussion->updated_at->format('d-m-Y') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if (!$message->closed)
                                        <hr class="mrg-top-10 zone-envoi-message">
                                        <div class="single-comment zone-envoi-message" style="padding-bottom: 3px; padding-left: 10px; ">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-11" style="display: inline-block;">
                                                    <textarea class="form-control padd-r-0" id="message" style="margin-left : 0px !important;" placeholder="Envoyer un message" rows="2"></textarea>
                                                </div>

                                                <div class="col-md-1 col-sm-1">
                                                    <button class="btn theme-btn" id="send-message" style="background-color: #EA4F0C;" data-token="{{ csrf_token() }}" data-url="{{ route('messages.update', $message->id) }}">
                                                        <i class="fa fa-fw fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <h5 class="text-center">
                                                <a href="javascript:void(0)" style="color: red;" id="cloturer" data-url="{{ route('message.close', $message->id) }}">Cloturer la discusion</a>
                                            </h5>

                                        </div>
                                    @else
                                        <h5 class="text-center mrg-15">Discussion cloturée </h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- ================ End Listing In Vertical style with Sidebar ======================= -->

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
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#send-message').click(function() {
                var message = $('#message').val();

                if (message.length < 4) {
                    alert('Votre message doit contenir au moins 4 caractères');
                    return;
                }

                var url = $(this).data('url');
                var token = $(this).data('token');

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        _token: token,
                        message: message
                    },
                    success: function(data) {
                        $('#message').val('');
                        var text = `
                            <div class="single-comment" style="padding-bottom: 3px;">
                                <div class="text-holder" style="padding-bottom: 5px; padding-top: 5px;  background-color: #fffaf7;">
                                    <div class="text">
                                        <p>
                                        <h5>${data.reponse}</h5>
                                        </p>
                                    </div>
                                    <span class="small">Envoyé le ${data.date}</span>
                                </div>
                            </div>
                        `;
                        $('#message-client').append(text);
                    },
                    error: function(data) {
                        alert(data.message);
                    }
                });
            });

            $('#cloturer').click(function() {
                var confirmation = confirm('Voulez-vous vraiment cloturer cette discussion ?');
                if (confirmation) {
                    var url = $(this).data('url');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('.zone-envoi-message').remove().fadeOut(2000);
                        },
                        error: function(data) {
                            alert(data.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection
