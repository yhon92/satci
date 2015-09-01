angular.module('SATCI.Nav',[])
.controller('NavCtrl', ($auth, $state, $scope, $rootScope, $location) => {
  $scope.logout = () => {
    //Remove the satellizer_token from localstorage
    $auth.logout().then( () => {
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

  $scope.navbarCollapsed = true;

  $scope.status = {
    isOpen: false
  };

  $scope.toggleDropdown  = ($event) => {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isOpen = !$scope.status.isOpen;
  };

  $scope.navClass = (page) => {
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
})
