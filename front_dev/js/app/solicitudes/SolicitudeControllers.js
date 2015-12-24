angular.module('Solicitude.controllers',['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources', 'Theme.resources', 'Category.resources', 'Area.resources'])
.controller('SolicitudeCtrl', ($scope, $http, SolicitudesList) => {
  $scope.citizens = '';
  $scope.institutions = '';

  SolicitudesList('Citizen').then( (response) => {
    $scope.citizens = response.data;
    $scope.citizens.type = 'Personas';
  }, (error) => {
    console.log(error);
  });

  SolicitudesList('Institution').then( (response) => {
    $scope.institutions = response.data;
    $scope.institutions.type = 'Instituciones';
  }, (error) => {
    console.log(error);
  });
})
