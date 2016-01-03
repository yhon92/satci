angular.module('Director.controllers')
.controller('ShowDirectorCtrl', ($scope, $uibModalInstance, director) => {

  $scope.director = director;  
  $scope.areas = false;
  $scope.notAreas = false;

  if (director.areas != undefined && director.areas.length > 0 ) {
    $scope.areas = director.areas;
  } else {
    $scope.notAreas = true;
  }

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})
