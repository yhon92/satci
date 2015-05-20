(function () {
	'use stric';
	
	angular.module('SATCI.services', ['ngResource'])

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

	.factory('servingData', function () {
		return {
			data: {}
		};
	})

	.factory('paginateService', ['$q', '$filter', '$timeout', function ($q, $filter, $timeout) {
		
		function getPage(data, start, number, params) {

		var deferred = $q.defer();

		var filtered = params.search.predicateObject ? $filter('filter')(data, params.search.predicateObject) : data;

		if (params.sort.predicate) {
			filtered = $filter('orderBy')(filtered, params.sort.predicate, params.sort.reverse);
		}

		var result = filtered.slice(start, start + number);

		$timeout(function () {
			deferred.resolve({
				data: result,
				numberOfPages: Math.ceil(1000 / number)
			});
		}, 1500);

		return deferred.promise;
	}

	return {
		getPage: getPage
	};

	}])
	
})();