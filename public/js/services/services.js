(function () {
	'use stric';
	
	angular.module('SATCI.services', [])

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
				numberOfPages: (number - 1)
				// numberOfPages: Math.ceil(1000 / number)
			});
		}, 600);

		return deferred.promise;
	}

	return {
		getPage: getPage
	};

	}])
	
})();