angular.module('Category.controllers')
.controller('CreateCategoryCtrl', ($scope, $filter, $uibModalInstance, Alertify, Categories) => {
  $scope.title = 'Agregar';

  $scope.category = null;

  $scope.save = () => {
    let data = {
      name: $filter('titleCase')($scope.category),
    };

    Categories.save(data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Categoría registrada!')
        $uibModalInstance.close(data.category)
      }
      if (data.error) {
        Alertify.error('¡No se pudo registrar la categoría!');
      }
    })
    .catch((fails) => {
      if (fails.status != 500) {
        for (let firstKey in fails.data) {
          for (let secondKey in fails.data[firstKey]) {
            Alertify.error(fails.data[firstKey][secondKey]);
          }
        }
      } else {
        console.log(fails);
      };
    });
  };

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})