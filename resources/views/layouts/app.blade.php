<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<!-- Styles -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="app">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="/">{{ trans('cinema.films') }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/">{{ trans('cinema.actors') }}</a>
						</li>
						@if (Route::has('login'))
						<li class="nav-item">
							@auth
							<a class="nav-link" href="{{ route('admin_film_list') }}">{{ trans('cinema.admin_panel') }}</a>
							@else
							<a class="nav-link" href="{{ route('login') }}">{{ trans('cinema.login') }}</a>
							@endauth
						</li>
						@endif
					</ul>
				</div>
			</nav>

			<main class="py-4">
				@yield('content')
			</main>
		</div>

		<!-- Scripts -->
		<script type="text/javascript" src='https://code.jquery.com/jquery-latest.min.js'></script>
		<script type="text/javascript" src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'></script>
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
		@section('footer_script')
		@show
	</body>
</html>
