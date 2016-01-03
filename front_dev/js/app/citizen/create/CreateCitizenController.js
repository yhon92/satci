angular.module('Citizen.controllers')
.controller('CreateCitizenCtrl', ($scope, $state, $filter, Alertify, Helpers,Citizens, Parishes) => {

  $scope.button = {
    submit: 'Agregar',
    cancel: 'Limpiar'
  };

  $scope.prefixesPhone = Helpers.prefixesPhone;

  $scope.citizen = {
    identification: '',
    first_name: '',
    last_name: '',
    address: '',
    prefix_phone: '',
    number_phone: '',
    parish: ''
  };

  if (!$scope.parishes) {
    Parishes.get().$promise
    .then((data) => {
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
    };

    Citizens.save(dataCitizen).$promise
    .then((data) => {
      if (data.success) {
        if ($scope.solicitude) {
          $scope.solicitude.full_name = data.citizen.full_name;
          $scope.solicitude.identification = data.citizen.identification;
          $scope.solicitude.applicant_id = data.citizen.id;
          $scope.close();
        } else {
          $state.transitionTo('citizen', {
            reload: true, notify: false 
          });
        }
        Alertify.success('Persona registrada exitosamente');
      }
    })
    .catch((fails) => {
      if (fails.status != 500) {
        for (let firstKey in fails.data) {
          for (let secondKey in fails.data[firstKey]) {
            Alertify.error(fails.data[firstKey][secondKey]);
          }
        }
      } else {
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
