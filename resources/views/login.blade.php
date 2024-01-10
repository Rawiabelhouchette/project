<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vamiyi - Login</title>

    <!-- All plugins -->
    <link href="{{ asset('assets_client/plugins/css/plugins.css') }}" rel="stylesheet">

    <!-- Custom style -->
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_client/css/responsiveness.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js') }} for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js') }}"></script>
      <script src="js/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body>
    <div class="wrapper">
        <!-- Start Navigation -->
        <nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
            <div class="container-fluid">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="ti-align-left"></i>
                </button>

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('accueil') }}">
                        <img src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" class="logo logo-display" alt="">
                        <img src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" class="logo logo-scrolled" alt="">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="navbar-menu" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                        <li><a href="javascript:void(0)" >&nbsp;</a></li>
                        {{-- <li><a href="javascript:void(0)" data-toggle="modal" data-target="#signin">Sign In</a></li> --}}
                    </ul>
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                        {{-- <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp"> --}}
                        <li class="no-pd">
                            <a href="{{ route('login') }}" class="addlist">
                                {{-- <i class="ti-plus" aria-hidden="true"></i> --}}
                                {{ __('Connexion') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- Start Login Section -->
        <section class="log-wrapper">
            <div class="container">
                <div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1">
                    <div class="log-box">
                        <h2>Connexion <span class="theme-cl">!</span></h2>
                        {{-- <form>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
									<input type="text" class="form-control" placeholder="User Name">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
									<input type="password" class="form-control" placeholder="Password">
								</div>
								<div class="text-center">
									<button type="button" class="btn theme-btn width-200 btn-radius">Enter</button>
								</div>
							</form> --}}

                        @error('email')
                            <div class="alert-group">
                                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email / Identifiant" required autocomplete="email" autofocus>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de Passe" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <span class="custom-checkbox d-block">
                                <input id="remember1" type="checkbox" name="remember">
                                <label for="remember1"></label>
                                {{ __('Se souvenir de moi') }}
                            </span>

                            {{-- <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Se souvenir de moi') }}
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}

                            <div class="text-center">
                                <button type="submit" class="btn theme-btn width-200 btn-radius">
                                    {{ __('Connexion') }}
                                </button>
                            </div>
                            {{-- <div class="text-center">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Connexion') }}
                                        </button>
        
                                    
                                    </div>								
                                </div> --}}
                            {{--   <div class="text-right">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
									<button type="button" class="btn theme-btn width-200 btn-radius">Enter</button>
								</div> --}}

                        </form>
                        {{-- <div class="center mrg-top-5">
								
								<a href="{{ url('register') }}" class="theme-cl">Créé un compte</a>
							</div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- End Login Section -->

        <!-- ================ Start Footer ======================= -->
        <footer class="footer dark-footer dark-bg">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="widgettitle widget-title">About Us</h3>
                            <p>We are Themez Hub A team of clean, creative & professionals delivering world-class HTML Templates to build a better & smart web.</p>
                            <a href="#" class="other-store-link">
                                <div class="other-store-app">
                                    <div class="os-app-icon">
                                        <i class="ti-android"></i>
                                    </div>
                                    <div class="os-app-caps">
                                        Google Store
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="widgettitle widget-title">Popular Services</h3>
                            <ul class="footer-navigation sinlge">
                                <li><a href="#">Home Version One</a></li>
                                <li><a href="#">Home Version Two</a></li>
                                <li><a href="#">Home Version Three</a></li>
                                <li><a href="#">Listing Detail Page</a></li>
                                <li><a href="#">Search Listing Page</a></li>
                                <li><a href="#">Our Top Authors</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="textwidget">
                                <h3 class="widgettitle widget-title">Get In Touch</h3>
                                <div class="address-box">
                                    <div class="sing-add">
                                        <i class="ti-location-pin"></i>7744 North, New York
                                    </div>
                                    <div class="sing-add">
                                        <i class="ti-email"></i>support@listinghub.com
                                    </div>
                                    <div class="sing-add">
                                        <i class="ti-mobile"></i>+91 021 548 75958
                                    </div>
                                    <div class="sing-add">
                                        <i class="ti-world"></i>www.themezhub.com
                                    </div>
                                </div>
                                <ul class="footer-social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="widgettitle widget-title">Subscribe Newsletter</h3>
                            <p>At Vero Eos Et Accusamus Et Iusto Odio Dignissimos Ducimus Qui Blanditiis</p>

                            <form class="sup-form">
                                <input type="email" class="form-control sigmup-me" placeholder="Your Email Address" required="required">
                                <button type="submit" class="btn" value="Get Started"><i class="fa fa-location-arrow"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="footer-copyright">
                <p>Copyright@ 2019 Listing Hub Design By <a href="http://www.themezhub.com/" title="Themezhub" target="_blank">Themezhub</a></p>
            </div>
        </footer>
        <!-- ================ End Footer Section ======================= -->

        <!-- ================== Login & Sign Up Window ================== -->
        <div id="signin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="modalLabel2" class="modal-title">LogIn Your Account</h4>
                        <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="wel-back">
                            <h2>Welcome <span class="theme-cl"></span></h2>
                        </div>

                        <form>

                            <div class="form-group">
                                <label>User Name</label>
                                <input type="email" class="form-control" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="*******">
                            </div>

                            <span class="custom-checkbox d-block">
                                <input id="select1" type="checkbox">
                                <label for="select1"></label>
                                Keep me Signed In
                            </span>

                            <div class="center">
                                <button id="login-btn" type="submit" class="btn btn-midium theme-btn btn-radius width-200"> Login </button>
                            </div>

                        </form>

                        <div class="connect-with">
                            <ul>
                                <li class="fb-ic"><a href="#"><i class="ti-facebook"></i></a></li>
                                <li class="gp-ic"><a href="#"><i class="ti-google"></i></a></li>
                                <li class="tw-ic"><a href="#"><i class="ti-twitter"></i></a></li>
                            </ul>
                        </div>

                        <div class="center mrg-top-5">
                            <div class="bottom-login text-center">Don't have an account</div>
                            <a href="javascript:void(0)" class="theme-cl" data-toggle="modal" data-dismiss="modal" data-target="#register">Create An Account</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div id="register" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="modalLabel3" class="modal-title">Create an Account</h4>
                        <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="wel-back">
                            <h2>Hi Mate! <span class="theme-cl">How are you?</span></h2>
                        </div>

                        <form>

                            <div class="form-group">
                                <label>User Name</label>
                                <input type="email" class="form-control" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="*******">
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="*******">
                            </div>

                            <div class="form-group">
                                <select class="form-control">
                                    <option data-placeholder="Register as a" class="chosen-select">Register As a</option>
                                    <option value="1">As a Guest</option>
                                    <option value="2">As a Owner</option>
                                </select>
                            </div>

                            <span class="custom-checkbox d-block">
                                <input id="select1" type="checkbox">
                                <label for="select1"></label>
                                Keep me Signed In
                            </span>

                            <div class="center">
                                <button id="login-btn" type="submit" class="btn btn-midium theme-btn btn-radius width-200"> Login </button>
                            </div>

                        </form>

                        <div class="connect-with">
                            <ul>
                                <li class="fb-ic"><a href="#"><i class="ti-facebook"></i></a></li>
                                <li class="gp-ic"><a href="#"><i class="ti-google"></i></a></li>
                                <li class="tw-ic"><a href="#"><i class="ti-twitter"></i></a></li>
                            </ul>
                        </div>

                        <div class="center mrg-top-5">
                            <div class="bottom-login text-center">Already have an account?</div>
                            <a href="javascript:void(0)" class="theme-cl" data-toggle="modal" data-dismiss="modal" data-target="#signin">Login</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- ===================== End Login & Sign Up Window =========================== -->

        {{-- @include('layout_client.scroller') --}}

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

        <!-- Custom Js -->
        <script src="{{ asset('assets_client/js/custom.js') }}"></script>

    </div>
</body>

</html>
