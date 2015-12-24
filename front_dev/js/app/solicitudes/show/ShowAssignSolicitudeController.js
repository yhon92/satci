// ['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources', 'Theme.resources', 'Category.resources', 'Area.resources']
angular.module('Solicitude.controllers')
.controller('ShowAssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  Alertify,
  SolicitudesAssign,
  SolicitudesAssignList) => {
  
  $scope.assigned = false;
  $scope.notAssigned = false;
  $scope.isCollapsed = [];
  $scope.newStatus = [];
  
  SolicitudesAssignList($stateParams.id).then( (response) => {
    if (response.data.length > 0) {
      $scope.assigned = response.data;
    }else{
      $scope.notAssigned = true;
    };
  }, 
  (error) => {
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

  $scope.disable = (status) =>{
    if(status == 'Atendido' || status == 'Rechazado')
      return 'display-none';
  }

  $scope.saveUpdate = (keyTheme, keyAssign, newStatus, id) => {
    if ($scope.assigned[keyTheme].assign_solicitude[keyAssign].status == newStatus) {
      $scope.isCollapsed[keyTheme][keyAssign] = true;
    }else {
      let assign = {
        update: {status: newStatus},
        solicitude_id: $stateParams.id
      };

      SolicitudesAssign.update({ id:id }, assign).$promise
      .then( (data) => {
        if (data.success) {
          $scope.assigned[keyTheme].assign_solicitude[keyAssign].status = newStatus;
          Alertify.success("¡Estado Actualizado!")
          $scope.isCollapsed[keyTheme][keyAssign] = true;
        };
      }, 
      (fails) => {
        if (fails.status != 500) {
          angular.forEach(fails.data, (values, key) => {
            angular.forEach(values, (value) => {
              Alertify.error(value)
            })
          })
          $scope.isCollapsed[keyTheme][keyAssign] = true;
        }else {
          console.log(fails);
        };
      });
    }
  }
})