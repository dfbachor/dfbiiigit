<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ app('system')->companyName }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">    <link href="{{ asset('css/dfb.css') }}" rel="stylesheet"> --}}
    
    <link href="{{ asset('css/dfb.css') }}" rel="stylesheet">
   

    @yield('styles') 
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- need to get the log inage working without changing the nvabar size --}}
                        {{-- @if(app('system')->companyName == null || app('system')->companyName == "")
                            <img src="{{ route('image', ['filename' => 'system_1_1_default.png']) }}" style="width: 35px; height: 35px" class="img-rounded imgPopup img-responsive">
                        @else
                            <img src="{{ route('image', ['filename' => app('system')->companyName]) }}" style="width: 35px; height: 35px" class="img-rounded imgPopup img-responsive">
                        @endif --}}
                    
                        {{ app('system')->companyName }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if(Auth::check())
                            <li><a class="menu" href="/community"><img src="/img/communityTree.jpg" height="30" width="30" /></a></li>
                            <li><a class="menu" href="/plants">Plants</a></li>
                            <li><a class="menu" href="/strains">Plant Types</a></li>
                            <li><a class="menu" href="/rooms">Rooms</a></li>
                            <li><a class="menu" href="/users">Users</a></li>
                            <li><a class="menu" href="/tasks">Tasks</a></li>
                            <li><a class="menu" href="/system">System</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom navbar-custom myFooter">
        <!--   <div class="container"> -->
            @copywrite dfbiii.com - All Rights Reserved
        <!--   </div> -->
    </nav>

    @include('imageModel')


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
            if('{{ Auth::user() ? Auth::user()->role : "u" }}' == 'a') {
                $(".admin").show();
            } else {
                $(".admin").hide();
            }
    </script>
    <script src="/js/dfbiii.js"></script>

    @yield('javascripts')
</body>
</html>
