@extends('layout.public.app')

@section('title', 'Créer votre entreprise')

@section('content')



    @php
        $breadcrumbs = [
            ['route' => 'accueil', 'label' => 'Accueil'],
            ['route' => 'pricing', 'label' => 'Tarif'],
            ['label' => 'Tarif'],
        ];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/cinet_pay.png') }}" :showTitle="true" title="Abonnement"
        :breadcrumbs="$breadcrumbs" />

    <div class="clearfix"></div>

    <section>
        <div class="container">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="package-box">
                    <div class="package-header">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <h3>{{ $offre->libelle }}</h3>
                    </div>
                    <div class="package-price" style="">
                        <h3 class="mrg-top-0" style="font-family: 'Poppins', sans-serif; font-size: 27px !important; color: #26354e; margin-bottom: .25em; ">{{ number_format($offre->prix, 0, ',', ' ') }} <sup style="font-size: 15px;">F CFA </sup><sub>/ {{ $offre->duree }} {{ $offre->unite_fr }}</sub></h3>
                    </div>
                    <div class="package-info" style="font-family: 'Muli', sans-serif;">
                        <ul>
                            @foreach ($offre->options as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="p-3">
                    <div class="wel-back">
                        <h2>Créer votre <span class="theme-cl">Entreprise</span></h2>
                    </div>

                    <form action="{{ route('abonnements.payement.check') }}" method="POST">
                        @csrf
                        <input type="hidden" name="offre_id" value="{{ $offre->id }}">

                        <div class="row p-2 px-4">
                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa fa-building theme-cl"></i></span>
                                    <input id="company" class="form-control" type="text"
                                        placeholder="Nom de votre entreprise" required name="nom_entreprise"
                                        value="{{ old('nom_entreprise') }}">
                                </div>
                                @error('nom_entreprise')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa fa-globe theme-cl"></i></span>
                                    <select id="country" class="form-control" name="pays" required>
                                        <option value="" disabled selected>Choisissez un pays</option>
                                    </select>
                                </div>
                                @error('pays')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa fa-map-marker theme-cl"></i></span>
                                    <select id="city" class="form-control" name="ville_id" required>
                                        <option value="" disabled selected>Choisissez une ville</option>
                                    </select>
                                </div>
                                @error('ville_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa fa-phone theme-cl"></i></span>
                                    {{-- <span class="input-group-addon phone_indicatif">+00</i></span> --}}
                                    <input id="phone" class="form-control" type="text" placeholder="Numéro de téléphone (+228 xx xx xx xx)" required name="numero_telephone" value="{{ old('numero_telephone') }}" pattern="^\+[0-9\s]+$" title="Veuillez entrer un numéro commençant par + suivi de chiffres et d'espaces.">
                                </div>
                                @error('numero_telephone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 mb-4">
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="fa-brands fa-whatsapp theme-cl" style="font-size: 17px;"></i></span>
                                    {{-- <span class="input-group-addon phone_indicatif">+00</i></span> --}}
                                    <input id="whatsapp_phone" class="form-control" type="text" placeholder="Numéro whatsapp (+228 xx xx xx xx)" required name="numero_whatsapp" value="{{ old('numero_whatsapp') }}" pattern="^\+[0-9\s]+$" title="Veuillez entrer un numéro commençant par + suivi de chiffres et d'espaces.">
                                </div>
                                @error('numero_whatsapp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="center mt-3">
                            <button id="signup" class="btn btn-midium theme-btn btn-radius width-200" type="submit">
                                <span style="display: inline-flex; align-items: center;">
                                    {{ __('Enregistrer') }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Convert PHP arrays to JavaScript objects
            const countryToCities = @json($villes);
            const countries = @json($pays);

            // Phone input validation
            $('#phone, #whatsapp_phone').on('input', function(e) {
                const value = $(this).val();
                const lastChar = value.slice(-1);

                // Check if the last character is not a digit or space
                if (lastChar !== '' && !/^[0-9\s]$/.test(lastChar)) {
                    // Alert the user
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Erreur de saisie',
                    //     text: 'Veuillez entrer uniquement des chiffres et des espaces.',
                    //     confirmButtonText: 'OK'
                    // });

                    // Remove the invalid character
                    $(this).val(value.slice(0, -1));
                }
            });

            // Populate the country dropdown
            if (countries && countries.length) {
                $('#country').empty().append('<option value="" disabled selected>Choisissez un pays</option>');
                $.each(countries, function(index, country) {
                    $('#country').append($('<option></option>').val(country.id).text(country.nom).attr(
                        'data-indicatif', country.indicatif));
                });
            }

            $('#country').on('change', function() {
                $('.phone_indicatif').text($(this).find(':selected').data('indicatif'));

                const selectedCountry = $(this).val();
                const cities = countryToCities
                    .filter(country => country.pays_id == selectedCountry)
                    .sort((a, b) => a.nom.localeCompare(b.nom));

                $('#city').empty().append(
                    '<option value="" disabled selected>Choisissez une ville</option>');

                $.each(cities, function(index, city) {
                    // Handle cities as objects with id and nom properties
                    $('#city').append($('<option></option>').val(city.id).text(city.nom));
                });
            });
        });
    </script>
@endsection
