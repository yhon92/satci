/*** Import Dependencies for AngularJS ***/
import 'angular';
import 'angular-animate';
import 'angular-resource';
import 'angular-sanitize';
import 'angular-ui-router';
import 'ui-select';
import 'angular-bootstrap-npm';
import 'angular-loading-bar';
import 'angular-smart-table';
// import 'angular-moment';
// import 'ng-fx';
import 'satellizer';

import './libs/ng-alertify';

import './app/validation';

/*** Import Modules of SATCI ***/
import './app/citizen/CitizenModule';
import './app/home/HomeModule';
import './app/institution/InstitutionModule';
import './app/login/LoginModule';
import './app/nav/NavModule';
import './app/shared/SharedModule'
import './app/solicitudes/SolicitudeModule';
import './app/category/CategoryModule';
import './app/theme/ThemeModule';
import './app/area/AreaModule';

// import './app/';
import './app/services/RedirectWhenLoggedOut';
import './app/ui/Datepicker';

angular.module('SATCI', [
  'ngAnimate',
  'ngSanitize',
  'ui.bootstrap',
  'ui.router',
  'satellizer',
  'smart-table',
  // 'angularMoment',
  'angular-loading-bar',
  'Alertify',

  'SATCI.Citizen',
  'SATCI.Home',
  'SATCI.Institution',
  'SATCI.Login',
  'SATCI.Nav',
  'SATCI.Shared',
  'SATCI.Solicitude',
  'SATCI.Category',
  'SATCI.Theme',
  'SATCI.Area',


  'SATCI.RedirectWhenLoggedOutServices',
  'SATCI.Datepicker',
  ])
.config((
  $authProvider, 
  $urlRouterProvider, 
  $locationProvider, 
  $provide,
  $httpProvider, 
  uiSelectConfig,
  PathTemplates
  ) => {

  // Push the new factory onto the $http interceptor array
  $httpProvider.interceptors.push('redirectWhenLoggedOut');

  $authProvider.loginUrl = "/api/auth/login";
  // $authProvider.signupUrl = "http://api.com/auth/signup";
  $authProvider.tokenName = "token";
  $authProvider.tokenPrefix = "SATCI";
  $authProvider.storageType = 'sessionStorage'

  $urlRouterProvider.otherwise('/auth/login');

  $httpProvider.interceptors.push('redirectWhenLoggedOut');

  $locationProvider.html5Mode(true);

  // uiSelectConfig.theme = 'selectize';
})
.run(($rootScope, $state, i18n_es, $templateCache) => {
  $templateCache.remove('template/smart-table/pagination.html');
  // amMoment.changeLocale('de');
  // $stateChangeStart is fired whenever the state changes. We can use some parameters
  // such as toState to hook into details about the state as it is changing
  $rootScope.$on('$stateChangeStart', (event, toState) => {
    // Grab the user from local storage and parse it to an object
    let user = JSON.parse(sessionStorage.getItem('user'));      
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
  })
})
.service('i18n_es', ($locale) => {
  $locale.DATETIME_FORMATS.DAY = [
  "Domingo",
  "Lunes",
  "Martes",
  "Miércoles",
  "Jueves",
  "Viernes",
  "Sábado",
  ];
  $locale.DATETIME_FORMATS.SHORTDAY = [
  "Dom",
  "Lun",
  "Mar",
  "Mié",
  "Jue",
  "Vie",
  "Sáb"
  ];
  $locale.DATETIME_FORMATS.MONTH = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
  ];
  $locale.DATETIME_FORMATS.SHORTMONTH = [
  "Ene",
  "Feb",
  "Mar",
  "Abr",
  "May",
  "Jun",
  "Jul",
  "Ago",
  "Sep",
  "Oct",
  "Nov",
  "Dic"
  ];
  // console.log($locale.DATETIME_FORMATS);
})
