<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('images/cos_favicon.png') }}">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Font Awesome Icons -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		<!-- COS Image -->
		<header>
			<img id="cos_header" class="img-responsive mx-auto d-block" src="{{ asset('images/cos_header2.png') }}" />
		</header>

		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					Chatsmith Online Services
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
								<a id="leadformsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									Leadforms
								</a>

								<div id="header-navbar-left" class="dropdown-menu dropdown-menu-left" aria-labelledby="leadformsDropdown">
									<a class="dropdown-item" href="#">Focal Leadform</a>
									<a class="dropdown-item" href="#">Plate IQ Leadform</a>
									<a class="dropdown-item" href="#">PersistIQ Leadform</a>
									<a class="dropdown-item" href="#">Smart Alto Leadform</a>
								</div>

						</li>
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
						<li class="nav-item dropdown">
							<a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							@if (auth()->user()->image)
								<img src="{{ asset(auth()->user()->image) }}" class="img-thumbnail rounded-circle avatar-thumbnail-extrasmall">
							@endif
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div id="header-navbar-right" class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="/profile">Profile</a>
								<a class="dropdown-item" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
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
