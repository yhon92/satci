<!DOCTYPE html>
<html lang="es" ng-app="SATCI">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<% asset('favicon.ico') %>">
	<title>Sistema de Atención al Ciudadano</title>
	<base href="/">
	
	@if ( Config::get('app.debug') )
		<link href="<% asset('css/app.css') %>" rel="stylesheet">
	@else
		<link href="<% elixir('css/app.css') %>" rel="stylesheet">
	@endif

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
				<button type="button" class="navbar-toggle collapsed" ng-show="authenticated" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
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
			<div class="navbar-collapse collapse" uib-collapse="navCollapsed" ng-if="authenticated">
				<ul class="nav navbar-nav">
					<li ng-class="navActive('home')"><a ui-sref="home">Inicio</a></li>
					<li ng-if="can('solicitude')" ng-class="navActive('solicitude')"><a ui-sref="solicitude">Solicitud</a></li>
					<li ng-if="can('applicant')" ng-class="navActive('applicant')" class="dropdown" uib-dropdown>
						<a class="dropdown-toggle" role="button" uib-dropdown-toggle>
							Solicitante
							<%-- <span class="caret"></span> --%>
						</a>
						<ul class="uib-dropdown-menu" role="menu" aria-labelledby="simple-dropdown" uib-dropdown-menu>
							<li role="menuitem"><a ui-sref="citizen">Natural</a></li>
							<li role="menuitem"><a ui-sref="institution">Jurídico</a></li>
						</ul>
					</li>
					<li ng-if="can('config')" ng-class="navActive('info')" class="dropdown" uib-dropdown>
						<a class="dropdown-toggle" role="button" uib-dropdown-toggle>
							Información
							<%-- <span class="caret"></span> --%>
						</a>
						<ul class="uib-dropdown-menu" role="menu" aria-labelledby="simple-dropdown" uib-dropdown-menu>
							<li role="menuitem"><a ui-sref="report">Reportes</a></li>
							<li class="divider"></li>
							<li role="menuitem"><a ui-sref="statistic">Estadísticas</a></li>
						</ul>
					</li>
					<li ng-if="can('config')" ng-class="navActive('config')" class="dropdown" uib-dropdown>
						<a class="dropdown-toggle" role="button" uib-dropdown-toggle>
							Configuración
							<%-- <span class="caret"></span> --%>
						</a>
						<ul class="uib-dropdown-menu" role="menu" aria-labelledby="simple-dropdown" uib-dropdown-menu>
							<li role="menuitem"><a ui-sref="category">Categoría</a></li>
							<li role="menuitem"><a ui-sref="theme">Tema</a></li>
							<li class="divider"></li>
							<li role="menuitem"><a ui-sref="area">Área</a></li>
							<li role="menuitem"><a ui-sref="director">Director</a></li>
							<li role="menuitem"><a ui-sref="means">Recurso</a></li>
						</ul>
					</li>
					<li ng-if="can('security')" ng-class="navActive('security')" class="dropdown" uib-dropdown>
						<a class="dropdown-toggle" role="button" uib-dropdown-toggle>
							Seguridad
							<%-- <span class="caret"></span> --%>
						</a>
						<ul class="uib-dropdown-menu" role="menu" aria-labelledby="simple-dropdown" uib-dropdown-menu>
							<li role="menuitem"><a ui-sref="user">Usuarios</a></li>
							<li role="menuitem"><a ui-sref="permission">Permisos</a></li>
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right" ng-if="authenticated">
					<li class="dropdown" uib-dropdown>
						<a class="dropdown-toggle" role="button" uib-dropdown-toggle>
							{{ currentUser.first_name +' '+currentUser.last_name }}
							<%-- <span class="caret"></span> --%>
						</a>
						<ul class="uib-dropdown-menu" role="menu" aria-labelledby="simple-dropdown" uib-dropdown-menu>
							<li role="menuitem"><a ng-click="logout()">Cerra Sesión</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<section ui-view></section>
		</div>
	</div>
	<!-- Scripts -->
	<%-- <script src="<% asset('js/libs.js') %>"></script> --%>
	@if ( Config::get('app.debug') )
		<script src="<% asset('js/app.js') %>"></script>
	@else
		<script src="<% elixir('js/app.js') %>"></script>
	@endif

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
				<label class="col-md-3 control-label" for="first_name"><strong>Nombres:</strong></label>
				<div class="col-md-9">
					<label class="form-label" for="first_name">{{ applicant.first_name }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="last_name"><strong>Apellidos:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.last_name }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="address"><strong>Dirección:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.address }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="number_phone"><strong>Teléfono:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.prefix_phone }} - {{ applicant.number_phone }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="parish"><strong>Parroquia:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.parish.name }}</label>
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
				<label class="col-md-3 control-label" for="first_name"><strong>Nombre:</strong></label>
				<div class="col-md-9">
					<label class="form-label" for="first_name">{{ applicant.full_name }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="address"><strong>Dirección:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.address }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="number_phone"><strong>Teléfono:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.prefix_phone }} - {{ applicant.number_phone }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="parish"><strong>Parroquia:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.parish.name }}</label>
				</div>
			</div>
			<legend class="text-center">Representante Legal</legend>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="identification"><strong>Cédula:</strong></label>
				<div class="col-sm-9">
					<label class="form-label">{{ applicant.agent_identification }}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="agent_first_name"><strong>Nombre:</strong></label>
				<div class="col-md-9">
					<label class="form-label">{{ applicant.agent_full_name }}</label>
				</div>
			</div>
		</section>
		<section class="modal-footer">
			<button class="btn btn-sm btn-warning" type="button" ng-click="close()">Cerrar</button>
		</section>
	</script>
</body>
</html>