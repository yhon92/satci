/**
* Solicitude.Assign Module
*
* Description
*/
angular.module('Solicitude.Assign', ['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources', 'Theme.resources', 'Category.resources', 'Area.resources'])
.controller('AssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  Alertify,
  Solicitudes,
  Themes,
  Categories,
  Areas,
  ) => {

  $scope.selected = {};
  $scope.selected.themes;

  let _categories = '';

  Categories.get((data) => {
    _categories = data.categories;

    Themes.get((data) => {
      $scope.themes = data.themes;
    });

  });

  $scope.someGroupFn = function (theme){
    for (var i = _categories.length - 1; i >= 0; i--) {
      if (theme.category_id == _categories[i].id)
      {
        return _categories[i].name;
      }
    };
  };

  let _areas = '';

  Areas.get((data) => {
    return _areas = data.areas;
  });

  $scope.assignArea = (key, themeName) => {
    // console.log('Key:'+key+', '+'Theme:'+theme);

    let modalInstance = $uibModal.open({
      templateUrl: `modalAssignArea-template`,
      controller: ($scope, $uibModalInstance, areas, themeName) => {
        $scope.areas = areas;
        $scope.themeName = themeName;
        $scope.selected = {};
        $scope.selected.areas;

        $scope.ok = function () {
          if ($scope.selected.areas)
          {
            $uibModalInstance.close($scope.selected.areas);
          }
        };

        $scope.cancel = function () {
          $uibModalInstance.dismiss();
        };
      },
      // size: 'sm',
      resolve: {
        areas: () => {
          return _areas;
        },
        themeName: () => {
          return themeName;
        }
      }
    });

    modalInstance.result.then((selectedAreas) => {
      $scope.selected.themes[key].areas = selectedAreas;
      $scope.selected.themes[key].state = true;
      console.log($scope.selected.themes[key]);
    }, () => {
      console.info('Modal dismissed at: ' + new Date());
    });
  }
  $scope.mostrar = () => {
    console.log($scope.selected.themes)
  }
})