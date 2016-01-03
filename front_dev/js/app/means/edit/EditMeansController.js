angular.module('Means.controllers')
.controller('EditMeansCtrl', ($scope, $filter, $uibModalInstance, Alertify, Means, item) => {
  $scope.title = 'Editar';

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  };

  $scope.means = item.name;

  $scope.save = () => {
    $scope.means = $filter('titleCase')($scope.means);

    let data = {
      name: $scope.means
    };

    Means.update({id: item.id}, data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Recurso editado!');
        item.name = $scope.means;
        $uibModalInstance.close(item);
      }
      if (data.error) {
        Alertify.error('¡No se pudo editar el recurso!');
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
