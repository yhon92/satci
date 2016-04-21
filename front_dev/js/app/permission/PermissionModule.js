import './PermissionControllers';
import './PermissionResources';
import './create/CreatePermissionController';
import './edit/EditPermissionController';
import './show/ShowPermissionController';

angular.module('SATCI.Permission', [
  'ui.router', 
  'SATCI.Shared',
  'Permission.controllers', 
  'Permission.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('permission', {
    url: '/security/permission',
    templateUrl: `${PathTemplates.views}permission/index.html`,
    controller: 'PermissionCtrl'
  })
})
