angular.module('Report.controllers')
.controller('ApplicantsReportCtrl', ($scope, $http, $sce, $filter, $uibModal, Alertify, Reports, ResourcesUrl) => {
  
  $scope.applicant_type = 'Citizen';

  $scope.search = () => {
    let data = {
      applicant_type: $scope.applicant_type,
      parish: $scope.parish,
    }

    if (data.parish === undefined || data.parish === '') {
      data.parish = 'all';
    }

    $http.post(`${ResourcesUrl.api}report/list/applicant/`, data, {responseType: 'arraybuffer'})
      .then((response) => {
        let file = new Blob([response.data], {type: 'application/pdf'});
        let fileURL = URL.createObjectURL(file);
        $scope.content = $sce.trustAsResourceUrl(fileURL);
    });

  };

})