import './StatisticControllers';
import './StatisticResources';
import './controllers/ApplicantsStatisticController';
import './controllers/AssignmentsStatisticController';
import './controllers/SolicitudesStatisticController';
import './create/CreateStatisticController';
import './edit/EditStatisticController';
import './show/ShowStatisticController';

angular.module('SATCI.Statistic', [
  'ui.router', 
  'SATCI.Shared',
  'Statistic.controllers', 
  'Statistic.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('statistic', {
    url: '/info/statistic',
    views: {
      '': {
        templateUrl: `${PathTemplates.views}statistic/index.html`,
      },
      'applicants@statistic': {
        templateUrl: `${PathTemplates.partials}statistic/applicants.html`,
        controller: 'ApplicantsStatisticCtrl',
      },
      'assignments@statistic': {
        templateUrl: `${PathTemplates.partials}statistic/assignments.html`,
        controller: 'AssignmentsStatisticCtrl',
      },
      'solicitudes@statistic': {
        templateUrl: `${PathTemplates.partials}statistic/solicitudes.html`,
        controller: 'SolicitudesStatisticCtrl',
      },
    }
  })
})