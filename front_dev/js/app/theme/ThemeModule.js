import './ThemeControllers';
import './ThemeResources';
import './create/CreateThemeController';
import './edit/EditThemeController';
import './show/ShowThemeController';

angular.module('SATCI.Theme', [
  'ui.router', 
  'SATCI.Shared',
  'Theme.controllers', 
  'Theme.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('theme', {
    url: '/config/theme',
    templateUrl: `${PathTemplates.views}theme/index.html`,
    controller: 'ThemeCtrl'
  })
  .state('themeShow', {
    url: '/config/theme/:id',
    templateUrl: `${PathTemplates.views}theme/index.html`,
    controller: 'ThemeCtrl'
  })
})