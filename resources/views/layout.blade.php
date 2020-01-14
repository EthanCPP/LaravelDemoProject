<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title') | Demo</title>
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
		@yield('css')
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="nav">
			<div class="nav-wrapper">
				<a href="/" class="nav-title">Laravel Demo</a>
				<div class="nav-links">
					<a href="/" class="nav-link {{ Request::path() === '/' ? 'active' : '' }}">Home</a><a href="/guestbook" class="nav-link {{ Request::path() === 'guestbook' ? 'active' : '' }}">Guestbook</a>
				</div>
			</div>
		</div>
		<div class="content">
			@yield('content')
		</div>
	</body>
</html>
