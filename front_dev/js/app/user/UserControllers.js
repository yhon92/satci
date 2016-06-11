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
  };

  /*$scope.delete = (category) => {

    let id = category.id;
    
    let index = Helpers.getIndex($scope.categories, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar la categoría: '+
      '</br>Nombre: <strong class="text-danger">'+ category.name +'</strong>'
      )
    .then((ok) => {
      Categories.delete({id: id}).$promise
      .then( (data) => {
        if (data.success) {
          $scope.categories.splice(index,1);
          Alertify.success('¡Categoría eliminada!');
        }
        if (data.conflict) {
          Alertify.log('¡No es posible eliminar por tener <strong class="text-warning">Temas</strong> asociados!');
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
  };*/

})