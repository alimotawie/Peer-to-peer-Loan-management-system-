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
    <link rel="stylesheet" href="{{ URL::asset('/css/swiper.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/dark.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/font-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/css/magnific-popup.css')}}" type="text/css" />

    <!-- Star Rating CSS -->
    <link rel="stylesheet" href="{{URL::asset('/css/components/bs-rating.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('/css/responsive.css')}}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <!-- Document Title
    ============================================= -->
    <title> {{Auth::user()->name .' | Dashboard'}}</title>

</head>

<div class="stretched side-header">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix col-4">

    <!-- Header
    ============================================= -->
    <header id="header" class="no-sticky">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo" class="nobottomborder">
                    <a href="" class="standard-logo"><img src="{{asset('images/logo 2.png')}}"  alt="3aNota Logo"></a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu">
                    <ul>
                        <li><a href="{{route('showpeers')}}"><i class="icon-rss"></i> Peers  Requests </a></li>
                        <li><a href="{{ route('loanrequest.show',['id' =>Auth::user()->id])}}"><i class="icon-pencil2"></i> My Requests </a></li>
                        <li><a href="{{route('mynetwork')}}"><i class="icon-users"></i>  Network </a></li>
                        <li><a href="{{route('transactions')}}"><i class="icon-reply"></i> Transactions </a></li>
                        <li><a href="{{route('payback')}}"><i class="icon-users"></i> Payback Schedules </a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="promo promo-light promo-border promo-mini header-stick ">

        <div class="container-fluid ">

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


            <div id="top-account" class="dropdown" >

                <a href="#" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-bell"> {{Auth::user()->Notifications->count()}}</i><i class="icon-angle-down"></i>  </a>

                @if(Auth::user()->Notifications->count()>0)
                <ul class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenu2" style="width: 300px; overflow-y: auto; height: 200px;">

                    @foreach(Auth::user()->Notifications as $key => $notify)
                        <li>
                            @foreach($notify->data as $key =>$value)

                                @if($key =='rate'|| $key=='review')

                                     {{$key }} : {{$value}} <br>
                                @elseif ($key =='loanID' )
                                <a href="{{route('loandetails',['loanid'=>$value])}}">
                                @elseif($key =='amount' )
                                        You received {{$value}}

                                @elseif($key =='from' )
                                    From {{App\User::find($value)->name}}<br> </a>
                                @elseif($key =='deadline' )
                                    {{$value}}
                                @else
                                    No Notifications
                                @endif
                            @endforeach
                        </li>

                            {!! Form::open([ 'route'=>['notifyClear','id'=>$notify->id], 'method'=>'get']) !!}
                            {!!  Form::submit('Delete Notification',['class'=>'button button-3d button-mini button-rounded button-red']) !!}
                            {!! Form::close() !!}
                        <li role="separator" class="divider"></li>
                            @endforeach

                    <li>
                        @if(Auth::user()->Notifications->count()>0)
                            {!! Form::open([ 'route'=>'notifyClear', 'method'=>'get']) !!}
                            {!!  Form::submit('Clear Notifications' ,['class'=>'button button-3d button-mini button-rounded button-red']) !!}
                            {!! Form::close() !!}
                        @endif
                        </li>
                </ul>
                    @endif

            </div>


        </div>
    </div>




    @yield('dashboard')
 @yield('mypeers')
@yield('searchbar')
   @yield('loanrequest')
    @yield('peersloan')
    @yield('loandetails')
    @yield ('trans')
    @yield ('payback')


</div>
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
<script type="text/javascript" src="{{URL::asset('/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/plugins.js')}}"></script>

<!-- Star Rating Plugin -->
<script type="text/javascript" src="{{URL::asset('/js/components/star-rating.js')}}" ></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="{{URL::asset('/js/functions.js')}}"></script>

</body>
</html>