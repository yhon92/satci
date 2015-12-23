/**
* Institution.Edit Module
*
* Description
*/
angular.module('Institution.Edit', ['ui.router', 'Alertify', 'SATCI.Shared', 'Institution.resources'])
.controller('EditInstitutionCtrl', ($scope, $state, $stateParams, $filter, Alertify, Institutions, Parishes) => {

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  }

  if ( !$scope.parishes ) {
    Parishes.get((data) => {
      $scope.parishes = data.parishes;
    })
  };

  Institutions.get({id: $stateParams.id}).$promise.then(
    (data) => {
      $scope.institution = data.institution;
      $scope.institution.parish = data.institution.parish.id;
    },
    (errors) => {

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
    }

    Institutions.update({id: $stateParams.id}, dataInstitution).$promise.then(
      (data) => {
        if (data.success) {
          Alertify.success('Institución actuzalizada exitosamente');
          $state.transitionTo('institution', {
            reload: true, notify: false 
          });
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
      });
  };

  $scope.cancelInstitution = () => {
    $state.transitionTo('institution', {
        reload: true, notify: false 
      });
  };
})