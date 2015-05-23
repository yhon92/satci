<!DOCTYPE html>
<html lang="es" ng-app="SATCI">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
	<title>Sistema de Atención al Ciudadano</title>
	
	<base href="/satci/public/">
	
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	{{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body class="ng-scope">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<img src="{{ asset('/img/logo_small.png') }}" alt="Sistema de Atencion al Ciudadano" width="60">
						<span>SATCI</span>
					</a>
				</div>
				@if (Auth::check())
				<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
{{-- 						<li><a href="{{ url('/') }}">Inicio</a></li>
						<li><a href="{{ route('solicitude.index') }}">Solicitud</a></li> --}}
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->full_name }}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Cerra Sesión</a></li>
							</ul>
						</li>
					</ul>
				</div>
				@endif
			</div>
		</nav>
		<div class="container-fluid" ng-controller="NavCtrl">
			<div class="row">
				@if (Auth::check())
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li ng-class="navClass('home')"><a href="home/">Inicio</a></li>
						<li ng-class="navClass('solicitude')"><a href="solicitude/">Solicitud</a></li>
						{{-- <li><a href="#">Analytics</a></li> --}}
						<li ng-class="navClass('admin')"><a href="{{ route('admin.users.index') }}">Administrador</a></li>
					</ul>
{{-- 					<ul class="nav nav-sidebar">
						<li><a href="">Nav item</a></li>
						<li><a href="">Nav item again</a></li>
						<li><a href="">One more nav</a></li>
						<li><a href="">Another nav item</a></li>
						<li><a href="">More navigation</a></li>
					</ul> --}}
{{--           <ul class="nav nav-sidebar">
						<li><a href="">Nav item again</a></li>
						<li><a href="">One more nav</a></li>
						<li><a href="">Another nav item</a></li>
					</ul>
				</div> --}}
				
			</div>
			@endif
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				@yield('content')
			</div>
		</div>
		<!-- Scripts -->
		{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
		<script src="{{ asset('js/libs/jquery.min.js') }}"></script>
		<script src="{{ asset('js/libs/bootstrap.min.js') }}"></script>
		{{-- <script src="{{ asset('js/lib/moment.js') }}"></script> --}}
		<script src="{{ asset('js/libs/angular.min.js') }}"></script>
		<script src="{{ asset('js/libs/angular-route.min.js') }}"></script>
		<script src="{{ asset('js/libs/angular-resource.min.js') }}"></script>
		<script src="{{ asset('js/libs/angular-animate.min.js') }}"></script>
		<script src="{{ asset('js/libs/ui-bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/libs/ui-utils.min.js') }}"></script>
		<script src="{{ asset('js/libs/ui-utils-masks.min.js') }}"></script>
		<script src="{{ asset('js/libs/smart-table.min.js') }}"></script>
		<script src="{{ asset('js/validation.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/filters.js') }}"></script>
		<script src="{{ asset('js/controllers/controllers.js') }}"></script>
		<script src="{{ asset('js/directives/directives.js') }}"></script>
		<script src="{{ asset('js/services/resources.js') }}"></script>
		<script src="{{ asset('js/services/services.js') }}"></script>

		@yield('scripts')
	</body>
	</html>
