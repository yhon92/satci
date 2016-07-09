angular.module('User.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'User.resources'])
.controller('UserCtrl', ($scope, $uibModal, Alertify, Helpers, Users) => {
  
  Users.get().$promise
  .then((data) => {
    $scope.users = data.users;
  })
  .catch((fails) => {

  });

  $scope.filter = {
    name: '',
  };
  
  $scope.isCollapsed = true;
  
  $scope.toggleCollapsed = () => {
    $scope.filter.name = '';
    $scope.isCollapsed = !$scope.isCollapsed;
  };

  $scope.add = () => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormUser-template',
      controller: 'CreateUserCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false
    });

    modalInstance.result.then((data) => {
      $scope.users.push(data);
    });
  };

  $scope.show = (user) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalShowUser-template',
      controller: 'ShowUserCtrl',
      size: 'dm',
      resolve: {
        user: () => {
          return user;
        }
      }
    });
  };

  $scope.edit = (user) => {

    let index = Helpers.getIndex($scope.users, user.id);

    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormUser-template',
      controller: 'EditUserCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        user: () => {
          return user;
        }
      }
    });

    modalInstance.result.then((data) => {
      $scope.users[index].first_name = data.first_name;
      $scope.users[index].last_name = data.last_name;
      $scope.users[index].username = data.username;
      $scope.users[index].active = data.active;
    });
  };

  $scope.delete = (user) => {

    let id = user.id;
    
    let index = Helpers.getIndex($scope.users, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar la categoría: '+
      '</br>Nombre: <strong class="text-danger">'+ user.first_name +' '+ user.last_name +'</strong>'
      )
    .then((ok) => {
      Users.delete({id: id}).$promise
      .then( (data) => {
        if (data.success) {
          $scope.users.splice(index,1);
          Alertify.success('¡Usuario eliminado!');
        }
        if (data.conflict) {
          Alertify.log('¡No es posible eliminar por tener <strong class="text-warning">Multiples Registros</strong> asociados!');
        }
        if (data.error) {
          Alertify.error('¡Ocurrio un error al intentar eliminar!');
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
    }, (cancel) => {
      return false;
    }); 
  };

})