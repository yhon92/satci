angular.module('Institution.controllers')
.controller('EditInstitutionCtrl', ($scope, $state, $stateParams, $filter, AclService, Alertify, Helpers, Institutions, Parishes) => {

  $scope.can = AclService.can;

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  };

  $scope.prefixesPhone = Helpers.prefixesPhone;

  if (!$scope.parishes) {
    Parishes.get((data) => {
      $scope.parishes = data.parishes;
    })
  };

  Institutions.get({id: $stateParams.id}).$promise
  .then((data) => {
    $scope.institution = data.institution;
    $scope.institution.parish = data.institution.parish.id;
  })
  .catch((fails) => {

  });

  $scope.saveInstitution = () =>{

    let dataInstitution = {
      identification: $filter('titleCase')($scope.institution.identification),
      full_name: $filter('titleCase')($scope.institution.full_name),
      address: $scope.institution.address,
      prefix_phone: $scope.institution.prefix_phone,
      number_phone: $scope.institution.number_phone,
      parish_id: $scope.institution.parish,
      agent_identification: $scope.institution.agent_identification,
      agent_full_name: $filter('titleCase')($scope.institution.agent_first_name +' '+ $scope.institution.agent_last_name),
      agent_first_name: $filter('titleCase')($scope.institution.agent_first_name),
      agent_last_name: $filter('titleCase')($scope.institution.agent_last_name)
    };

    Institutions.update({id: $stateParams.id}, dataInstitution).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('Institución actuzalizada exitosamente');
        $state.transitionTo('institution', {
          reload: true, notify: false 
        });
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
      };
    });
  };

  $scope.cancelInstitution = () => {
    $state.transitionTo('institution', {
      reload: true, notify: false 
    });
  };
})