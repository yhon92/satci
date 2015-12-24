import './CategoryControllers';
import './CategoryResources';
import './create/CreateCategoryController';
import './edit/EditCategoryController';
import './show/ShowCategoryController';

angular.module('SATCI.Category', [
  'ui.router', 
  'SATCI.Shared',
  'Category.controllers', 
  'Category.resources'
  ])