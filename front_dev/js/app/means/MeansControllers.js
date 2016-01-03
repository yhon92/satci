angular.module('Means.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Means.resources'])
.controller('MeansCtrl', ($scope, $uibModal, Helpers, Alertify, Means) => {
  Means.get().$promise
  .then((data) => {
    $scope.means = data.means;
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
      templateUrl: 'modalFormMeans-template',
      controller: 'CreateMeansCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false
    });

    modalInstance.result.then((data) => {
      $scope.means.push(data);
    });
  };

  $scope.show = (item) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalShowMeans-template',
      controller: 'ShowMeansCtrl',
      size: 'dm',
      resolve: {
        item: () => {
          return item;
        }
      }
    });
  };

  $scope.edit = (item) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormMeans-template',
      controller: 'EditMeansCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        item: () => {
          return item;
        }
      }
    });
  };

  $scope.delete = (item) => {

    let id = item.id;
    
    let index = Helpers.getIndex($scope.means, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar el recurso: '+
      '</br>Nombre: <strong class="text-danger">'+ item.name +'</strong>'
      )
    .then((ok) => {
      Means.delete({id: id}).$promise
      .then( (data) => {
        if (data.success) {
          $scope.means.splice(index,1);
          Alertify.success('¡Recurso eliminado!');
        }
        if (data.conflict) {
          Alertify.log('¡No es posible eliminar por tener <strong class="text-warning">Áreas</strong> asociadas!');
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
