angular.module('Director.controllers')
.controller('EditDirectorCtrl', ($scope, $filter, $uibModalInstance, Alertify, Helpers, Directors, director) => {
  $scope.title = 'Editar';

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  };

  $scope.prefixesPhone = Helpers.prefixesPhone;

  $scope.director = {
    identification: director.identification,
    first_name: director.first_name,
    last_name: director.last_name,
    prefix_phone: director.prefix_phone,
    number_phone: director.number_phone,
    email: director.email,
    resolution: director.resolution,
  };

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

    Directors.update({id: director.id}, data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Director editado!');
        director = $scope.director;
        $uibModalInstance.close(director)
      }
      if (data.error) {
        Alertify.error('¡No se pudo editar el director!');
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
      }
    });
  };

  $scope.close = () => {
    $uibModalInstance.dismiss();
  }; 
})
