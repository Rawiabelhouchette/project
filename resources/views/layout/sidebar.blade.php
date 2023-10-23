<!-- /. NAV TOP  -->
<nav class="navbar navbar-side">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li class="@yield('dashboard')">
                <a href="{{ route('home') }}" style="padding-top: 25px;"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a>
            </li>
            <li class="@yield('reference')">
                <a href="javascript:void(0)"><i class="fa fa-cog" aria-hidden="true"></i>Référence <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('references.nom.add') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Nom
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('references.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Valeur
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('references.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Recherche
                        </a>
                    </li>
                </ul>
            </li>

            <li class="@yield('localisation')">
                <a href="javascript:void(0)"><i class="fa fa-map" aria-hidden="true"></i>Localisation <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Pays
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('villes.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Ville
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quartiers.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Quartier
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('localisations') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Recherche
                        </a>
                    </li>
                </ul>
            </li>

            <li class="@yield('compte')">
                <a href="javascript:void(0)"><i class="fa fa-briefcase" aria-hidden="true"></i>Compte <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('users.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Créer un compte
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Recherche
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="@yield('entreprise')">
                <a href="javascript:void(0)"><i class="fa fa-city" aria-hidden="true"></i>Entreprise <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('entreprises.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Ajouter une entreprise
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('entreprises.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Recherche
                        </a>
                    </li>
                </ul>
            </li>

            <li class="@yield('annonce')">
                <a href="javascript:void(0)"><i class="fa fa-clone" aria-hidden="true"></i>Gestion annonce<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Ajouter une annonce
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Recherche
                        </a>
                    </li>
                </ul>
            </li>

            <li class="@yield('corbeille')">
                <a href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i>Corbeille<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Pays
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Ville
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            Quartier
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                            ...
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>

</nav>
<!-- /. NAV SIDE  -->
