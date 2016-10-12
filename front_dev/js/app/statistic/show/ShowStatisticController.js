/*angular.module('Statistics.controllers')
.controller('ShowStatisticsCtrl', ($scope, $uibModalInstance, categories, theme) => {
  
  $scope.theme = theme;

  for (let i = 0; i < categories.length; i++) {
    if (categories[i].id === theme.category_id) {
      $scope.theme.category = categories[i];
    };
  };

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})
*/