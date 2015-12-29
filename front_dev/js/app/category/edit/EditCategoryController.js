angular.module('Category.controllers')
.controller('EditCategoryCtrl', ($scope, $filter, $uibModalInstance, Alertify, Categories, category) => {
  $scope.title = 'Editar';

  $scope.category = category.name;

  $scope.save = () => {
    $scope.category = $filter('titleCase')($scope.category);

    let data = {
      name: $scope.category
    };

    Categories.update({id: category.id}, data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Categoría editada!')
        category.name = $scope.category;
        $uibModalInstance.close(category)
      }
      if (data.error) {
        Alertify.error('¡No se pudo editar la categoría!');
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