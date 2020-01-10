@section('')
    
@endsection

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/base.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">

        <link rel="icon" href="{{ asset('img/logo.jpg') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/vue.js') }}"></script>
        
        @if(Auth::user())
            <link href="{{ asset(Auth::user()->preferencias->estilo) }}" rel="stylesheet">
        @else
            <link href="{{ asset(config('app.style')) }}" rel="stylesheet">
        @endif
        
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>        
        @yield('scriptsHeader')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        @if( config('app.logo') == '')
                            <a href="/"><img class="logo default_logo"></a>
                        @else
                            <a href="/"><img src="{{asset( config('app.logo'))}}" class="logo"></a>
                        @endif
                        <!-- Collapsed Hamburger -->
                        
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!--
                            <li class="activ">
                                <a class="nav-link active" href="{{ url('/#') }}">Menu 1</a>
                            </li>
                            <li>
                                <a class="nav-link active" href="{{ url('/#') }}">Menu 2</a>
                            </li>
                            <li>
                                <a class="nav-link active" href="{{ url('/#') }}">Menu 3</a>
                            </li>
                            -->

                            <!-- Authentication Links -->                            
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">No has iniciado sesión</a></li>
                            @else
                                <li>
                                    <a href="#" class="btn" data-toggle="modal" data-target="#NotificacionesStock">
                                        @if(session('notificaciones'))
                                            <label id="total_notificaciones">
                                                {{session('notificaciones')->count()}}
                                                @if(session('notificaciones')->count() > 0)
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                @endif
                                            </label>
                                        @endif
                                    </a>
                                </li>
                                
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="/ajustes">
                                                <i class="fa fa-cog" aria-hidden="true"></i>
                                                Ajustes
                                            </a>                                            
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                Cerrar sesión
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>                                        
                                    </ul>
                                </li>                                
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            @include('partials.notificaciones_box')
        <div id="wrapper" class="page-wrapper">
            @yield('content')
        </div>        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    </body>
</html>