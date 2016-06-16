angular.module('User.controllers')
.controller('CreateUserCtrl', ($scope, $filter, $uibModalInstance, Alertify, Helpers, Users) => {
  $scope.title = 'Agregar';
  $scope.add = true;

  $scope.button = {
    submit: 'Agregar',
    cancel: 'Cancelar'
  };

  $scope.user = {
    "first_name": null,
    "last_name": null,
    "username": null,
    "password": null,
    "password_confirmation": null,
    "active": true,
  };

  if ($scope.user.active) {
    $scope.status = 'Activo';
  } else {
    $scope.status = 'Inactivo';
  }

  $scope.checkStatus = () => {
    if ($scope.user.active) {
      $scope.status = 'Activo';
    } else {
      $scope.status = 'Inactivo';
    }
  };

  $scope.save = () => {

    let data = {
      "first_name": $filter('titleCase')($scope.user.first_name),
      "last_name": $filter('titleCase')($scope.user.last_name),
      "username": $filter('lowercase')($scope.user.username),
      "password": $scope.user.password,
      "password_confirmation": $scope.user.password_confirmation,
      "active": $scope.user.active,
    };

    Users.save(data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Usuario registrado!');
        $uibModalInstance.close(data.user);
      }
      if (data.error) {
        Alertify.error('¡No se pudo registrar el usuario!');
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
