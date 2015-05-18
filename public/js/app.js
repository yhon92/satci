(function () {
	'use stric';

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
		
		$locationProvider.html5Mode(true);

	}])

})();