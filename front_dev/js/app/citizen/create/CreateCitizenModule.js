/**
* Citizens.Create Module
*
* Description
*/
angular.module('Citizen.Create', ['Citizen.resources'])
.controller('CreateCitizenCtrl', ['$scope', 'Citizens', ($scope, Citizens) => {
  $scope.applicant = {
    alerts: [],
  }

  $scope.citizen = {
    identification: '',
    first_name: '',
    last_name: '',
    address: '',
    prefix_phone: '',
    number_phone: '',
    parish: ''
  };

  $scope.closeAlertApplicant = (index) => {
    $scope.applicant.alerts.splice(index, 1);
  };

  $scope.saveCitizen = () =>{
    $scope.applicant = {
      alerts: [],
    }
    $scope.citizen.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
    $scope.citizen.parish_id = $scope.citizen.parish.id;
    delete $scope.citizen.parish;

    Citizens.save($scope.citizen).$promise.then(
      (data) => {
        if (data.success) {
          $scope.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
          $scope.identification = $scope.citizen.identification;
          $scope.applicant_id = data.citizen.id;
          $scope.solicitude.alerts = [{
            type: 'success',
            message: 'Persona registrada exitosamente',
          }];
          $scope.close();
        }
      },
      (fails) => {
        angular.forEach(fails.data, (values, key) => {
          angular.forEach(values, (value) => {
            $scope.applicant.alerts.push({type: 'danger', message: value})
          })
        })
      })
  }
}])
