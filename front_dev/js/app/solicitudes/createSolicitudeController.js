(function () {
  'use stric';
  
  angular.module('SATCI.controllers.CreateSolicitudeCtrl',[])
  .controller('CreateSolicitudeCtrl', 
    ['$scope', '$controller', 'Citizens', 'Institutions', 'Parishes', 'paginateService', 
    function ($scope, $controller, Citizens, Institutions, Parishes, paginateService) {

      $controller('CreateCitizenCtrl', {$scope : $scope});
      $controller('CreateInstitutionCtrl', {$scope : $scope});

      var add = null;
      var search = null;
      var applicantType = '';

      $scope.full_name = null;
      $scope.applicantId = null;
      $scope.identification = null;
      $scope.solicitude = {
        alerts: [],
      }

      $scope.addApplicant = function (){
        add = true;
        search = false;

        $scope.full_name = null;
        $scope.applicantId = null;
        $scope.identification = null;

        $scope.applicantTemplate = 'templates/partials/applicant/'+ applicantType +'-form.html';
      };

      $scope.clear = function (){
        $scope.identification = null;
        $scope.full_name = null;
        $scope.applicantId = null;
        $scope.template = null;
        $scope.applicantType = null;
        $scope.applicantTemplate = null;
      }

      $scope.close = function (){
        add = null;
        search = null
        $scope.template = '';
        $scope.applicant = false;
        $scope.applicantTemplate = '';
      };

      $scope.closeAlertSolicitude = function(index) {
        $scope.solicitude.alerts.splice(index, 1);
      };

      $scope.getApplicant = function (type){
        $scope.applicantType = applicantType = type;
        $scope.template = 'templates/partials/solicitude/applicant.html';
      };

      $scope.parishes = Parishes.get(function (data) {
        return $scope.parishes = data.parishes;
      })

      $scope.searchApplicant = function (){
        search = true;
        add = false;

        if (applicantType === 'citizen') {
          Citizens.get(function (data) {
            $scope.applicants = data.citizens;
          });
        }
        if (applicantType === 'institution') {
          Institutions.get(function (data) {
            $scope.applicants = data.institutions;
          });
        }

        $scope.applicantTemplate = 'templates/partials/solicitude/search-applicant.html';
      };

      $scope.selectApplicant = function (id, identification, full_name) {
        $scope.full_name = full_name;
        $scope.applicantId = id;
        $scope.identification = identification;
      };

      $scope.$watch('applicantType', function () {
        if (add) {
          $scope.addApplicant();
        }
        if (search) {
          $scope.applicantTemplate = '';
        // $scope.searchApplicant();
      }
    });

      $scope.displayed = [];

      $scope.callServer = function callServer (tableState) {

        $scope.isLoading = true;
        var pagination = tableState.pagination;
      // $scope.DisplayedPages = 1;

      var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
      var number = pagination.number || 10;  // Number of entries showed per page.

      paginateService.getPage($scope.applicants, start, number, tableState).then(function (result) {

        $scope.displayed = result.data;
        tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
        $scope.isLoading = false;

      });
    };
  }])
})();