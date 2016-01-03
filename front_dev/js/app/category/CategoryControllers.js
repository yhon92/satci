angular.module('Category.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Category.resources'])
.controller('CategoryCtrl', ($scope, $uibModal, Helpers, Alertify, Categories) => {

  Categories.get().$promise
  .then((data) => {
    $scope.categories = data.categories;
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
      templateUrl: 'modalFormCategory-template',
      controller: 'CreateCategoryCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false
    });

    modalInstance.result.then((data) => {
      $scope.categories.push(data);
    });
  };

  $scope.show = (category) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalShowCategory-template',
      controller: 'ShowCategoryCtrl',
      size: 'dm',
      resolve: {
        category: () => {
          return category;
        }
      }
    });
  };

  $scope.edit = (category) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormCategory-template',
      controller: 'EditCategoryCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        category: () => {
          return category;
        }
      }
    });
  };

  $scope.delete = (category) => {

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
  };
  
})
