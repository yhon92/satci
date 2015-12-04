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
  SolicitudesAssign,
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

  $scope.assignArea = (key, theme) => {

    let modalInstance = $uibModal.open({
      templateUrl: `modalAssignArea-template`,
      controller: ($scope, $uibModalInstance, areas, theme) => {
        $scope.areas = areas;
        $scope.theme = theme;
        $scope.selected = {};
        $scope.selected.areas;

        $scope.ok = () => {
          if ($scope.selected.areas)
          {
            $uibModalInstance.close($scope.selected.areas);
          }
        };

        $scope.cancel = () => {
          $uibModalInstance.dismiss();
        };
      },
      // size: 'sm',
      resolve: {
        areas: () => {
          return _areas;
        },
        theme: () => {
          return theme;
        }
      }
    });

    modalInstance.result.then((selectedAreas) => {
      $scope.selected.themes[key].areas = selectedAreas;
      $scope.selected.themes[key].state = true;
    });
  }

  $scope.editArea = (key, theme) => {

    let modalInstance = $uibModal.open({
      templateUrl: `modalAssignArea-template`,
      controller: ($scope, $uibModalInstance, areas, theme) => {
        $scope.areas = areas;
        $scope.theme = theme;
        $scope.selected = {};
        $scope.selected.areas = theme.areas;

        $scope.ok = () => {
          if ($scope.selected.areas.length)
          {
            $uibModalInstance.close($scope.selected.areas);
          }
        };

        $scope.cancel = () => {
          $uibModalInstance.dismiss();
        };
      },
      // size: 'sm',
      resolve: {
        areas: () => {
          return _areas;
        },
        theme: () => {
          return theme;
        }
      }
    });

    modalInstance.result.then((selectedAreas) => {
      $scope.selected.themes[key].areas = selectedAreas;
      $scope.selected.themes[key].state = true;
    });
  }

  $scope.disablePreview = () => {
    let themes = $scope.selected.themes;

    for (let i = 0; i < themes.length; i++) {
      if (themes[i].state === true)
        return '';
    }

    return 'disabled';
  };

  $scope.disableFinalize = () => {
    let themes = $scope.selected.themes;

    for (let i = 0; i < themes.length; i++) {
      if (!themes[i].state)
        return 'disabled'
    }
  };

  $scope.preview = () => {

    let modalInstance = $uibModal.open({
      templateUrl: `modalPreviewAssign-template`,
      controller: ($scope, $uibModalInstance, themes) => {
        
        $scope.unassigned = [];
        $scope.assigned = [];

        for (var i = 0; i < themes.length; i++) {
          if (themes[i].state) {
            $scope.assigned.push(themes[i]);
          } else {
            $scope.unassigned.push(themes[i]);
          }
        };

        $scope.means = (id, means) => {
          for (var i = means.length - 1; i >= 0; i--) {
            if (means[i].id === id ) {
              return means[i].name;
            };
          };
        }

        $scope.close = () => {
          $uibModalInstance.close();
        };

        $scope.cancel = () => {
          $uibModalInstance.dismiss();
        };
      },
      // size: 'sm',
      resolve: {
        themes: () => {
          return $scope.selected.themes;
        }
      }
    });

  };

  $scope.finalize = () => {
    let data = {
      solicitude: $stateParams.id,
      themes: $scope.selected.themes,
    }

    SolicitudesAssign.save(data).$promise
      .then( (data) => {
        if (data.success) {
          Alertify.success('¡La asignación se realizó de forma exitosa!');
          $state.transitionTo('solicitude', { 
            reload: true, notify: false 
          });
        }
        if (data.error) {
          Alertify.error('¡No se pudo guardar la asignación!');
          $state.reload();
        }
      },
      (fails) => {
        if (fails.status != 500) {
          angular.forEach(fails.data, (values, key) => {
            angular.forEach(values, (value) => {
              Alertify.error(value)
            })
          })
        }else {
          console.log(fails);
        };
      });
  };
})
.controller('ShowAssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  Alertify,
  SolicitudesAssign) => {
  
  SolicitudesAssign.get().$promise
  .then(
    (data) => {
      debugger
    }, 
    (fails) => {

    });
})