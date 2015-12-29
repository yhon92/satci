angular.module('Solicitude.controllers',['ui.router', 'ui.select', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources', 'Theme.resources', 'Category.resources', 'Area.resources'])
.controller('SolicitudeCtrl', ($scope, $http, Solicitudes) => {
  $scope.citizens = '';
  $scope.institutions = '';

  Solicitudes.list({applicant: 'Citizen'}).$promise
  .then((data) => {
    $scope.citizens = data.solicitudes;
    $scope.citizens.type = 'Personas';
  })
  .catch((fails) => {
    console.log(fails);
  });

  Solicitudes.list({applicant: 'Institution'}).$promise
  .then((data) => {
    $scope.institutions = data.solicitudes;
    $scope.institutions.type = 'Instituciones';
  })
  .catch((fails) => {
    console.log(fails);
  });
})
