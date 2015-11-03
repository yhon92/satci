/**
* Solicitude.Assign Module
*
* Description
*/
angular.module('Solicitude.Assign', ['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Theme.resources', 'Solicitude.resources'])
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

  $scope.selected = {};
  $scope.selected.themes;

  $scope.mostrar = () => {
    console.log($scope.selected);
  }

})