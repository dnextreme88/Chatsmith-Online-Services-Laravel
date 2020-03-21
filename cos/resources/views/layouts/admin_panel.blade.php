<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@auth
		@if (auth()->user()->is_staff == 'True')
			<title>Admin Panel - @yield('title')</title>
		@else
			<title>@yield('title')</title>
		@endif
	@endauth
	@guest
		<title>@yield('title')</title>
	@endguest

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('images/cos_favicon.png') }}">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>

	<!-- Bootstrap 4 Datepicker - https://gijgo.com/datepicker/example/bootstrap-4 -->
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Font Awesome Icons -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">

	<style>
		html, body {
			height: 100%;
		}
	</style>
</head>
<body>
	<section class="container-fluid h-100">
	@auth
		@if (auth()->user()->is_staff == 'True')
			<div class="row h-100">
				<!-- Admin Panel Nav Links -->
				<div class="col-sm-4 col-xl-2" id="admin-panel-nav-links-body">
					<a href="/" alt="Chatsmith Online Services logo" title="Chatsmith Online Services logo"><img src="{{ asset('images/chatsmithonline-logo.png') }}" class="img-fluid mx-auto d-block" /></a>
					<ul id="admin-panel-nav-links" class="list-unstyled">
						<li class="list-item {{ (url()->current() == route('admin_panel_home')) ? 'active' : '' }}"><a href="/admin/"><i class="fa fa-home"></i> Admin Panel Home</a></li>
						<li class="list-item {{ (url()->current() == route('announcements.index')) ? 'active' : '' }}"><a href="/announcements/"><i class="fa fa-bullhorn"></i> Announcements</a></li>
						<li class="list-item {{ (url()->current() == route('employees.index')) ? 'active' : '' }}"><a href="/employees/"><i class="fa fa-id-card"></i> Employees</a></li>
						<li class="list-item {{ (url()->current() == route('schedules.index')) ? 'active' : '' }}"><a href="/schedules/"><i class="fa fa-calendar"></i> Schedules</a></li>
						<li class="list-item {{ (url()->current() == route('tasks.index')) ? 'active' : '' }}"><a href="/tasks/"><i class="fa fa-clipboard"></i> Tasks</a></li>
						<li class="list-item {{ (url()->current() == route('all_users')) ? 'active' : '' }}"><a href="/users/"><i class="fa fa-users"></i> Users</a></li>
						<li class="list-item">
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
						<hr id="admin-panel-hr-separator">
						<li class="list-item {{ (\Request::getRequestUri() == '/announcements/create/') ? 'active' : '' }}"><a href="/announcements/create/">Add Announcement</a></li>
						<li class="list-item {{ (\Request::getRequestUri() == '/employees/create/') ? 'active' : '' }}"><a href="/employees/create/">Add Employee</a></li>
						<li class="list-item {{ (\Request::getRequestUri() == '/schedules/create/') ? 'active' : '' }}"><a href="/schedules/create/">Add Schedule</a></li>
						<li class="list-item {{ (\Request::getRequestUri() == '/tasks/create/') ? 'active' : '' }}"><a href="/tasks/create/">Add Task</a></li>
					</ul>
				</div>
				<!-- Content -->
				<div class="col-sm-8 col-xl-10">@yield('content')</div>
			</div>
		@else
			<div class="h-100">@yield('content')</div>
		@endif
	@endauth
	@guest
		<div class="h-100">@yield('content')</div>
	@endguest
	</section>
</body>
</html>
