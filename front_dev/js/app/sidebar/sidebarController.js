(function () {
  'use stric';
  
  angular.module('SATCI.controllers.SidebarCtrl',[])
  .controller('SidebarCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.navClass = function (page) {
      var currentRoute;
      var path = $location.path().substring(1) || 'home';
      var stop = path.search('/');
      if (stop > 0) {
        currentRoute = path.substr(0,stop);
      }else {
        currentRoute = path;
      }
      return page === currentRoute ? 'active' : '';
    };
  }])
})();