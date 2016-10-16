import './ReportControllers';
import './ReportResources';
import './controllers/ApplicantsReportController';
// import './controllers/AssignmentsReportController';
// import './controllers/SolicitudesReportController';
// import './create/CreateReportController';
// import './edit/EditReportController';
// import './show/ShowReportController';

angular.module('SATCI.Report', [
  'ui.router', 
  'SATCI.Shared',
  'Report.controllers', 
  'Report.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('report', {
    url: '/info/report',
    views: {
      '': {
        templateUrl: `${PathTemplates.views}report/index.html`,
      },
      'applicants@report': {
        templateUrl: `${PathTemplates.partials}report/applicants.html`,
        controller: 'ApplicantsReportCtrl',
      },
      'assignments@report': {
        templateUrl: `${PathTemplates.partials}report/assignments.html`,
        // controller: 'AssignmentsReportCtrl',
      },
      'solicitudes@report': {
        templateUrl: `${PathTemplates.partials}report/solicitudes.html`,
        // controller: 'SolicitudesReportCtrl',
      },
    }
  })
})