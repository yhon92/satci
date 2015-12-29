angular.module('Theme.controllers')
.controller('EditThemeCtrl', ($scope, $filter, $uibModalInstance, Alertify, Themes, categories, theme) => {
  $scope.title = 'Editar';

  $scope.categories = categories;

  $scope.theme = {
    // id: theme.id,
    category_id: theme.category_id,
    name: theme.name,
    // $$hashKey: theme.$$hashKey,
  };

  $scope.save = () => {
    $scope.theme.name = $filter('titleCase')($scope.theme.name);

    let data = {
      name: $scope.theme.name,
      category_id: $scope.theme.category_id,
    };
    Themes.update({id: theme.id}, data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Tema editado!')
        theme = $scope.theme;
        $uibModalInstance.close(theme)
      }
      if (data.error) {
        Alertify.error('¡No se pudo editar la tema!');
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
