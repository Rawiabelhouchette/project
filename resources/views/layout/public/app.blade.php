<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}') }}" type="image/x-icon">

    <title>Vamiyi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Les meilleurs bars, restaurants, boites de nuit, location de voiture et hébergements du Togo">
    <meta name="keywords" content="restaurants, bars, Togo, boîtes de nuit, location de voiture, hébergements, logements">
    <meta name="robots" content="index,follow">

    <link type="image/x-icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" rel="icon">
    <link type="image/x-icon" href="{{ asset('assets/img/logo-vamiyi-by-numrod-small.png') }}" rel="shortcut icon">

    <title>Vamiyi</title>

    @livewireStyles
    
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css"
      rel="stylesheet"
    />
    
    <!-- Bootstrap 5 style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <!-- All plugins -->
    <link href="{{ asset('assets_client/plugins/css/plugins.css') }}" rel="stylesheet">

    <!-- Custom style -->
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_client/css/responsiveness.css') }}" rel="stylesheet">

    <!-- FONTAWESOME STYLES-->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js') }} for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js') }}"></script>
      <script src="js/respond.min.js') }}"></script>
    <![endif]-->
    
  

    {{-- cookies --}}
    <link href="{{ asset('assets_client/cookies/cookies.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_client/cookies/iframemanager.css') }}" rel="stylesheet">

    <script defer src="{{ asset('assets_client/cookies/cookieconsent.umd.js') }}"></script>
    <script defer src="{{ asset('assets_client/cookies/iframemanager.js') }}"></script>
    <script defer src="{{ asset('assets_client/cookies/index.js') }}"></script>
    {{-- end cookies --}}

    @yield('css')

</head>

<body class="home-2">
    <div class="wrapper">
        @php
            $defaultColor = '#ff3a72';
        @endphp

        <!-- Start Navigation -->

        @include('layout.public.navbar')

        <!-- End Navigation -->
        <div class="clearfix"></div>

        @yield('content')

        <!-- ================ Start Footer ======================= -->
        @include('layout.public.footer')
        <!-- ================ End Footer Section ======================= -->

        <!-- ================== Login & Sign Up Window ================== -->
        @include('layout.public.connexion')
        <!-- ===================== End Login & Sign Up Window =========================== -->

        <a class="theme-bg" id="back2Top" href="#" title="Back to top"><i class="ti-arrow-up"></i></a>
  
      <!-- START JAVASCRIPT --> 
      <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>
        <script src="{{ asset('assets_client/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootsnav.js') }}"></script>

        <script src="{{ asset('assets_client/plugins/js/jquery.touchSwipe.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/chosen.jquery.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/datedropper.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/dropzone.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.fancybox.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery.nice-select.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jqueryadd-count.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/jquery-rating.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/slick.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/timedropper.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/waypoints.min.js') }}"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="{{ asset('assets_client/plugins/js/bootstrap-slider.js') }}"></script>
        <script src="{{ asset('assets_client/plugins/js/bootstrap-touch-slider-min.js') }}"></script>

        <!-- LEAFLET -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

        <!-- Custom Js -->
        <script src="{{ asset('assets_client/js/custom.js') }}"></script>

        <script>
            window.addEventListener('page:reload', event => {
                location.reload();
            });
        </script>

        <script>
            // refresh url
            window.addEventListener('refresh:url', event => {
                window.history.replaceState({}, '', event.detail[0].url);
            });
        </script>

        <script src="https://unpkg.com/imask"></script>

        <script>
            // take cpuntry name as parameter
            function applyMask(country = 'Togo') {
                $('.telephone').each(function() {
                    let maskOptions;

                    switch (country) {
                        case 'Togo':
                            maskOptions = {
                                mask: '00 00 00 00'
                            }; // Format for Togo
                            break;
                        default:
                            maskOptions = {
                                mask: '00 00 00 00'
                            }; // Default format (TOGO)
                    }

                    let mask = IMask(this, maskOptions);
                });
            }
        </script>

        <!-- FONTAWSOME -->
        {{-- <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-rq3yrAQH0gezS8fRwU6Q/0Z0DlnV7B4ALxP5F9X9DhSkvM8zAywRU/kZBkxzZBpY5o5P5xu6ws3aIF9fUJMB8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @livewireScripts

        @stack('scripts')

        @yield('js')

      
    </div>
</body>

</html>
