(function () {
	'use stric';
	
	window.PathTemplates = {
		// views: 		'/satci/public/templates/views/solicitude/index.html',
		views: 		'templates/views/',
		partials: 'templates/partials/',
	}

	var satci = angular.module('SATCI', 
	[
		'ngRoute',
		'ngAnimate',
		'ui.bootstrap',
		'SATCI.controllers',
		'SATCI.services',
		
	])

	.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider)
	{
		$routeProvider
			.when('/solicitude', {
				templateUrl: PathTemplates.views + 'solicitude/index.html',
				controller: 'SolicitudeCtrl'
			})
			
			.when('/solicitude/create', {
				templateUrl: PathTemplates.views + 'solicitude/create.html',
				controller: 'SolicitudeCtrl'
			})




		$locationProvider.html5Mode(true);

	}])

})();