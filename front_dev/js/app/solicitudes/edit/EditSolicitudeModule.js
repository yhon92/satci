/**
* Solicitude.Edit Module
*
* Description
*/
angular.module('Solicitude.Edit', ['ui.router', 'Alertify', 'SATCI.Shared', 'Solicitude.resources'])
.controller('EditSolicitudeCtrl',(
  $state,
  $scope,
  $stateParams,
  // $uibModal,
  Alertify,
  Solicitudes) => {

  Solicitudes.get({id: $stateParams.id}).$promise.then( (response) => {
    $scope.solicitude = response.solicitude;
  }, (error) => {

  });
  
})