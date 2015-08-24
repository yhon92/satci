<!DOCTYPE html>
<html lang="es" ng-app="SATCI">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<% asset('favicon.ico') %>">
	<title>Sistema de Atención al Ciudadano</title>
	<base href="/">

	<link href="<% asset('/css/app.css') %>" rel="stylesheet">

	<!-- Fonts -->
	<%-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --%>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation" ng-controller="NavCtrl">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">
						<img src="<% asset('/img/logo_small.png') %>" alt="Sistema de Atencion al Ciudadano" width="60">
						<span>SATCI</span>
					</a>
				</div>
				<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" ng-if="authenticated">
					<ul class="nav navbar-nav">
						<li ng-class="navClass('home')"><a ui-sref="home">Inicio</a></li>
						<li ng-class="navClass('solicitude')"><a ui-sref="solicitude">Solicitud</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right" ng-if="authenticated">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ currentUser.first_name +' '+currentUser.last_name }}
								<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a ng-click="logout()">Cerra Sesión</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="container-fluid">
				<div class="row">
					<%-- <div class="col-sm-3 col-md-2 sidebar" ng-controller="SidebarCtrl" ng-if="authenticated">
						<ul class="nav nav-sidebar">
							<li ng-class="navClass('home')"><a ui-sref="home">Inicio</a></li>
							<li ng-class="navClass('solicitude')"><a ui-sref="solicitude">Solicitud</a></li>
						</ul>				
					</div> --%>
					<section ui-view></section>
				</div>
			</div>
			<!-- Scripts -->
			<%-- <script src="<% asset('js/libs.js') %>"></script> --%>
			<script src="<% asset('js/app.js') %>"></script>

		</body>
		</html>
