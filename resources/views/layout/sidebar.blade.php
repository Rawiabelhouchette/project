<!-- /. NAV TOP  -->
<nav class="navbar navbar-side">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li class="@yield('dashboard')">
                <a href="{{ route('home') }}" style="padding-top: 25px;"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a>
            </li>

            <li class="@yield('catalogue')">
                <a href="javascript:void(0)"><i class="fa fa-folder" aria-hidden="true"></i>Catalogue <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('documents.index') }}"><i class="fa-regular fa-file" style="margin-right: 15px;font-size: 16px;"></i>
                            Document
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('documents.create')}}"><i class="fas fa-file-upload" style="margin-right: 15px;font-size: 16px;"></i>
                            Création
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('type-documents.create')}}"><i class="fa-solid fa-file" style="margin-right: 15px;font-size: 16px;"></i>
                            Type document
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li class="@yield('catalogue')">
                <a href="javascript:void(0)"><img src="{{ asset('livre-ouvert.png') }}" alt="Catalogue" width="20" height="20" style="margin-right: 15px;font-size: 16px;border: 1px solid white;">Catalogue <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><img src="{{ asset('livre-ouvert.png') }}" alt="Document" width="20" height="20">Document</a>
                    </li>

                    <li>
                        <a href="#"><img src="mon-image.png" alt="Création" width="20" height="20">Création</a>
                    </li>
                </ul>
            </li> --}}

            <li class="@yield('agenda')">
                <a href="javascript:void(0)"><i class="fa-solid fa-calendar-days" aria-hidden="true" style="margin-right: 15px;font-size: 16px;"></i></i>Agenda <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('references.index') }}"><i class="fa fa-add" aria-hidden="true"></i>Evènement </a>
                    </li>
                </ul>
            </li>

            <li class="@yield('reference')">
                <a href="javascript:void(0)"><i class="fa fa-cog" aria-hidden="true"></i>Administration <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('references.index') }}"><i class="fa fa-add" aria-hidden="true"></i>Références </a>
                    </li>
                   <li>
                        <a href="{{ route('references.index') }}"><i class="fa-solid fa-trash-can" style="margin-right: 12px;"></i> Corbeille</a>
                    </li>
                </ul>
            </li>

            <li class="@yield('reservation')">
                <a href="#"><i class="fa fa-calendar-check"  aria-hidden="true"></i></i>Reservation</a>
            </li>

            {{-- <li class="@yield('message')">
                <a href="#"><i class="fa fa-comment" aria-hidden="true"></i>Message</a>
            </li> --}}

            <li class="@yield('message')" >
                <a href="javascript:void(0)"><i class="fa fa-comment" aria-hidden="true"></i>Message <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('staff.messages.index') }}"><i class="fa fa-comment-alt" aria-hidden="true"></i>Messages</a>
                    </li>

                    <li>
                        <a href="{{ route('staff.messages.create') }}"><i class="fa fa-comment" aria-hidden="true"></i>Contacter</a>
                    </li>
                </ul>
            </li>


            <li class="@yield('comptes')" >
                <a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i>Comptes <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('comptes.index')}}"><i class="fa fa-search" aria-hidden="true"></i>Recherche</a>
                    </li>

                    <li>
                        <a href="{{ route('comptes.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Création</a>
                    </li>
                </ul>
            </li>


            {{-- <li style="height: 60px;"></li> --}}

            <style>
                @media (max-width: 767px) {
                    /* Éléments à afficher seulement lorsque la taille de l'écran est inférieure à 768 pixels */
                    .mobile-perso {
                        display: block;
                    }
                }

                @media (min-width: 768px) {
                    /* Cacher l'élément */
                    .votre-element {
                        display: none;
                    }
                }
            </style>

            {{-- <li class="mobile-perso votre-element log-off ">
                <a href="{{ route('logout')}}"><i class="fa fa-power-off" aria-hidden="true"></i>Déconnexion</a>
            </li> --}}
        </ul>
    </div>

</nav>
<!-- /. NAV SIDE  -->
