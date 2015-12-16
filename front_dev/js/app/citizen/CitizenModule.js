import './CitizenController';
import './CitizenResources';
import './create/CreateCitizenModule';
/**
* SATCI.Citizens Module
*
* Description
*/
angular.module('SATCI.Citizen',['ui.router', 'Citizen.Create', 'Citizen.controller'])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('citizen', {
    url: '/applicant/citizen',
    templateUrl: `${PathTemplates.views}citizen/index.html`,
    controller: 'SolicitudeCtrl'
  })
  .state('citizenCreate', {
    url: '/applicant/citizen/create',
    templateUrl: `${PathTemplates.views}citizen/index.html`,
    controller: 'SolicitudeCtrl'
  })
})
  