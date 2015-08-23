(function () {
	'use stric';
	
	var resourceUrl = '/api/';
	// var resourceUrl = 'http://localhost/satci/public/api/';
	// var resourceUrl = 'http://192.168.1.26/satci/public/api/';
	// var resourceUrl = 'http://192.168.0.103/satci/public/api/';
	
	angular.module('SATCI.resources', ['ngResource'])


	.factory('Solicitudes', function($resource){
		return $resource( resourceUrl +'solicitude/:id', {id: '@_id'}, {
			update: {
				method: 'PUT', 
				params: {
					id: '@_id'
				}
			}
		});
	})
	.factory('SolicitudesList', function($http){
		return function(applicant=''){
				return $http.get( resourceUrl +'solicitude/list/' + applicant);
			}
		})	

	.factory('Citizens', function($resource){
		return $resource( resourceUrl + 'citizen/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Institutions', function($resource){
		return $resource( resourceUrl + 'institution/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Parishes', function($resource){
		return $resource( resourceUrl + 'parish/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

})();