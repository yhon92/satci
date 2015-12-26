import './CitizenControllers';
import './CitizenResources';
import './create/CreateCitizenController';
import './edit/EditCitizenController';
import './show/ShowCitizenController';

angular.module('SATCI.Citizen', [
  'ui.router', 
  'SATCI.Shared', 
  'Citizen.controllers', 
  'Citizen.resources'
  ])
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
  