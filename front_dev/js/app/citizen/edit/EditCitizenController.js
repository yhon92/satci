angular.module('Citizen.controllers')
.controller('EditCitizenCtrl', ($scope, $state, $stateParams, $filter, Alertify, Citizens, Parishes) => {

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  }

  if ( !$scope.parishes ) {
    Parishes.get((data) => {
      $scope.parishes = data.parishes;
    })
  };

  Citizens.get({id: $stateParams.id}).$promise.then(
    (data) => {
      $scope.citizen = data.citizen;
      $scope.citizen.parish = data.citizen.parish.id;
    },
    (errors) => {

    });

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

    Citizens.update({id: $stateParams.id}, dataCitizen).$promise.then(
      (data) => {
        if (data.success) {
          Alertify.success('Persona actuzalizada exitosamente');
          $state.transitionTo('citizen', {
            reload: true, notify: false 
          });
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
        };
      });
  };

  $scope.cancelCitizen = () => {
    $state.transitionTo('citizen', {
        reload: true, notify: false 
      });
  };
})