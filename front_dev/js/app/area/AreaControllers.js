angular.module('Area.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Director.resources', 'Means.resources', 'Area.resources'])
.controller('AreaCtrl', ($scope, $uibModal, Alertify, Helpers, Directors, Means, Areas) => {

  let directors = null;
  let means = null;

  Areas.get().$promise
  .then((data) => {
    $scope.areas = data.areas;
  })
  .catch((faild) => {

  });

  Directors.get().$promise
  .then((data) => {
    directors = data.directors;
  })
  .catch((fails) => {

  });

  Means.get().$promise
  .then((data) => {
    means = data.means;
  })
  .catch((data) => {

  })

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
      templateUrl: 'modalFormArea-template',
      controller: 'CreateAreaCtrl',
      size: 'md',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        directors: () => {
          return directors;
        },
        means: () => {
          return means;
        },
      }
    });

    modalInstance.result.then((data) => {
      $scope.areas.push(data);
    });
  };

  $scope.show = (area) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalShowArea-template',
      controller: 'ShowAreaCtrl',
      size: 'dm',
      resolve: {
        area: () => {
          return area;
        }
      }
    });
  };

  $scope.edit = (area) => {

    let index = Helpers.getIndex($scope.areas, area.id);

    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormArea-template',
      controller: 'EditAreaCtrl',
      size: 'md',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        directors: () => {
          return directors;
        },
        means: () => {
          return means;
        },
        area: () => {
          return area;
        }
      }
    });

    modalInstance.result.then((data) => {
      $scope.areas[index].name = data.name;
      $scope.areas[index].email = data.email;
      $scope.areas[index].director = data.director;
      $scope.areas[index].means = data.means;
    });
  };

  $scope.delete = (area) => {

    let id = area.id;
    
    let index = Helpers.getIndex($scope.areas, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar el Área: '+
      '</br>Nombre: <strong class="text-danger">'+ area.name +'</strong>'
      )
    .then((ok) => {
      Areas.delete({id: id}).$promise
      .then( (data) => {
        if (data.success) {
          $scope.areas.splice(index,1);
          Alertify.success('¡Área eliminada!');
        }
        if (data.conflict) {
          Alertify.log('¡No es posible eliminar por tener <strong class="text-warning">Solicitudes</strong> asociadas!');
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
