/**
* Solicitude.Assign Module
*
* Description
*/
angular.module('Solicitude.Assign', ['ui.router', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources'])
.controller('AssignSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  Alertify,
  Solicitudes) => {
  $scope.solicitude = '';
/*  let solicitude = Solicitudes.get({id: $stateParams.id});
  // console.log(solicitude);*/

  Solicitudes.get({id: $stateParams.id}).$promise.then( (response) => {
    $scope.solicitude = response.solicitude;
  }, (error) => {

  });

  $scope.showApplicant = (type, applicant) => {
    console.log(type);
    let modalInstance = $uibModal.open({
      templateUrl: `modalShow${type}-template`,
      controller: ($scope, $modalInstance, applicant) => {
        $scope.applicant = applicant;
        console.log(applicant);

        $scope.close = function () {
          $modalInstance.close();
        };
      },
      size: 'sm',
      resolve: {
        applicant: () => {
          return applicant;
        }
      }
    });
  }

})