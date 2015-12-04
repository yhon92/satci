import './SolicitudeController';
import './SolicitudeDirectives';
import './SolicitudeResources';
import './assign/AssignSolicitudeModule';
import './create/CreateSolicitudeModule';
import './edit/EditSolicitudeModule';
import './show/ShowSolicitudeModule';

angular.module('SATCI.Solicitude', [
  'ui.router', 
  'SATCI.Shared',
  'Solicitude.controller', 
  'Solicitude.directives', 
  'Solicitude.resources', 
  'Solicitude.Assign',
  'Solicitude.Create',
  'Solicitude.Edit',
  'Solicitude.Show'])

.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('solicitude', {
    url: '/solicitude',
    templateUrl: `${PathTemplates.views}solicitude/index.html`,
    controller: 'SolicitudeCtrl'
  })
  .state('solicitudeCreate', {
    url: '/solicitude/create',
    templateUrl: `${PathTemplates.views}solicitude/create.html`,
    controller: 'CreateSolicitudeCtrl'
  })
  .state('solicitudeEdit', {
    url: '/solicitude/edit/:id',
    templateUrl: `${PathTemplates.views}solicitude/edit.html`,
    controller: 'EditSolicitudeCtrl'
  })
  .state('solicitudeAssign', {
    url: '/solicitude/assign/:id',
    views: {
      '': {
        templateUrl: `${PathTemplates.views}solicitude/assign.html`,
      },
      'show@solicitudeAssign': {
        templateUrl: `${PathTemplates.partials}solicitude/show.html`,
        controller: 'ShowSolicitudeCtrl'
      },
      'assign@solicitudeAssign': {
        templateUrl: `${PathTemplates.partials}solicitude/assign.html`,
        controller: 'AssignSolicitudeCtrl'
      }
    }
  })
  .state('solicitudeShow', {
    url: '/solicitude/show/:id',
    views: {
      '': {
        templateUrl: `${PathTemplates.views}solicitude/show.html`,
      },
      'show@solicitudeShow': {
        templateUrl: `${PathTemplates.partials}solicitude/show.html`,
        controller: 'ShowSolicitudeCtrl'
      },
      'assign@solicitudeShow': {
        controller: 'ShowAssignSolicitudeCtrl'
      }
    }
  })

})

