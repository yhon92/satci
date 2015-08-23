(function () {
  'use stric';
  angular.module('SATCI', 
    [
    // 'ngRoute',
    'ngAnimate',
    'ngResource',
    'ui.bootstrap',
    'ui.router',
    'satellizer',
    'smart-table',
    'angular-loading-bar',
    // '',
    'SATCI.controllers',
    'SATCI.services',
    'SATCI.resources',
    'SATCI.filters',
    
    ])
  .constant('PathTemplates', {
    views:    'templates/views/',
    partials: 'templates/partials/',
  })
  // .config(['$routeProvider', '$locationProvider', '$httpProvider', function ($routeProvider, $locationProvider, $httpProvider)
    .config(function (
      $authProvider, $stateProvider, $urlRouterProvider, $locationProvider, $httpProvider, PathTemplates
      ){
      // Push the new factory onto the $http interceptor array
      $httpProvider.interceptors.push('redirectWhenLoggedOut');

      $authProvider.loginUrl = "/api/auth/login";
      // $authProvider.signupUrl = "http://api.com/auth/signup";
      $authProvider.tokenName = "token";
      $authProvider.tokenPrefix = "SATCI";
      $authProvider.storageType = 'sessionStorage'

      $urlRouterProvider.otherwise('/auth/login');

      $stateProvider
      .state('login', {
        url: '/auth/login',
        templateUrl: PathTemplates.views + 'auth/login.html',
        controller: 'LoginCtrl'
      })

      .state('home', {
        url: '/home',
        templateUrl: PathTemplates.views + 'home/index.html'
      })

      .state('solicitude', {
        url: '/solicitude',
        templateUrl: PathTemplates.views + 'solicitude/index.html',
        controller: 'SolicitudeCtrl'
      })
      .state('solicitude.create', {
        url: '/create',
        templateUrl: PathTemplates.views + 'solicitude/create.html',
        controller: 'CreateSolicitudeCtrl'
      })
      .state('solicitude.edit', {
        url: '/edit/:id',
        templateUrl: PathTemplates.views + 'solicitude/index.html',
        controller: 'SolicitudeCtrl'
      })


      $httpProvider.interceptors.push('redirectWhenLoggedOut');

      $locationProvider.html5Mode(true);

    })
  .run(function($rootScope, $state) {
    // $stateChangeStart is fired whenever the state changes. We can use some parameters
    // such as toState to hook into details about the state as it is changing
    $rootScope.$on('$stateChangeStart', function(event, toState) {
      // Grab the user from local storage and parse it to an object
      var user = JSON.parse(sessionStorage.getItem('user'));      
      // If there is any user data in local storage then the user is quite
      // likely authenticated. If their token is expired, or if they are
      // otherwise not actually authenticated, they will be redirected to
      // the auth state because of the rejected request anyway
      if(user) {
        // The user's authenticated state gets flipped to
        // true so we can now show parts of the UI that rely
        // on the user being logged in
        $rootScope.authenticated = true;
        // Putting the user's data on $rootScope allows
        // us to access it anywhere across the app. Here
        // we are grabbing what is in local storage
        $rootScope.currentUser = user;
        // If the user is logged in and we hit the auth route we don't need
        // to stay there and can send the user to the main state
        if(toState.name === "login") {
          // Preventing the default behavior allows us to use $state.go
          // to change states
          event.preventDefault();
          // go to the "main" state which in our case is users
          $state.go('home');
        }
      }
    });
  });

})();