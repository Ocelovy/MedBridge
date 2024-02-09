<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MedBridge</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('.images/meds.png') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA76F8DVVojuWMWiiBdGg5STY6tPn3RlAwcallback=initMap"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/particles.js', 'resources/js/app.particles.js'])

</head>
<body>
    @yield('background')

    <div id="app">
        <div id="particles-js">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">

                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('.images/ZILPO.png') }}" alt="logo_zilpo" class="logo-img me-2">
                    <span class="d-none d-md-inline">{{ config('MedBridge', 'MedBridge') }}</span>
                </a>

                <div class="navbar-icons">
                    <div class="navbar-support-phone" title="Telefónne číslo podpory">
                         <i class="fas fa-phone"></i>
                        <span class="phone-number-tooltip">+421 948 001 556</span>
                    </div>

                    <a href="mailto:peter.hromada@example.com" class="navbar-support-link" title="Kontakt na podporu">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <a class="nav-link" href="{{ route('user.index') }}">{{__('Používatelia')}}</a>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('comment') }}">Komentáre</a>
                        </li>
                        @endauth
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Odhlásiť sa') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                        @endguest

                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Žilpo
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('fotogaleria') }}">Fotogaléria</a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('pacient') }}">Pridať pacienta</a></li>

                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('success'))
                <div id="flash-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

        <div class="bottom-panel">
            <span id="current-time"></span>
            <a>Copyright © 2024 MedBridge</a>
            <a href={{ route('kontakt') }}>Kontakt</a>
        </div>
        </div>
    </div>
</body>
</html>
