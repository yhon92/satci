angular.module('Solicitude.controller',[])
.controller('SolicitudeCtrl', ($scope, $http, SolicitudesList) => {
  /*$scope.parishes = Parishes.get(function (data) {
    return $scope.parishes = data.parishes;
  })*/
  SolicitudesList('Citizen').then( (response) => {
    $scope.citizens = response.data.solicitudes;
    $scope.citizens.type = 'Personas';
  }, (error) => {
    console.log(error);
  });

  SolicitudesList('Institution').then( (response) => {
    $scope.institutions = response.data.solicitudes;
    $scope.institutions.type = 'Instituciones';
  }, (error) => {
    console.log(error);
  });
})