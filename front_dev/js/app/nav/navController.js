(function () {
  'use stric';
  
  angular.module('SATCI.controllers.NavCtrl',[])
  .controller('NavCtrl', function ($auth, $state, $scope, $rootScope, $location) {
    $scope.logout = function() {
      //Remove the satellizer_token from localstorage
      $auth.logout().then(function(){
      //Remove the authenticated user from local storage
      sessionStorage.removeItem('user');
      //Flip authenticated to false so that we no longer
      //show UI elements dependant on the user being logged in
      $rootScope.authenticated = false;
      //Remove the current user from rootscope
      $rootScope.currentUser = null;
      $state.go('login');
    });
    };

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
  })
})();