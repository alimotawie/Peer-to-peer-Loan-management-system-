<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Poppins:300,400,400italic,600,700|Montserrat:400,700|Merriweather" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/dark.css')}}" type="text/css" />

    <!-- Media Agency Demo Specific Stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('/css/app-landing.css')}}" type="text/css" />
    <!-- / -->

    <link rel="stylesheet" href="{{ URL::asset('/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/et-line.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/magnific-popup.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('/css/fonts.css')}}" type="text/css" />

    <!-- Bootstrap Switch CSS -->
    <link rel="stylesheet" href="{{ URL::asset('/css/components/bs-switches.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('/css/responsive.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{ URL::asset('/css/colors.css')}}" type="text/css" />
    <!-- ADD-ONS CSS FILES -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/include/rs-plugin/css/addons/revolution.addon.particles.css')}}">

    <!-- Document Title
    ============================================= -->
    <title> @yield('title')</title>


</head>

<body class="stretched">
<!-- Document Wrapper
	============================================= -->
<div id="wrapper" class="clearfix" >

    <!-- Header
    ============================================= -->
    <header id="header" class="split-menu " data-sticky-class="not-dark" data-responsive-class="not-dark">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="{{ route('landing') }}" class="standard-logo" data-dark-logo="{{ URL::asset('/images/logo 2.png')}}"><img src="{{ URL::asset('/images/logo 2.png')}}" alt="3aNota Logo"></a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu" class="with-arrows clearfix not-dark">

                    <ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1250" data-offset="160" >
                        <li><a href="{{route('landing').'#home'}}" data-href="{{route('landing').'#home'}}"><div>Home</div></a></li>
                        <li><a href="{{route('landing').'#Services'}}" data-href="{{route('landing').'#Services'}}" ><div>Services</div></a> </li>
                        <li><a href="{{route('landing').'#Features'}}"  data-href="{{route('landing').'#Features'}}"><div>Features</div></a> </li>
                        <li><a href="{{route('landing').'#How'}}" data-href="{{route('landing').'#How'}}"><div>How it works</div></a></li>
                    </ul>

                    <ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1250" data-offset="160">

                        <li><a href="{{route('landing').'#FAQs'}}" data-href="{{route('landing').'#FAQs'}}"><div>FAQs</div></a></li>
                        <li><a href="{{route('landing').'#Contact'}}" data-href="{{route('landing').'#Contact'}}"><div>Contact us</div></a></li>
                        @if(!Auth::user())
                            <li class="menu-item-emphasis"> <a href="{{route('login')}}" ><div>Login</div></a></li>
                            <li class="menu-item-emphasis"> <a href="{{route('register')}}" ><div>Register</div></a></li>
                        @else
                            <li class="menu-item-emphasis"> <a href="{{route('home')}}" ><div>DashBoard</div></a></li>
                        @endif
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </header><!-- #header end -->

    <section id="content">
        <div class="container clearfix">

            <div id="section-nextgen" class="page-section bottommargin-lg">
                <div class="row clearfix" id="Services">


    @yield ('content')
    @yield('signin')
    @yield('terms')


    @yield ('Signup')

    @yield ('profilepage')
    @yield ('calculations')

        </div>

    </div>
        </div>
</section>
</div>


    <div class="line"></div>
    <!-- Footer
    ============================================= -->
    <footer class="topmargin-lg" style="background-color:#FFF;">

        <div class="container">

            <!-- Footer Widgets
            ============================================= -->
            <div class="footer-widgets-wrap clearfix">
                <div class="row clearfix">

                    <div class="col-md-8">

                        <div class="widget clearfix">
                            <div class="row clearfix">
                                <div class="col-md-8 bottommargin-sm clearfix" style="color:#888;">
                                    <img src="{{ URL::asset('/images/footer-logo.png')}}" alt="3aNota Logo" style="display: block;" class="bottommargin-sm">
                                    <p> 3aNota is an Online Platform that connects borrowers with lenders creating a peer to peer lending network.
                                        <br> We are Digitizing  the  process of lending and borrowing.
                                        Join the biggest peer to peer Social lending network in Egypt NOW</p>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2 bottommargin-sm">
                        <div class="widget clearfix">
                            <div class="row clearfix">

                                <div class="widget widget_links app_landing_widget_link clearfix">
                                    <h4>About Us</h4>

                                    <ul>
                                        <li><a href="http://codex.wordpress.org/">About 3aNota</a></li>
                                        <li><a href="http://wordpress.org/support/forum/requests-and-feedback"> Contact Us </a></li>
                                        <li><a href="http://wordpress.org/extend/plugins/"> Blog </a></li>
                                        <li><a href="http://wordpress.org/extend/plugins/">Get A Loan</a></li>
                                        <li><a href="http://wordpress.org/support/">Career</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 bottommargin-sm">
                        <div class="widget clearfix">
                            <div class="row clearfix">

                                <div class="widget widget_links app_landing_widget_link clearfix">
                                    <h4>Support</h4>

                                    <ul>
                                        <li><a href="http://codex.wordpress.org/">Safety Rules</a></li>
                                        <li><a href="http://wordpress.org/extend/themes/">Terms and Conditions</a></li>
                                        <li><a href="http://wordpress.org/extend/themes/">Privacy Policy</a></li>
                                        <li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Copyrights
                ============================================= -->
                <div id="copyrights" class="nobg notoppadding ">

                    <div class="container clearfix center">

                        <div class="col-md-12 ">
                            Copyrights &copy; 2018 All Rights Reserved by 3aNota Inc.<br>
                            <div class="copyright-links"><a href="{{route('terms')}}">Terms of Use</a> / <a href="{{route('policy')}}}">Privacy Policy</a></div>
                        </div>
                    </div>

                </div><!-- #copyrights end -->
            </div>
        </div>
    </footer><!-- #footer end --> <!-- #wrapper end -->



    <!-- Go To Top
    ============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="{{ URL::asset('/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/plugins.js')}}"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="{{ URL::asset('/js/functions.js')}}"></script>

</body>
</html>






