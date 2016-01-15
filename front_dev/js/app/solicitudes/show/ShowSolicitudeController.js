angular.module('Solicitude.controllers')
.controller('ShowSolicitudeCtrl', (
  $state,
  $scope,
  $stateParams,
  $uibModal,
  AclService,
  Alertify,
  Solicitudes) => {

  $scope.can = AclService.can;
  
  $scope.solicitude = '';
  

  $scope.showLegende = $state.is('solicitudeShow');

  Solicitudes.get({id: $stateParams.id}).$promise.then( (data) => {
    $scope.solicitude = data.solicitude;
  }, (fails) => {

  });

  $scope.showApplicant = (type, applicant) => {
    let modalInstance = $uibModal.open({
      templateUrl: `modalShow${type}-template`,
      controller: ($scope, $uibModalInstance, applicant) => {
        $scope.applicant = applicant;

        $scope.close = () => {
          $uibModalInstance.dismiss();
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