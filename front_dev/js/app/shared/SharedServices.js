/**
* Shared.services Module
*
* Description
*/
angular.module('Shared.services', [])
.factory('paginateService', ($q, $filter, $timeout) => {

  function getPage(data, start, number, params) {

    let deferred = $q.defer();

    let filtered = params.search.predicateObject ? $filter('filter')(data, params.search.predicateObject) : data;

    if (params.sort.predicate) {
      filtered = $filter('orderBy')(filtered, params.sort.predicate, params.sort.reverse);
    }

    if (filtered != undefined) {
      let result = filtered.slice(start, start + number);
      $timeout( () => {
        deferred.resolve({
          data: result,
        // numberOfPages: (number )
        numberOfPages: Math.ceil(data.length / number)
      });
      }, 600);
    };

    return deferred.promise;
  }

  return {
    getPage: getPage
  };

})
.factory('Helpers', () => {
  return {
    getIndex: (Things, id) => {
      for (let i = 0; i < Things.length; i++) {
        if (Things[i].id == id) {
          return i;
        }
      }
    },
  }
})
