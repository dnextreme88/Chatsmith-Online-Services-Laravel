<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/cos_favicon.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Libs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.js" integrity="sha512-Ktf+fv0N8ON+ALPwyuXP9d8usxLqqPL5Ox9EHlqxehMM+h1wIU/AeVWFJwVGGFMddw/67P+KGFvFDhZofz2YEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js" integrity="sha512-64O4TSvYybbO2u06YzKDmZfLj/Tcr9+oorWhxzE3yDnmBRf7wvDgQweCzUf5pm2xYTgHMMyk5tW8kWU92JENng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js" integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bootstrap 4 Datepicker - https://gijgo.com/datepicker/example/bootstrap-4 -->
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-md">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Chatsmith Online Services</a>

                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".header-links" aria-controls="header-links" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse header-links">
                    <!-- Left Side of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="leadformsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Leadforms</a>

                            <div id="header-navbar-left" class="dropdown-menu dropdown-menu-left" aria-labelledby="leadformsDropdown">
                                <a class="dropdown-item" href="{{ route('focal_leadform') }}">Focal Leadform</a>
                                <a class="dropdown-item" href="{{ route('chat_account_leadform') }}">Live Chat / Smart Alto / PersistIQ Leadform</a>
                                <a class="dropdown-item" href="{{ route('plate_leadform') }}">Plate IQ Leadform</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('schedules.index') }}">COS Schedule</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('daily_productions') }}">Daily Productions</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Daily Tasks</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown" id="navbar-user-dropdown">
                            <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (auth()->user()->image)
                                <img src="{{ asset(auth()->user()->image) }}" class="img-thumbnail rounded-circle avatar-thumbnail-extrasmall">
                            @endif
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <div id="header-navbar-right" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-6">
            @yield('content')
        </main>

        <footer class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-unstyled">
                        <li class="list-item"><a href="/aboutus/">About Us</li>
                        <li class="list-item"><a href="/careers/">Careers</a></li>
                        <li class="list-item"><a href="/privacy/">Privacy Policy</a></li>
                        <li class="list-item"><a href="/terms/">Terms and Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <p>Chatsmith Online Services Copyright &copy; 2020</p>
                    </div>
                    <!-- Social links -->
                    <div class="col-md-12">
                        <a href="https://www.facebook.com/Chatsmithonline" target="_blank"><img src="{{ asset('images/social_facebook.png') }}"class="socials" id="fb" alt="Facebook logo" title="FB page" /></a>
                        <a href="https://twitter.com/chatsmithonline" target="_blank"><img src="{{ asset('images/social_twitter.png') }}"class="socials" id="twitter" alt="Twitter logo" title="Twitter page" /></a>
                    </div>
                    <!-- Affliates -->
                    <div class="col-md-12">
                        <p id="affliates-text">Affliates</p>
                        <a href="https://focal.systems/" target="_blank"><img src="{{ asset('images/logo_focal_systems.png') }}"class="affliate-logos" id="logo-focal-systems" alt="Focal Systems logo" title="Focal Systems page" /></a>
                        <a href="https://www.persistiq.com/" target="_blank"><img src="{{ asset('images/logo_persistiq.png') }}"class="affliate-logos" id="logo-persistiq" alt="PersistIQ logo" title="PersistIQ page" /></a>
                        <a href="https://www.plateiq.com/" target="_blank"><img src="{{ asset('images/logo_plateiq.png') }}"class="affliate-logos" id="logo-plateiq" alt="Plate IQ logo" title="Plate IQ page" /></a>
                        <a href="https://www.smartalto.com/" target="_blank"><img src="{{ asset('images/logo_smart_alto.png') }}"class="affliate-logos" id="logo-smart-alto" alt="Smart Alto logo" title="Smart Alto page" /></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
