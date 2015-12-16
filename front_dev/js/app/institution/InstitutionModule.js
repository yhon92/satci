import './InstitutionController';
import './InstitutionResources';
import './create/CreateInstitutionModule';
/**
* SATCI.Institutions Module
*
* Description
*/
angular.module('SATCI.Institution', ['ui.router', 'Institution.Create', 'Institution.controller'])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('institution', {
    url: '/applicant/institution',
    templateUrl: `${PathTemplates.views}institution/index.html`,
    controller: 'SolicitudeCtrl'
  })
  .state('institutionCreate', {
    url: '/applicant/institution/create',
    templateUrl: `${PathTemplates.views}institution/index.html`,
    controller: 'SolicitudeCtrl'
  })
})