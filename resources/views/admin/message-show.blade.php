@extends('layout.app')

@section('message', 'active')

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
                                Information
                            </div>

                            <div class="chat_area" style="background-color: rgb(243, 237, 237) !important;">
                                @if ($message->user_id)
                                    <ul class="list-unstyled">
                                        <li class="left clearfix">
                                            Nom : <br>
                                            <h4>{{ $message->user->nom }}</h4>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="left clearfix">
                                            Prenom : <br>
                                            <h4>{{ $message->user->prenom }}</h4>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="left clearfix">
                                            Email : <br>
                                            <h4>{{ $message->user->email }}</h4>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="list-unstyled">
                                        <li class="left clearfix">
                                            Nom : <br>
                                            <h4>{{ $message->nom }}</h4>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="left clearfix">
                                            Prenom : <br>
                                            <h4>{{ $message->prenom }}</h4>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="left clearfix">
                                            Email : <br>
                                            <h4>{{ $message->email }}</h4>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--chat_sidebar-->
                    <div class="col-sm-9 message_section">
                        <div class="row">
                            <div class="new_message_head text-center">
                                Discussion
                            </div>
                            @if (!$message->sent_by_admin)
                                <div class="text-center">
                                    Motif :
                                    @if ($message->motif)
                                        {{ $message->getMotif->valeur }}
                                    @else
                                        {{ $message->autre_motif }}
                                    @endif
                                </div>
                            @endif

                            <div class="chat_area">
                                <ul class="list-unstyled" id="message-client">
                                    @foreach ($message->discussions as $discussion)
                                        @if ($discussion->sent_by_admin)
                                            <li class="left clearfix admin_chat">
                                                <span class="chat-img1 pull-right">
                                                    <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
                                                </span>
                                                <div class="chat-body1 clearfix">
                                                    <p class="mrg-bot-0">{{ $discussion->message }}</p>
                                                    <div class="chat_time pull-left">
                                                        <span class="font-13">
                                                            {{ $discussion->created_at->format('d-m-Y H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                            <li class="left clearfix mrg-bot-0">
                                                <span class="chat-img1 pull-left">
                                                    <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
                                                </span>
                                                <div class="chat-body1 clearfix">
                                                    <p class="mrg-bot-0">{{ $discussion->message }}</p>
                                                    <div class="chat_time pull-right">
                                                        <span class="font-13">
                                                            {{ $discussion->created_at->format('d-m-Y H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                @if (!$message->closed_permanently)
                                    <div class="message_write" id="message-zone">
                                        @if ($message->closed)
                                            <h5 class="text-center mrg-top-0 mrg-bot-15">Discussion cloturée </h5>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-10 col-xs-9 col-sm-9">
                                                <textarea class="form-control" id="message" rows="5" placeholder="Entrer votre message"></textarea>
                                            </div>
                                            <div class="col-md-2 col-xs-3 col-sm-3">
                                                <button class="btn theme-btn" id="send-message" style="background-color: #EA4F0C;" data-token="{{ csrf_token() }}" data-url="{{ route('staff.messages.update', $message->id) }}">Envoyer</button>
                                            </div>
                                        </div>


                                        @if (!$message->closed)
                                            <h5 class="text-center">
                                                <a href="javascript:void(0)" class="cloturer" id="cloturer" data-index="0" style="color: #EA4F0C" data-url="{{ route('staff.messages.close', $message->id) }}">Cloturer la discusion</a>
                                            </h5>
                                        @endif


                                        <h5 class="text-center">
                                            <a href="javascript:void(0)" class="cloturer" data-index="1" style="color: red;" data-url="{{ route('staff.messages.permanently.close', $message->id) }}">Cloturer definitivement la discusion</a>
                                        </h5>
                                    </div>
                                @else
                                    <h5 class="text-center mrg-15">Discussion definitivement cloturée </h5>
                                @endif
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

    <script src="{{ asset('custom/js/message-show.js') }}"></script>

@endsection
