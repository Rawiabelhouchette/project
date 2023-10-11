<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Numdoc</title>

    <!-- All plugins -->
    <link href="{{ asset('assets_client/plugins/css/plugins.css') }}" rel="stylesheet">

    <!-- Custom style -->
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_client/css/responsiveness.css') }}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <style>
        .btn-group.bootstrap-select.form-control {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .facette-color {
            background-color: #DFF3FE;
        }

        .orange-color {
            color: #EA4F0C !important;
        }

        .orange-color-bg {
            background-color: #EA4F0C !important;
        }
    </style>

    @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js') }}"></script>
      <script src="js/respond.min.js') }}"></script>
    <![endif]-->
    <style>
        input::placeholder,
        select::placeholder {
            font-style: italic;
            opacity: 0.5;
        }
    </style>
</head>

<body class="@yield('content_class', 'home-2')">

    @yield('content')


    <!-- START JAVASCRIPT -->
    <script src="{{ asset('assets_client/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_client/plugins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_client/plugins/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets_client/plugins/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets_client/plugins/js/bootstrap-touch-slider-min.js') }}"></script>
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
    <script src="{{ asset('assets_client/plugins/js/bootstrap-slider.js') }}"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets_client/js/custom.js') }}"></script>


    @yield('js')
</body>

</html>
