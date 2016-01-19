// ['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources', 'Theme.resources', 'Category.resources', 'Area.resources']
angular.module('Solicitude.controllers')
.controller('ShowAssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  AclService,
  Alertify,
  SolicitudesAssign) => {
  
  $scope.can = AclService.can;
    
  $scope.assigned = false;
  $scope.notAssigned = false;
  $scope.isCollapsed = [];
  $scope.newStatus = [];
  $scope.observation = [];
  
  SolicitudesAssign.list({solicitude: $stateParams.id}).$promise
  .then((data) => {
    if (data.assigned.length > 0) {
      $scope.assigned = data.assigned;
    } else {
      $scope.notAssigned = true;
    };
  })
  .catch((error) => {
    console.log(error.data)
  });

  $scope.statusSelect = (status) => {
    if (status === 'Enviado') {
      return 'label-default';
    }
    if (status === 'Leído') {
      return 'label-warning';
    }
    if (status === 'Aceptado') {
      return 'label-primary';
    }
    if (status === 'Rechazado') {
      return 'label-danger';
    }
    if (status === 'Atendido') {
      return 'label-success';
    }
  };

  $scope.showComment = (status) => {
    if (status == 'Atendido' || status == 'Rechazado') {
      return true;
    }
    return false;
  };
  
  $scope.disable = (status) => {
    if (status == 'Atendido' || status == 'Rechazado')
      return 'display-none';
  }

  $scope.saveUpdate = (keyTheme, keyAssign, newStatus, id) => {
    if ($scope.assigned[keyTheme].assign_solicitude[keyAssign].status == newStatus) {
      $scope.isCollapsed[keyTheme][keyAssign] = true;
    } else {

      let assign = {
        update: {status: newStatus},
        solicitude_id: $stateParams.id
      };

      if ($scope.observation[keyTheme]) {
        var observation = $scope.observation[keyTheme][keyAssign];
        assign.observation = observation;
      }

      SolicitudesAssign.update({ id:id }, assign).$promise
      .then( (data) => {
        if (data.success) {
          $scope.assigned[keyTheme].assign_solicitude[keyAssign].status = newStatus;
          if (observation) {
            $scope.assigned[keyTheme].assign_solicitude[keyAssign].observation.body = observation;
          };
          Alertify.success("¡Estado Actualizado!")
          $scope.isCollapsed[keyTheme][keyAssign] = true;
        };
      })
      .catch((fails) => {
        if (fails.status != 500) {
          for (let firstKey in fails.data) {
            for (let secondKey in fails.data[firstKey]) {
              Alertify.error(fails.data[firstKey][secondKey]);
            }
          }
          $scope.isCollapsed[keyTheme][keyAssign] = true;
        } else {
          console.log(fails);
        };
      });
    }
  }
})