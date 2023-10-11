@extends('layout.app')

@section('message', 'active')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
    <div class="row bg-title" style="padding-top: 20px;">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb" style="text-align: left">
                <li><a href="#">Message</a></li>
                <li class="active">Information </li>
            </ol>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /. ROW  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="chat_container">
                    <div class="col-sm-3 message_section">
                        <div class="row">
                            <div class="new_message_head text-center">
                                Information du destinataire
                            </div>

                            <div class="chat_area" style="background-color: rgb(243, 237, 237) !important;">
                                <ul class="list-unstyled">
                                    <li class="left clearfix">
                                        <select class="js-example-basic-multiple-single form-control" id="dest-selection">
                                            <option value="">Choisir destinataire</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}" data-type="client" data-email="{{ $client->email }}" data-nom="{{ $client->nom }}" data-prenom="{{ $client->prenom }}">{{ $client->nom }} {{ $client->prenom }}</option>
                                            @endforeach
                                            @foreach ($usagers as $usager)
                                                <option value="{{ $usager->id }}" data-type="usr" data-email="{{ $usager->compte->user->email }}" data-nom="{{ $usager->compte->user->nom }}" data-prenom="{{ $usager->compte->user->prenom }}">{{ $usager->compte->user->nom }} {{ $usager->compte->user->prenom }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li class="left clearfix">
                                        Nom : <br> <span id="dest-nom"></span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li class="left clearfix">
                                        Prenom : <br> <span id="dest-prenom"></span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li class="left clearfix">
                                        Email : <br> <span id="dest-email"></span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                            </div>
                        </div>
                    </div>
                    <!--chat_sidebar-->
                    <div class="col-sm-9 message_section">
                        <div class="row">
                            <div class="new_message_head text-center">
                                Message
                            </div>
                            <div class="chat_area">
                                <ul class="list-unstyled" id="message-zone">
                                </ul>
                                <div class="message_write" id="message-zone-2">
                                    <div class="row">
                                        <div class="col-md-10 col-xs-9 col-sm-9">
                                            <textarea class="form-control" id="message" rows="5" placeholder="Entrer votre message"></textarea>
                                        </div>
                                        <div class="col-md-2 col-xs-3 col-sm-3">
                                            <button class="btn theme-btn" id="send-message" style="background-color: #EA4F0C;" data-token="{{ csrf_token() }}" data-url="{{ route('staff.messages.contact') }}">Envoyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/intl.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Initialisation du select2
        $('.js-example-basic-multiple-single').select2();
    </script>

    <script>
        $(document).ready(function() {
            $('#dest-selection').on('change', function() {
                $('#message-zone').empty();
                if ($(this).val() == '') {
                    $('#dest-nom').text('');
                    $('#dest-prenom').text('');
                    $('#dest-email').text('');
                    return;
                }
                var nom = $(this).find(':selected').data('nom');
                var prenom = $(this).find(':selected').data('prenom');
                var email = $(this).find(':selected').data('email');
                $('#dest-nom').text(nom);
                $('#dest-prenom').text(prenom);
                $('#dest-email').text(email);
            });
        });

        $('#send-message').click(function() {
            var message = $('#message').val();
            var dest = $('#dest-selection').val();
            var token = $(this).data('token');
            var url = $(this).data('url');
            var type = $('#dest-selection').find(':selected').data('type');
            if (dest == '') {
                alert('Veuillez choisir un destinataire');
                return;
            }
            if (message.length <= 3) {
                alert('Veuillez entrer un message');
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: token,
                    message: message,
                    type: type,
                    dest: dest
                },
                success: function(data) {
                    var text = `
                        <li class="left clearfix admin_chat">
                            <span class="chat-img1 pull-right">
                                <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
                            </span>
                            <div class="chat-body1 clearfix">
                                <p>` + data.reponse + `</p>
                                <div class="chat_time pull-left">` + data.date + `</div>
                            </div>
                        </li>
                    `;
                    $('#message-zone').append(text).hide().fadeIn(1000);
                    $('#message').val('');
                },
                error: function(data) {
                    alert("Une erreur s'est produite");
                }
            });
        });
    </script>

@endsection
