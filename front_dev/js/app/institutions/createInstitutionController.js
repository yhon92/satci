(function () {
  'use stric';
  
  angular.module('SATCI.controllers.CreateInstitutionCtrl',[])
  .controller('CreateInstitutionCtrl', ['$scope', 'Institutions', function ($scope, Institutions) {
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

    $scope.closeAlertApplicant = function(index) {
      $scope.applicant.alerts.splice(index, 1);
    };

    $scope.saveInstitution = function (){
      $scope.applicant = {
        alerts: [],
      }
      $scope.full_name = $scope.institution.full_name;
      $scope.identification = $scope.institution.identification.toUpperCase();
      $scope.applicantId = $scope.institution.identification;

      Institutions.save($scope.institution).$promise.then(
        function (data) {
          if (data.success) {
            $scope.full_name = $scope.institution.full_name;
            $scope.identification = $scope.institution.identification;
            $scope.applicantId = data.institution.id;
            $scope.solicitude.alerts = [{
              type: 'success',
              message: 'Institución registrada exitosamente',
            }];
            $scope.close();
          }
        },
        function (fails) {
          angular.forEach(fails.data, function(values, key) {
            angular.forEach(values, function(value){
              $scope.applicant.alerts.push({type: 'danger', message: value})
            })
          })
        })

    }
  }])
})();