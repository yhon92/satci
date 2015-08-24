(function () {
  'use stric';
  
  angular.module('SATCI.controllers.DropdownCtrl',[])
  .controller('DropdownCtrl', function($scope){

    $scope.navbarCollapsed = true;

    $scope.status = {
      isOpen: false
    };

    $scope.toggleDropdown  = function($event) {

      $event.preventDefault();
      $event.stopPropagation();

      $scope.status.isOpen = !$scope.status.isOpen;

    };
  })
})();