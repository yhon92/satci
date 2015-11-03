/**
* Solicitude.Assign Module
*
* Description
*/
angular.module('Solicitude.Assign', ['ui.router', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Theme.resources', 'Solicitude.resources'])
.controller('AssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  Themes,
  Alertify,
  Solicitudes) => {

  Themes.get((data) => {
    return $scope.themes = data.themes;
  });
  

})