/**
* Citizens.Create Module
*
* Description
*/
angular.module('Citizen.Create', ['SATCI.Shared', 'Citizen.resources'])
.controller('CreateCitizenCtrl', ($scope, $filter, Alertify, Citizens, Parishes) => {

  $scope.citizen = {
    identification: '',
    first_name: '',
    last_name: '',
    address: '',
    prefix_phone: '',
    number_phone: '',
    parish: ''
  };

  if ( !$scope.parishes ) {
    Parishes.get((data) => {
      $scope.parishes = data.parishes;
    })
  };

  $scope.saveCitizen = () =>{

    let dataCitizen = {
      identification: $scope.citizen.identification,
      full_name: $filter('titleCase')($scope.citizen.first_name +' '+ $scope.citizen.last_name),
      first_name: $filter('titleCase')($scope.citizen.first_name),
      last_name: $filter('titleCase')($scope.citizen.last_name),
      address: $scope.citizen.address,
      prefix_phone: $scope.citizen.prefix_phone,
      number_phone: $scope.citizen.number_phone,
      parish_id: $scope.citizen.parish.id
    }

    Citizens.save(dataCitizen).$promise.then(
      (data) => {
        if (data.success) {
          $scope.solicitude.full_name = data.citizen.full_name;
          $scope.solicitude.identification = data.citizen.identification;
          $scope.solicitude.applicant_id = data.citizen.id;
          Alertify.success('Persona registrada exitosamente');
          $scope.close();
        }
      },
      (fails) => {
        if (fails.status != 500) 
        {
          angular.forEach(fails.data, (values, key) => {
            angular.forEach(values, (value) => {
              Alertify.error(value)
            })
          })
        }
        else
        {
          console.log(fails);
        };
      })
  }
})
