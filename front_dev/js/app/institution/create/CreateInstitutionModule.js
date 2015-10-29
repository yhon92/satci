angular.module('Institution.Create', ['Institution.resources'])
.controller('CreateInstitutionCtrl', ($scope, $filter, Alertify, Institutions) => {
/*
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
  };*/

  $scope.saveInstitution = () => {

    let dataInstitution = {
      identification: $filter('titleCase')($scope.institution.identification),
      full_name: $filter('titleCase')($scope.institution.full_name),
      address: $scope.institution.address,
      prefix_phone: $scope.institution.prefix_phone,
      number_phone: $scope.institution.number_phone,
      parish_id: $scope.institution.parish.id,
      agent_identification: $scope.institution.agent_identification,
      agent_full_name: $filter('titleCase')($scope.institution.agent_first_name +' '+ $scope.institution.agent_last_name),
      agent_first_name: $filter('titleCase')($scope.institution.agent_first_name),
      agent_last_name: $filter('titleCase')($scope.institution.agent_last_name)
    }

    Institutions.save(dataInstitution).$promise.then(
      (data) => {
        console.log(data)
        if (data.success) 
        {
          $scope.full_name = data.institution.full_name;
          $scope.identification = data.institution.identification;
          $scope.applicant_id = data.institution.id;
          Alertify.success('Institución registrada exitosamente');
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
