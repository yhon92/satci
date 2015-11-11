/**
* Solicitude.Assign Module
*
* Description
*/
angular.module('Solicitude.Assign', ['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Theme.resources', 'Category.resources', 'Solicitude.resources'])
.controller('AssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  Themes,
  Categories,
  Alertify,
  Solicitudes) => {

  let categories = '';


  Categories.get((data) => {
    categories = data.categories;
    Themes.get((data) => {
      // console.log(data.themes)
      $scope.themes = data.themes;
    });
    // console.log(categories)
  })

  $scope.selected = {};
  $scope.selected.themes;

  $scope.someGroupFn = function (theme){
    for (var i = categories.length - 1; i >= 0; i--) {
      if (theme.category_id == categories[i].id)
      {
        return categories[i].name;
      }
    };
  };

  $scope.assignArea = (key, theme) => {
    console.log('Key:'+key+', '+'Theme:'+theme);

    let modalInstance = $uibModal.open({
      templateUrl: `modalAssignArea-template`,
      controller: ($scope, $uibModalInstance) => {
        
        $scope.ok = function () {
          $uibModalInstance.close('hola');
        };

        $scope.cancel = function () {
          $uibModalInstance.dismiss();
        };
      },
      // size: 'sm',
    });

    modalInstance.result.then((selectedAreas) => {
      $scope.selected.themes[key].areas = selectedAreas;
      $scope.selected.themes[key].state = true;
    }, () => {
      console.info('Modal dismissed at: ' + new Date());
    });
  }
  $scope.mostrar = () => {
    console.log($scope.selected.themes)
  }
})