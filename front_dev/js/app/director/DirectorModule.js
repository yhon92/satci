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