/**
* Citizens.controller Module
*
* Description
*/
angular.module('Citizen.controller', ['Citizen.resources'])
.controller('CitizenCtrl', ($scope, Citizens) => {

  Citizens.get().$promise
  .then((data) => {
    $scope.citizens = data.citizens;
    $scope.citizens.type = 'Naturales';
  },
  (errors) => {
    
  });

  $scope.remove = (id) => {
    console.log(id);
  };
});
