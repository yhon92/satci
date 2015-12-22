import './CitizenController';
import './CitizenResources';
import './create/CreateCitizenModule';
import './edit/EditCitizenModule';
/**
* SATCI.Citizens Module
*
* Description
*/
angular.module('SATCI.Citizen',['ui.router', 'Citizen.Create', 'Citizen.Edit', 'Citizen.controller'])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('citizen', {
    url: '/applicant/citizen',
    templateUrl: `${PathTemplates.views}citizen/index.html`,
    controller: 'CitizenCtrl'
  })
  .state('citizenCreate', {
    url: '/applicant/citizen/create',
    views: {
      '': {
      templateUrl: `${PathTemplates.views}citizen/create.html`,
      },
      'create@citizenCreate':{
        templateUrl: `${PathTemplates.partials}citizen/create.html`,
        controller: 'CreateCitizenCtrl'
      }
    }
  })
  .state('citizenEdit', {
    url: '/applicant/citizen/edit/:id',
    views: {
      '': {
      templateUrl: `${PathTemplates.views}citizen/edit.html`,
      },
      'edit@citizenEdit':{
        templateUrl: `${PathTemplates.partials}citizen/create.html`,
        controller: 'EditCitizenCtrl'
      }
    }
  })
})
  