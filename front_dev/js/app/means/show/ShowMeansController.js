angular.module('Means.controllers')
.controller('ShowMeansCtrl', ($scope, $uibModalInstance, item) => {
  $scope.means = item;  
  $scope.areas = false;
  $scope.notAreas = false;

  if (item.areas != undefined && item.areas.length > 0 ) {
    $scope.areas = item.areas;
  } else {
    $scope.notAreas = true;
  }

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})
