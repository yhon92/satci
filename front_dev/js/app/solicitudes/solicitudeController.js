(function () {
  'use stric';
  
  angular.module('SATCI.controllers.SolicitudeCtrl',[])
  .controller('SolicitudeCtrl', function ($scope, $http, SolicitudesList) {
    /*$scope.parishes = Parishes.get(function (data) {
      return $scope.parishes = data.parishes;
    })*/
  SolicitudesList('Citizen').then(function (response){
    // console.log(response.data.solicitudes);
    $scope.citizen = response.data.solicitudes;
  }, function (error){
    console.log(error);
  });

  SolicitudesList('Institution').then(function (response){
    // console.log(response.data.solicitudes);
    $scope.institution = response.data.solicitudes;
  }, function (error){
    console.log(error);
  });
})
})();