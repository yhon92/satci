angular.module('Director.controllers')
.controller('CreateDirectorCtrl', ($scope, $filter, $uibModalInstance, Alertify, Helpers, Directors) => {
  $scope.title = 'Agregar';

  $scope.button = {
    submit: 'Agregar',
    cancel: 'Cancelar'
  };

  $scope.prefixesPhone = Helpers.prefixesPhone;
  
  $scope.director = null;

  $scope.save = () => {
    $scope.director.first_name = $filter('titleCase')($scope.director.first_name);
    $scope.director.last_name = $filter('titleCase')($scope.director.last_name);
    $scope.director.full_name = $scope.director.first_name +' '+ $scope.director.last_name;

    let data = {
      identification: $scope.director.identification,
      full_name: $scope.director.full_name,
      first_name: $scope.director.first_name,
      last_name: $scope.director.last_name,
      prefix_phone: $scope.director.prefix_phone,
      number_phone: $scope.director.number_phone,
      email: $scope.director.email,
      resolution: $scope.director.resolution,
    };

    Directors.save(data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Director registrado!');
        $uibModalInstance.close(data.director);
      }
      if (data.error) {
        Alertify.error('¡No se pudo registrar al director!');
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