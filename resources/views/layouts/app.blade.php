<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Buudu') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <div id="app">
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ url('/') }}">{{ config('app.name', 'Buudu') }}</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @yield('search')

            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    @endguest
                    @auth
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </li>
            </ul>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        @auth
                        <x-menu-block name="{{ Auth::user()->name }}">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">
                                    <span data-feather="plus-square"></span>
                                    {{ __('My dashboard') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('profile') }}">
                                    <span data-feather="plus-square"></span>
                                    {{ __('My profile') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('tokens') }}">
                                    <span data-feather="plus-square"></span>
                                    {{ __('My tokens') }}
                                </a>
                            </li>
                        </x-menu-block>
                        @endauth

                        <x-menu-block name="Navigation">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('/') }}">
                                    <span data-feather="home"></span>
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('countries.index') }}">
                                    <span data-feather="map"></span>
                                    {{ __('Countries') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('regions.index') }}">
                                    <span data-feather="map"></span>
                                    {{ __('Regions') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('provinces.index') }}">
                                    <span data-feather="map"></span>
                                    {{ __('States / Provinces') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('local_government_areas.index') }}">
                                    <span data-feather="map"></span>
                                    {{ __('Local Government Area') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('cities.index') }}">
                                    <span data-feather="map"></span>
                                    {{ __('Cities') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('villages.index') }}">
                                    <span data-feather="map"></span>
                                    {{ __('Villages') }}
                                </a>
                            </li>

                            @can('superuser')
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('users.index') }}">
                                    <span data-feather="users"></span>
                                    {{ __('Users') }}
                                </a>
                            </li>
                            @endcan

                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <span data-feather="log-in"></span>
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endguest
                        </x-menu-block>


                        <x-menu-block name="{{ __('Language') }}">
                            <li class="nav-item">
                                <a class="nav-link @if(app()->getLocale() === 'en') disabled active @endif" aria-current="page" href="{{ route('locale') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('locale-form-en').submit();">
                                    <span data-feather="plus-square"></span>
                                    {{ __('English') }}
                                </a>

                                <form id="locale-form-en" action="{{ route('locale') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input name="locale" value="en" type="hidden">
                                </form>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if(app()->getLocale() === 'fr') disabled active @endif" aria-current="page" href="{{ route('locale') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('locale-form-fr').submit();">
                                    <span data-feather="plus-square"></span>
                                    {{ __('French') }}
                                </a>

                                <form id="locale-form-fr" action="{{ route('locale') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input name="locale" value="fr" type="hidden">
                                </form>
                            </li>
                        </x-menu-block>

                        @yield('tools')
                    </div>
                </nav>

                <main class="col-md-9 ml-sm-auto col-lg-10 p-0">

                    @include('flash::message')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('content')

                    <footer class="footer mt-auto py-3 bg-light">
                        <div class="container">
                            <span class="text-muted">{{__('Developed by Nascent Africa')}}</span>
                        </div>
                    </footer>
                </main>
            </div>
        </div>
    </div>

    <script>
        window.locale = @json(app()->getLocale())
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
