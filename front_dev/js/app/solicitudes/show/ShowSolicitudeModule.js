/**
* Solicitude.Assign Module
*
* Description
*/
angular.module('Solicitude.Show', ['ui.router', 'ui.bootstrap', 'Alertify', 'SATCI.Shared', 'Solicitude.resources'])
.controller('ShowSolicitudeCtrl', (
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
    // console.log(type);
    let modalInstance = $uibModal.open({
      templateUrl: `modalShow${type}-template`,
      controller: ($scope, $uibModalInstance, applicant) => {
        $scope.applicant = applicant;
        // console.log(applicant);

        $scope.close = function () {
          $uibModalInstance.close();
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