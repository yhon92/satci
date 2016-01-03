angular.module('Means.controllers')
.controller('CreateMeansCtrl', ($scope, $filter, $uibModalInstance, Alertify, Means) => {
   $scope.title = 'Agregar';

  $scope.button = {
    submit: 'Agregar',
    cancel: 'Cancelar'
  };

  $scope.means = null;

  $scope.save = () => {
    let data = {
      name: $filter('titleCase')($scope.means),
    };

    Means.save(data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Recurso registrado!');
        $uibModalInstance.close(data.means);
      }
      if (data.error) {
        Alertify.error('¡No se pudo registrar el recurso!');
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
