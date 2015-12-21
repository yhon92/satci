/**
* Institution.controller Module
*
* Description
*/
angular.module('Institution.controller', ['Institution.resources'])
.controller('InstitutionCtrl', ($scope, Institutions) => {

  Institutions.get().$promise
  .then((data) => {
    $scope.institutions = data.institutions;
    $scope.institutions.type = 'Jurídicos';
  },
  (errors) => {
    
  });


})