angular.module('Institution.controllers')
.controller('CreateInstitutionCtrl', ($scope, $state, $filter, AclService, Alertify, Helpers, Institutions, Parishes) => {

  $scope.can = AclService.can;

  $scope.button = {
    submit: 'Agregar',
    cancel: 'Limpiar'
  };

  $scope.prefixesPhone = Helpers.prefixesPhone;

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

  if ($state.is('institutionCreate')) {
    Parishes.get().$promise
    .then((data) => {
      $scope.parishes = data.parishes;
    })
  };

  $scope.saveInstitution = () => {

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

    Institutions.save(dataInstitution).$promise
    .then((data) => {
      if (data.success) {
        if ($scope.solicitude) {
          $scope.solicitude.full_name = data.institution.full_name;
          $scope.solicitude.identification = data.institution.identification;
          $scope.solicitude.applicant_id = data.institution.id;
          $scope.close();
        } else {
          $state.transitionTo('institution', {
            reload: true, notify: false 
          });
        }
        Alertify.success('Institución registrada exitosamente');
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
  };
})
