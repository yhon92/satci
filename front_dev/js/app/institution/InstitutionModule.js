import './InstitutionController';
import './InstitutionResources';
import './create/CreateInstitutionModule';
import './edit/EditInstitutionModule';
/**
* SATCI.Institutions Module
*
* Description
*/
angular.module('SATCI.Institution', ['ui.router', 'Institution.Create', 'Institution.Edit', 'Institution.controller'])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('institution', {
    url: '/applicant/institution',
    templateUrl: `${PathTemplates.views}institution/index.html`,
    controller: 'InstitutionCtrl'
  })
  .state('institutionCreate', {
    url: '/applicant/institution/create',
    views: {
      '': {
      templateUrl: `${PathTemplates.views}institution/create.html`,
      },
      'create@institutionCreate':{
        templateUrl: `${PathTemplates.partials}institution/create.html`,
        controller: 'CreateInstitutionCtrl'
      }
    },
  })
  .state('institutionEdit', {
    url: '/applicant/institution/edit/:id',
    views: {
      '': {
      templateUrl: `${PathTemplates.views}institution/edit.html`,
      },
      'edit@institutionEdit':{
        templateUrl: `${PathTemplates.partials}institution/create.html`,
        controller: 'EditInstitutionCtrl'
      }
    },
  })
})