(function () {
	'use stric';
	
	window.PathTemplates = {
		views: 		'templates/views/',
		partials: 'templates/partials/',
	}

	var satci = angular.module('SATCI', 
	[
		'ngRoute',
		'ngAnimate',
		'ngResource',
		'ui.bootstrap',
		'smart-table',
		'SATCI.controllers',
		'SATCI.services',
		'SATCI.resources',
		'SATCI.filters',
		
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
				controller: 'CreateSolicitudeCtrl'
			})




		$locationProvider.html5Mode(true);

	}])

})();