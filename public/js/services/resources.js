(function () {
	'use stric';
	
	angular.module('SATCI.resources', ['ngResource'])

	.factory('Solicitudes', function ($resource){
		return $resource('http://localhost/satci/public/api/solicitude/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Citizens', function ($resource){
		return $resource('http://localhost/satci/public/api/citizen/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Institutions', function ($resource){
		return $resource('http://localhost/satci/public/api/institution/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

/*	.factory('Applicant', function ($resource){
		return $resource('http://localhost/satci/public/applicant/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})*/

})();