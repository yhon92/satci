angular.module('Theme.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Category.resources', 'Theme.resources'])
.controller('ThemeCtrl', ($scope, $uibModal, Alertify, Helpers, Categories, Themes) => {

  let categories = null;

  Themes.get().$promise
  .then((data) => {
    $scope.themes = data.themes;
  })
  .catch((fails) => {

  });

  Categories.list().$promise
  .then((data) => {
   categories = data.categories;
  })
  .catch((fails) => {
    console.log(fails);
  });

  $scope.filter = {
    name: '',
  };
  
  $scope.isCollapsed = true;
  
  $scope.toggleCollapsed = () => {
    $scope.filter.name = '';
    $scope.isCollapsed = !$scope.isCollapsed;
  }

  $scope.add = () => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormTheme-template',
      controller: 'CreateThemeCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        categories: () => {
          return categories;
        },
      },
    });

    modalInstance.result.then((data) => {
      $scope.themes.push(data);
    });
  };

  $scope.show = (theme) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalShowTheme-template',
      controller: 'ShowThemeCtrl',
      size: 'dm',
      resolve: {
        categories: () => {
          return categories;
        },
        theme: () => {
          return theme;
        }
      }
    });
  };

  $scope.edit = (theme) => {

    let index = Helpers.getIndex($scope.themes, theme.id);
    
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormTheme-template',
      controller: 'EditThemeCtrl',
      size: 'md',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        categories: () => {
          return categories;
        },
        theme: () => {
          return theme;
        },
      }
    });

    modalInstance.result.then((data) => {
      $scope.themes[index].name = data.name;
      $scope.themes[index].category_id = data.category_id;
    });
  };

  $scope.delete = (theme) => {

    let id = theme.id;
    
    let index = Helpers.getIndex($scope.themes, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar el Tema: '+
      '</br>Nombre: <strong class="text-danger">'+ theme.name +'</strong>'
      )
    .then((ok) => {
      Themes.delete({id: id}).$promise
      .then( (data) => {
        if (data.success) {
          $scope.themes.splice(index,1);
          Alertify.success('Tema eliminado!');
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