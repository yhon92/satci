import './SolicitudeControllers';
import './SolicitudeDirectives';
import './SolicitudeResources';
import './assign/AssignSolicitudeController';
import './create/CreateSolicitudeController';
import './edit/EditSolicitudeController';
import './show/ShowAssignSolicitudeController';
import './show/ShowSolicitudeController';

angular.module('SATCI.Solicitude', [
  'ui.router', 
  'SATCI.Shared',
  'Solicitude.controllers', 
  'Solicitude.directives', 
  'Solicitude.resources'
  ])
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
    resolve : {
      'acl' : ($q, AclService) => {
        if (AclService.can('create-assign-solicitude')) {
          // Has proper permissions
          return true;
        } else {
          // Does not have permission
          return $q.reject({unauthorized: true});
        }
      },
    },
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
        // templateUrl: '',
        controller: 'ShowAssignSolicitudeCtrl'
      }
    }
  })

})

