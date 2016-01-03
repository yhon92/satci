angular.module('Category.controllers')
.controller('ShowCategoryCtrl', ($scope, $uibModalInstance, category) => {
  $scope.category = category;  
  $scope.themes = false;
  $scope.notThemes = false;

  if (category.themes != undefined && category.themes.length > 0 ) {
    $scope.themes = category.themes;
  } else {
    $scope.notThemes = true;
  }

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})