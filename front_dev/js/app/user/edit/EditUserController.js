angular.module('User.controllers')
.controller('EditUserCtrl', ($scope, $filter, $uibModalInstance, Alertify, Users, user) => {
  $scope.title = 'Editar';
  $scope.add = false;

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  };

  $scope.user = {
    "first_name": user.first_name,
    "last_name": user.last_name,
    "username": user.username,
    "password": null,
    "password_confirmation": null,
    "active": user.active,
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
    let dataUser = {
      "first_name": $filter('titleCase')($scope.user.first_name),
      "last_name": $filter('titleCase')($scope.user.last_name),
      "username": $filter('lowercase')($scope.user.username),
      "password": $scope.user.password,
      "password_confirmation": $scope.user.password_confirmation,
      "active": $scope.user.active,
    };

    Users.update({id: user.id}, dataUser).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Usuario editado!');
        user = dataUser;
        $uibModalInstance.close(user);
      }
      if (data.error) {
        Alertify.error('¡No se pudo editar el usuario!');
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