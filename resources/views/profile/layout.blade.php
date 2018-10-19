<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/dark.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/magnific-popup.css')}}" type="text/css" />
    <script type="text/javascript" src="{{URL::asset('/js/jquery.js')}}"></script>

    <!-- Star Rating CSS -->
    <link rel="stylesheet" href="{{URL::asset('/css/components/bs-rating.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('/css/responsive.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <!-- Document Title
    ============================================= -->
    <title> @yield('title')</title>

</head>

<body class="stretched ">


<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <header   id="header" class="transparent-header ">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <img src="{{ URL::asset('/images/logo 2.png')}}" alt="3aNota Logo"></a>
                </div><!-- #logo end -->

                <div id="top-account" class="dropdown">

                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-user"> {{ Auth::user()->name }}</i><i class="icon-angle-down"></i>  </a>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li><a href="{{ route('profile.show',['id'=> Auth::user()->id])}}">Profile</a></li>
                        <li><a href="{{route('dashboard')}}">DashBoard</a></li>
                        <li><a href="{{ route('profile.edit',['id'=> Auth::user()->id]) }}">Edit Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{__('Logout') }} <i class="icon-signout"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </ul>
                </div>
            </div>
        </div>
    </header><!-- #header end -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="row clearfix">
                    <div class="col-sm-9">

                        @yield('content')
                        @yield ('notifications')
                        @yield('search')
                        @yield('dashboard')
                        @yield('profile')
                        @yield('editprofile')

                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Footer
		============================================= -->
    <footer id="footer" >
        <div id="copyrights">
            <div class="container-fluid center">

                Copyrights &copy; 3aNota 2018 | All Rights Reserved

            </div>
        </div>
    </footer><!-- #footer end -->

</div>

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>


<!-- External JavaScripts
============================================= -->

<script type="text/javascript" src="{{URL::asset('/js/plugins.js')}}"></script>

<!-- Star Rating Plugin -->
<script type="text/javascript" src="{{URL::asset('/js/components/star-rating.js')}}" ></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="{{URL::asset('/js/functions.js')}}"></script>


<script>

        jQuery("#tabs-profile").on("tabsactivate", function (event, ui) {
            jQuery('.flexslider .slide').resize();
        });

</script>

</body>
</html>