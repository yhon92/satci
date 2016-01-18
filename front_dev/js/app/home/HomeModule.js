/**
* SATCI.Home Module
*
* Description
*/
angular.module('SATCI.Home', ['ui.router', 'SATCI.Shared'])
.config(($stateProvider, PathTemplates) => {
  $stateProvider
  .state('home', {
    url: '/home',
    templateUrl: `${PathTemplates.views}home/index.html`,
    controller: ($http) => {
      $http.get('/api/auth/user')
    }
  })
})