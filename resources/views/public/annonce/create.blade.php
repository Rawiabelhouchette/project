@extends('layout.public.app-2')

@section('navbar-2')
    <li>
        <a href="{{ route('search') }}">
            Mon entreprise
        </a>
    </li>
    <li>
        <a href="{{ route('search') }}">
            Mes annonces
        </a>
    </li>
@endsection

@section('content')
    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp

    <style>
        .social-network {
            color: #fff;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            padding: 6px 15px;
            border-radius: 4px;
            margin-right: 3px;
            margin-bottom: 15px;
            border: 1px solid transparent;
        }

        .social-network:hover {
            color: #fff;
        }

        .social-network:visited {
            color: #fff;
        }

        .li-btn {
            background: white;
            color: grey;
            border: 1px solid grey;
            border-radius: 4px;
            -webkit-user-select: none;
        }

        .li-btn.view:hover {
            color: gray;
        }

        .li-btn:hover {
            color: {{ $defaultColor }};
        }

        .share-button:hover {
            background: {{ $defaultColor }} !important;
            color: white !important;
            border: 1px solid {{ $defaultColor }} !important;
            border-radius: 4px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 1s infinite;
        }

        @media (max-width: 768px) {
            .nav-div {
                text-align: center !important;
            }

            .nav-div-1 {
                padding-bottom: 20px !important;
            }
        }
    </style>

    <!-- ================ Listing Detail Basic Information ======================= -->
    {{-- <div class="dark-opacity" id="banner-alt-2" data-overlay="8"></div> --}}
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <!-- ================ Listing Detail Full Information ======================= -->
    <section class="list-detail padd-bot-10 padd-top-30" style="margin-top: 65px !important;">
        <div class="container">
            <div class="row mrg-bot-40">
                <div class="col-md-6 col-sm-12 nav-div nav-div-1">
                    <h5>
                        <a href="{{ route('accueil') }}" title="Revenir à la recherche" style="text-decoration: underline;">
                            Accueil
                        </a> &nbsp;
                        &gt; &nbsp;
                        Déposer une annonce
                    </h5>
                </div>
                <div class="col-md-6 col-sm-12 nav-div" style="text-align: right">
                    <h5>
                        {{-- <a class="" href="{{ $pagination->previous }}">
                            <i class="fa fa-fw fa-angle-left"></i>
                            Précédent
                        </a>
                        <span class="padd-l-10 padd-r-10 theme-cl">
                            {{ $pagination->position }}
                        </span>
                        <a class="" href="{{ $pagination->next }}">
                            Suivant
                            <i class="fa fa-fw fa-angle-right"></i>
                        </a> --}}
                    </h5>
                </div>
            </div>

            <style>
                .widget {
                    border: 1px solid #f4f5f7;
                    background: #ffffff;
                    border-radius: 4px;
                    margin-bottom: 10px;
                    padding: 12px 0;
                    box-shadow: 0px 0px 9px 0px rgba(64, 65, 67, 0.05);
                }

                .widget.unique-widget i.icon {
                    font-size: 20px;
                    line-height: 45px;
                    text-align: center;
                    display: table;
                    margin: 0 auto;
                    width: 45px;
                    height: 45px;
                    border-radius: 50%;
                    color: #ffffff;
                }

                .widget.unique-widget .widget-caption.info i.icon {
                    background: #ffffff;
                    border: 1px solid #2196f3;
                    color: #2196f3;
                }

                .widget.unique-widget .widget-caption.danger i.icon {
                    background: #ffffff;
                    border: 1px solid #e20b0b;
                    color: #e20b0b;
                }

                .widget.unique-widget .widget-caption.sucess i.icon {
                    background: #ffffff;
                    border: 1px solid #74ba28;
                    color: #74ba28;
                }

                .widget.unique-widget .widget-caption.warning i.icon {
                    background: #ffffff;
                    border: 1px solid #ff9800;
                    color: #ff9800;
                }

                .widget .widget-detail h3 {
                    margin-bottom: 4px;
                    line-height: 1.3;
                    font-size: 20px;
                    margin-top: 0;
                }

                .widget .widget-detail {
                    width: 100%;
                    display: inline-block;
                }

                .widget-detail span {
                    opacity: 0.6;
                }

                .widget .widget-caption .col-xs-8 {
                    border-left: 1px solid lightgrey;
                }

                .widget-caption .col-xs-4.no-pad {
                    padding-right: 0;
                }
            </style>

            <div class="row">
                @foreach ($typeAnnonces as $type)
                    <div class="col-md-4 col-sm-6">
                        <div class="widget unique-widget">
                            <div class="row">
                                <div class="widget-caption {{ $type->color }}">
                                    <div class="col-xs-4 no-pad">
                                        <i class="icon {{ $type->icon }}"></i>
                                    </div>
                                    <a href="{{ route($type->route) }}">
                                        <div class="col-xs-8">
                                            <div class="widget-detail">
                                                <h3>{{ $type->nom }}</h3>
                                                <span>{{ $type->nom }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- ================ Listing Detail Full Information ======================= -->
@endsection
