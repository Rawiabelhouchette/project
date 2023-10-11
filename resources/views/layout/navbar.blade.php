@php
    $appercuMessage = App\Models\Message::where('repondu', false)->where('autre_motif', '!=', '-')->orderBy('created_at','desc')->take(3)->get();
    $nbreMessage = App\Models\Message::where('repondu', false)->where('autre_motif', '!=', '-')->count();
@endphp

<nav class="navbar navbar-inverse  navbar-fixed-top" style="background-color: #EA4F0C; border-color: #EA4F0C;">
    <div class="col-md-6">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('custom/img/logo5.png') }}"
                                                                       class="img-responsive" alt=""></a>
            {{-- <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive" alt=""></a> --}}
            {{-- style="background-color: white;" --}}
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3" style="text-align: right;">
        {{-- ceci est un test --}}
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw" style="color: white;"></i>
                    <span class="count-notification green" style="background-color: #24324a;"
                          id="message-counter">{{ $nbreMessage }}</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    @foreach ($appercuMessage as $message)
                        <li id="message-li-{{ $message->id }}">
                            <a href="{{ route('staff.messages.show', $message->id )}}">
                                <div>
                                    <strong>
                                        @if ($message->user_id == null)
                                            {{ $message->nom }} {{ $message->prenom }}
                                        @else
                                            {{ $message->user->nom }} {{ $message->user->prenom }}
                                        @endif
                                    </strong>
                                    <span class="pull-right text-muted">
                                        <em>
                                            @php
                                                $date = \Carbon\Carbon::parse($message->created_at)->locale('fr');;
                                                $diffForHumans = $date->diffForHumans();
                                                echo $diffForHumans;
                                            @endphp
                                        </em>
                                    </span>
                                </div>
                                <div>{{ substr($message->message, 0, 40) }}...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    @endforeach
                    {{-- @if ($appercuMessage->count() > 0) --}}
                    <li>
                        <a class="text-center btn-bott green" style="background-color: #EA4F0C"
                           href="{{ route('staff.messages.index')}}">
                            <strong>Tous les messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    {{-- @endif --}}
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <li class="dropdown" style="margin-right: 5px;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img src="{{ asset('assets/img/user.jpg') }}" class="img-responsive img-circle" alt="user">
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ route('staff.profil.index') }}"><i class="fa fa-user fa-fw"></i> Mon compte</a>
                    </li>
                    {{-- <li class="divider"></li> --}}
                </ul>
            </li>
            <li class="dropdown">
                <form class="" action="{{ route('logout') }}" method="GET">
                    @csrf
                    <button class="btn dark-btn-outlined" style="margin: 5px;text-transform: capitalize;" type="submit">
                        <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp; Déconnexion
                    </button>
                </form>
            </li>
        </ul>

    </div>

</nav>
