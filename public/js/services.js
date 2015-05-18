(function () {
	'use stric';
	
	angular.module('SATCI.services', ['ngResource'])

	.factory('Solicitude', function ($resource){
		return $resource('http://localhost/satci/public/solicitude/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Applicant', function ($resource){
		return $resource('http://localhost/satci/public/applicant/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

})();