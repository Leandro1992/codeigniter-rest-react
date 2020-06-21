<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Connect Clothes') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/'.app()->getLocale()) }}">
                    <img class="brand" src="https://d293isj6nw1n53.cloudfront.net/images/brand-black.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }} </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register', app()->getLocale()) }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/'.app()->getLocale()) }}" >{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url(app()->getLocale()).'/store' }}">{{ __('Store') }}</a>
                            </li>
                            @if(Auth::user()->roles->pluck('name')->contains('admin') || Auth::user()->roles->pluck('name')->contains('seller')) 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url(app()->getLocale()).'/product' }}">{{ __('Products') }}</a>
                            </li>
                            @endif
                            @if(Auth::user()->roles->pluck('name')->contains('admin')) 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url(app()->getLocale()).'/stock' }}">{{ __('Stock') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url(app()->getLocale()).'/dashboard' }}">{{ __('Dashboard') }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                <a class="dropdown-item" href="{{ route('admin.users.index', app()->getLocale())}}">
                                    @if(Auth::user()->roles->pluck('name')->contains('admin')) Manager Users @else Profile @endif 
                                </a>
                                    <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <language-switcher 
                locale="{{ app()->getLocale() }}"
                link-pt='pt_br'
                link-en="en"
            ></language-switcher>
        </nav>

        <main>
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
