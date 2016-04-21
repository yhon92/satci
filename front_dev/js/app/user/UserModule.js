import './UserControllers';
import './UserResources';
import './create/CreateUserController';
import './edit/EditUserController';
import './show/ShowUserController';

angular.module('SATCI.User', [
  'ui.router', 
  'SATCI.Shared',
  'User.controllers', 
  'User.resources'
  ])
.config(($authProvider, $stateProvider, PathTemplates) => {
  $stateProvider
  .state('user', {
    url: '/security/user',
    templateUrl: `${PathTemplates.views}user/index.html`,
    controller: 'UserCtrl'
  })
})
