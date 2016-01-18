/*** Import Dependencies for AngularJS ***/
import 'angular';
import 'angular-acl';
import 'angular-animate';
import 'angular-resource';
import 'angular-sanitize';
import 'angular-ui-router';
import 'ui-select';
import 'angular-ui-bootstrap';
// import 'angular-bootstrap-npm';
import 'angular-loading-bar';
import 'angular-smart-table';
// import 'angular-moment';
// import 'ng-fx';
import 'satellizer';

import './libs/ng-alertify';

/*** Import Modules of SATCI ***/
import './app/area/AreaModule';
import './app/category/CategoryModule';
import './app/citizen/CitizenModule';
import './app/director/DirectorModule';
import './app/home/HomeModule';
import './app/institution/InstitutionModule';
import './app/login/LoginModule';
import './app/means/MeansModule';
import './app/nav/NavModule';
import './app/shared/SharedModule'
import './app/solicitudes/SolicitudeModule';
import './app/theme/ThemeModule';

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
  'mm.acl',

  'SATCI.Area',
  'SATCI.Category',
  'SATCI.Citizen',
  'SATCI.Director',
  'SATCI.Home',
  'SATCI.Institution',
  'SATCI.Login',
  'SATCI.Means',
  'SATCI.Nav',
  'SATCI.Shared',
  'SATCI.Solicitude',
  'SATCI.Theme',


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

  $urlRouterProvider.otherwise('/home');

  $httpProvider.interceptors.push('redirectWhenLoggedOut');

  $locationProvider.html5Mode(true);

  // uiSelectConfig.theme = 'selectize';
})
.run(($rootScope, $urlRouter, $state, $http, i18n_es, $templateCache, AclService, ResourcesUrl) => {
  $templateCache.remove('template/smart-table/pagination.html');
  // amMoment.changeLocale('de');
  // $stateChangeStart is fired whenever the state changes. We can use some parameters
  // such as toState to hook into details about the state as it is changing
  $rootScope.$on('$stateChangeStart', (event, toState) => {
    // Grab the user from local storage and parse it to an object
    let user = JSON.parse(sessionStorage.getItem('user'));
    let role = JSON.parse(sessionStorage.getItem('AclService'));
    // If there is any user data in local storage then the user is quite
    // likely authenticated. If their token is expired, or if they are
    // otherwise not actually authenticated, they will be redirected to
    // the auth state because of the rejected request anyway
    if(user) {
      $rootScope.authenticated = true;
      $rootScope.currentUser = user;
      
      if (!$rootScope.currentAcl && !role) {
        event.preventDefault();
        $http.get(ResourcesUrl.api + 'auth/permissions')
        .then((response) => {
          $rootScope.currentAcl = response.data.acl;

          let aclData = $rootScope.currentAcl;
          let role = Object.keys($rootScope.currentAcl)[0];

          AclService.setAbilities(aclData);
          AclService.attachRole(role);
          $urlRouter.sync();
        })
        .catch((fails) => {
          sessionStorage.removeItem('user');
          $rootScope.authenticated = false;
          $rootScope.currentUser = null;
          $rootScope.currentAcl = null;
          $state.go('login');
        })
      } else {
        AclService.resume()
      }
      
      if(toState.name === "login") {
        event.preventDefault();
        $state.go('home');
      };
    };
  });

  $rootScope.$on('$stateChangeError', (event, toState, toParams, fromState, fromParams, error) => {
    if (error.unauthorized) {
      $state.go('home');
    }
  });
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
