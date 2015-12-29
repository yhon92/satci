angular.module('Theme.controllers')
.controller('CreateThemeCtrl', ($scope, $filter, $uibModalInstance, Alertify, Themes, categories) => {
  
  $scope.title = 'Agregar';
  
  $scope.categories = categories;

  $scope.theme = {
    name: null,
    category_id: null,
  };

  $scope.save = () => {
    let data = {
      name: $filter('titleCase')($scope.theme.name),
      category_id: $scope.theme.category_id,
    };

    Themes.save(data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Tema registrado!')
        $uibModalInstance.close(data.theme)
      }
      if (data.error) {
        Alertify.error('¡No se pudo registrar el tema!');
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
