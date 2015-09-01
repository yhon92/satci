angular.module('SATCI.Dropdown',[])
.controller('DropdownCtrl', ($scope) => {

  $scope.navbarCollapsed = true;

  $scope.status = {
    isOpen: false
  };

  $scope.toggleDropdown  = ($event) => {

    $event.preventDefault();
    $event.stopPropagation();

    $scope.status.isOpen = !$scope.status.isOpen;

  };
})