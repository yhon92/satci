angular.module('Institution.Create', ['Institution.resources'])
.controller('CreateInstitutionCtrl', ['$scope', 'Institutions', ($scope, Institutions) => {
  $scope.applicant = {
    alerts: [],
  }

  $scope.institution = {
    identification: '',
    full_name: '',
    address: '',
    prefix_phone: '',
    number_phone: '',
    parish: '',
    agent_identification: '',
    agent_first_name: '',
    agent_last_name: ''
  };

  $scope.closeAlertApplicant = (index) => {
    $scope.applicant.alerts.splice(index, 1);
  };

  $scope.saveInstitution = () => {
    $scope.applicant = {
      alerts: [],
    }
    $scope.institution.agent_full_name = $scope.institution.agent_first_name + ' ' + $scope.institution.agent_last_name;
    $scope.institution.parish_id = $scope.institution.parish.id;
    delete $scope.institution.parish;
    
    Institutions.save($scope.institution).$promise.then(
      (data) => {
        if (data.success) {
          $scope.full_name = $scope.institution.full_name;
          $scope.identification = $scope.institution.identification;
          $scope.applicant_id = data.institution.id;
          $scope.solicitude.alerts = [{
            type: 'success',
            message: 'Institución registrada exitosamente',
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
