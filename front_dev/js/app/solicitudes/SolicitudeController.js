angular.module('Solicitude.controller',[])
.controller('SolicitudeCtrl', ($scope, $http, SolicitudesList) => {
  $scope.citizens = '';
  $scope.institutions = '';

  /*$scope.parishes = Parishes.get(function (data) {
    return $scope.parishes = data.parishes;
  })*/
  
  $scope.showSolicitude = (id) => {
    console.log(id);
  };
  
  $scope.removeSolicitude = (id) => {
    console.log(id);
  };

  SolicitudesList('Citizen').then( (response) => {
    $scope.citizens = response.data.solicitudes;
    $scope.citizens.type = 'Personas';
    $scope.citizens.status = 'Recibido';
  }, (error) => {
    console.log(error);
  });

  SolicitudesList('Institution').then( (response) => {
    $scope.institutions = response.data.solicitudes;
    $scope.institutions.type = 'Instituciones';
    $scope.institutions.status = 'Recibido';
  }, (error) => {
    console.log(error);
  });
})