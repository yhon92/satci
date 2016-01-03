angular.module('Area.controllers')
.controller('CreateAreaCtrl', ($scope, $filter, $uibModalInstance, Alertify, Helpers, directors, means, Areas) => {
  $scope.title = 'Agregar';

  $scope.button = {
    submit: 'Agregar',
    cancel: 'Cancelar'
  };

  $scope.directors = directors;

  $scope.means = means;

  $scope.area = {
    "name": null,
    "email": '',
    "director": null,
    "means": null,
  };

  $scope.save = () => {

    let data = {
      name: $filter('titleCase')($scope.area.name),
      email: $scope.area.email,
      director_id: $scope.area.director,
      means: $scope.area.means,
    };

    Areas.save(data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Área registrada!');
        $uibModalInstance.close(data.area);
      }
      if (data.error) {
        Alertify.error('¡No se pudo registrar el área!');
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
