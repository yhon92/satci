(function () {
  'use stric';
  
  angular.module('SATCI.controllers.CreateCitizenCtrl',[])
  .controller('CreateCitizenCtrl', ['$scope', 'Citizens', function ($scope, Citizens) {
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

    $scope.closeAlertApplicant = function(index) {
      $scope.applicant.alerts.splice(index, 1);
    };

    $scope.saveCitizen = function (){
      $scope.applicant = {
        alerts: [],
      }
      $scope.citizen.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
      $scope.citizen.parish_id = $scope.citizen.parish.id;
      delete $scope.citizen.parish;

      Citizens.save($scope.citizen).$promise.then(
        function (data) {
          if (data.success) {
            $scope.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
            $scope.identification = $scope.citizen.identification;
            $scope.applicantId = data.citizen.id;
            $scope.solicitude.alerts = [{
              type: 'success',
              message: 'Persona registrada exitosamente',
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