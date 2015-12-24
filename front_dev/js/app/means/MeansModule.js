import './MeansControllers';
import './MeansResources';
import './create/CreateMeansController';
import './edit/EditMeansController';
import './show/ShowMeansController';

angular.module('SATCI.Means', [
  'ui.router', 
  'SATCI.Shared',
  'Means.controllers', 
  'Means.resources'
  ])