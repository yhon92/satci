angular.module('Area.controllers')
.controller('ShowAreaCtrl', ($scope, $filter, $uibModalInstance, area) => {
  
  $scope.area = area;

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})
