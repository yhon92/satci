import './AreaControllers';
import './AreaResources';
import './create/CreateAreaController';
import './edit/EditAreaController';
import './show/ShowAreaController';

angular.module('SATCI.Area', [
  'ui.router', 
  'SATCI.Shared',
  'Area.controllers', 
  'Area.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('area', {
    url: '/config/area',
    templateUrl: `${PathTemplates.views}area/index.html`,
    controller: 'AreaCtrl'
  })
})