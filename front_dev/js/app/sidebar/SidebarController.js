(function () {
  'use stric';
  
  angular.module('SATCI.SidebarCtrl',[])
  .controller('SidebarCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.navClass = function (page) {
      let currentRoute;
      let path = $location.path().substring(1) || 'home';
      let stop = path.search('/');
      if (stop > 0) {
        currentRoute = path.substr(0,stop);
      }else {
        currentRoute = path;
      }
      return page === currentRoute ? 'active' : '';
    };
  }])
})();