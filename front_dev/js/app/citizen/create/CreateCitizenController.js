angular.module('Citizen.controllers')
.controller('CreateCitizenCtrl', ($scope, $state, $filter, Alertify, Citizens, Parishes) => {
  
  $scope.button = {
    submit: 'Agregar',
    cancel: 'Limpiar'
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
      parish_id: $scope.citizen.parish
    }

    Citizens.save(dataCitizen).$promise.then(
      (data) => {
        if (data.success) {
          if ($scope.solicitude) {
            $scope.solicitude.full_name = data.citizen.full_name;
            $scope.solicitude.identification = data.citizen.identification;
            $scope.solicitude.applicant_id = data.citizen.id;
            $scope.close();
          }
          else {
            $state.transitionTo('citizen', {
              reload: true, notify: false 
            });
          }
          Alertify.success('Persona registrada exitosamente');
        }
      },
      (fails) => {
        if (fails.status != 500) {
          angular.forEach(fails.data, (values, key) => {
            angular.forEach(values, (value) => {
              Alertify.error(value)
            })
          })
        }
        else {
          console.log(fails);
        }
      });
  };

  $scope.cancelCitizen = () => {
    $scope.citizen = {
      identification: '',
      first_name: '',
      last_name: '',
      address: '',
      prefix_phone: '',
      number_phone: '',
      parish: ''
    };
  };
})
