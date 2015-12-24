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