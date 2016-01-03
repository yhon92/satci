import './DirectorControllers';
import './DirectorResources';
import './create/CreateDirectorController';
import './edit/EditDirectorController';
import './show/ShowDirectorController';

angular.module('SATCI.Director', [
  'ui.router', 
  'SATCI.Shared',
  'Director.controllers', 
  'Director.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('director', {
    url: '/config/director',
    templateUrl: `${PathTemplates.views}director/index.html`,
    controller: 'DirectorCtrl'
  })
})