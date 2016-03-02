<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My website - @yield('title')</title>
    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>--}}

    <!-- Styles -->
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-rtl.min.css') !!}
    {!! Html::style('css/app.css') !!}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        .no-btn {
            border:none;
            background-color: transparent;

        }
        .no-btn:hover{
            color: #b95126;
        }
    </style>

</head>
<body id="app-layout">
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {!! Html::image('images/logo.jpg','logo') !!}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            <li>{!! link_to_route('admin.dashboard', trans('nav.dashboard')) !!}</li></ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<header class="site-header">

    <a href=""><p class="header-subtitle">{{ trans('home.site-title') }}</p></a>
    <h1>site title</h1>
    <ul class="header-subnav list-unstyled">
        <li><a>{{ trans('home.large-box-type-services') }}</a></li>
        <li><a>{{ trans('home.large-box-books-services') }}</a></li>
        <li><a>{{ trans('home.large-box-isi-services') }}</a></li>
        <li><a>{{ trans('home.large-box-thesis-services') }}</a></li>
    </ul>

</header>


<div class="container">@yield('content')</div>

<footer>
    <div class="container">
        <div class="row p3">
            <div class="col-md-4">
                <p class="subfooter-title"><span class="glyphicon glyphicon-home p5p"></span> {{ trans('footer.contact-methods') }}</p>
                <ul class="list-pad list-unstyled">
                    <li>address</li>
                    <li>phone</li>
                    <li>fax</li>
                    <li>mobile</li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="subfooter-title"><span class="glyphicon glyphicon-list p5p"></span> {{ trans('footer.rapid-access') }}</p>
                <ul class="list-pad list-unstyled">
                    <li>ISI acception steps</li>
                    <li>ISI acception steps</li>
                    <li>ISI acception steps</li>
                    <li>ISI acception steps</li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="subfooter-title"><span class="glyphicon glyphicon-tag p5p"></span> {{ trans('footer.newsletter') }}</p>
                <p class="subfooter-des"> {{ trans('footer.newsletter-description') }}</p>
                <div class="form-inline">
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail"
                               placeholder="{{ trans('footer.email-address') }}">
                    </div>
                    <button type="submit" class="btn btn-warning">{{ trans('footer.subscribe') }}</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScripts -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
@yield('footer')
</body>
</html>