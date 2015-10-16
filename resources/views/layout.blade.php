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
						<li class="dropdown" dropdown>
							<a href="#" class="dropdown-toggle" role="button" dropdown-toggle>
								{{ currentUser.first_name +' '+currentUser.last_name }}
								<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="simple-dropdown">
									<li role="menuitem"><a ng-click="logout()">Cerra Sesión</a></li>
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

			<script type="text/ng-template" id="modalShowCitizen-template">
				<section class="modal-header">
					<button type="button" class="close" ng-click="close()">×</button>
					<h4 class="modal-title">Solicitante</h4>
				</section>
				<section class="modal-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="identification"><strong>Cédula:</strong></label>
						<div class="col-sm-9">
							<label class="form-label">{{ applicant.identification }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="first_name"><strong>Nombres:</strong></label>
						<div class="col-lg-9">
							<label class="form-label" for="first_name">{{ applicant.first_name }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="last_name"><strong>Apellidos:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.last_name }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="address"><strong>Dirección:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.address }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="number_phone"><strong>Teléfono:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.prefix_phone }} - {{ applicant.number_phone }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="parish"><strong>Parroquia:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.parish }}</label>
						</div>
					</div>
				</section>
				<section class="modal-footer">
					<button class="btn btn-sm btn-warning" type="button" ng-click="close()">Cerrar</button>
				</section>
			</script>

			<script type="text/ng-template" id="modalShowInstitution-template">
				<section class="modal-header">
					<button type="button" class="close" ng-click="close()">×</button>
					<h4 class="modal-title">Solicitante</h4>
				</section>
				<section class="modal-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="identification"><strong>RIF:</strong></label>
						<div class="col-sm-9">
							<label class="form-label">{{ applicant.identification }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="first_name"><strong>Nombres:</strong></label>
						<div class="col-lg-9">
							<label class="form-label" for="first_name">{{ applicant.first_name }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="last_name"><strong>Apellidos:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.last_name }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="address"><strong>Dirección:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.address }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="number_phone"><strong>Teléfono:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.prefix_phone }} - {{ applicant.number_phone }}</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" for="parish"><strong>Parroquia:</strong></label>
						<div class="col-lg-9">
							<label class="form-label">{{ applicant.parish }}</label>
						</div>
					</div>
				</section>
				<section class="modal-footer">
					<button class="btn btn-sm btn-warning" type="button" ng-click="close()">Cerrar</button>
				</section>
			</script>
		</body>
		</html>
