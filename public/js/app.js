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
function onlyLetters(e){
	var key = e.keyCode || e.which,
	tecla = String.fromCharCode(key).toLowerCase(),
	letras = " áéíóúüabcdefghijklmnñopqrstuvwxyz",
	especiales = [8,37,39,46],
	tecla_especial = false

	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function onlyNumbers(e){
	var key = e.keyCode || e.which,
	tecla = String.fromCharCode(key).toLowerCase(),
	num = "0123456789",
	especiales = [8,37,39,46],
	tecla_especial = false

	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	if(num.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function onlyClear(e){
	var key = e.keyCode || e.which,
	tecla = String.fromCharCode(key).toLowerCase(),
	num = "",
	especiales = [8,13,],
	tecla_especial = false
	
	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	if(num.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function noKey (e){
	return false;
}
// Forma de Uso: onkeyup="cedulaMask(this)"
function cedulaMask (input){
	// var number = new String(input.value);
	// number = number.replace(/\./g,''); //quita todos los puntos de la cadena
	// var result = '';
	// while( number.length > 3 ){
	// 	result = '.' + number.substr(number.length - 3) + result;
	// 	number = number.substring(0, number.length - 3);
	// }
	// result = number + result;
	// input.value = result;



	var num = input.value.replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	}
	// else{
		// alert('Solo se permiten numeros');
		// input.value = input.value.replace(/[^\d\.]*/g,'');
	// }
}

function solicitudeNumberMask (input, e) {
	var key = e.which || e.keyCode;
	var input = input.value;
	
	if (key == 45 && (input.length === 3)) {
		return true;
	}
	if (key >= 48 && key <= 57 && (input.length >= 0 && input.length <= 2) || (input.length >= 4 && input.length <= 6)) {
		return true;
	}
	return false;
}

function rifMask (input, e){
	var key = e.which || e.keyCode;
	var input = input.value;

	/*
		69 = E, 101 = e, 71 = G, 103 = g, 73 = I, 105 = i
		74 = J, 106 = j, 77 = M, 109 = m, 80 = P, 112 = p
		82 = R, 114 = r, 86 = V, 118 = v
		*/
		if (((key == 69 || key == 101) || (key == 71 || key == 103) || (key == 73 || key == 105) || 
			(key == 74 || key == 106) || (key == 77 || key == 109) || (key == 80 || key == 112) ||
			(key == 82 || key == 114) ||	(key == 86 || key == 118)) && input.length === 0 ) {
			return true;
	}
	if (key == 45 && (input.length === 1 || input.length === 10)) {
		return true;
	}
	if (key >= 48 && key <= 57 && (input.length >= 2 && input.length <= 9) || input.length === 11) {
		return true;
	}
	return false;
}

(function () {
	'use stric';
	
	angular.module('SATCI.controllers',[])
	.controller('LoginCtrl', function ($auth, $state, $http, $scope, $rootScope, cfpLoadingBar) {
		cfpLoadingBar.start();
		
		$scope.loginError = false;
		$scope.loginErrorText;

		$scope.login = function(){
			var credentials = {
				username: $scope.username,
				password: $scope.password
			}
      // Use Satellizer's $auth service to login
      $auth.login(credentials).then(function() {
    	  // If login is successful, redirect to the users state
  	    // $state.go('home', {});
	      // Return an $http request for the now authenticated
      	// user so that we can flatten the promise chain
      	return $http.get('/api/auth/user');
      }, function(error) {
      	$rootScope.loginError = true;
      	$rootScope.loginErrorText = error.data.error;

      	// Because we returned the $http.get request in the $auth.login
      	// promise, we can chain the next promise to the end here
      }).then(function(response) {
      	// Stringify the returned data to prepare it
      	// to go into local storage
      	var user = JSON.stringify(response.data.user);
      	// Set the stringified user data into local storage
      	sessionStorage.setItem('user', user);
      	// The user's authenticated state gets flipped to
      	// true so we can now show parts of the UI that rely
      	// on the user being logged in
      	$rootScope.authenticated = true;
      	// Putting the user's data on $rootScope allows
      	// us to access it anywhere across the app
      	$rootScope.currentUser = response.data.user;
  	    // Everything worked out so we can now redirect to
    	  // the users state to view the data
    	  $state.go('home');
    	});
    }
    setTimeout(function() {
			cfpLoadingBar.complete();
    }, 600);
  })

.controller('NavCtrl', function ($auth, $state, $scope, $rootScope, $location) {
	$scope.logout = function() {
		//Remove the satellizer_token from localstorage
		$auth.logout().then(function(){
			//Remove the authenticated user from local storage
			sessionStorage.removeItem('user');
			//Flip authenticated to false so that we no longer
			//show UI elements dependant on the user being logged in
			$rootScope.authenticated = false;
			//Remove the current user from rootscope
			$rootScope.currentUser = null;
			$state.go('login');
		});
	};
	
	$scope.navClass = function (page) {
		var currentRoute;
		var path = $location.path().substring(1) || 'home';
		var stop = path.search('/');
		if (stop > 0) {
			currentRoute = path.substr(0,stop);
		}else {
			currentRoute = path;
		}
		return page === currentRoute ? 'active' : '';
	};
})

.controller('SidebarCtrl', ['$scope', '$location', function ($scope, $location) {
	$scope.navClass = function (page) {
		var currentRoute;
		var path = $location.path().substring(1) || 'home';
		var stop = path.search('/');
		if (stop > 0) {
			currentRoute = path.substr(0,stop);
		}else {
			currentRoute = path;
		}
		return page === currentRoute ? 'active' : '';
	};
}])

.controller('DropdownCtrl', function($scope){

	$scope.navbarCollapsed = true;

	$scope.status = {
		isOpen: false
	};

	$scope.toggleDropdown  = function ($event) {

		$event.preventDefault();
		$event.stopPropagation();

		$scope.status.isOpen = !$scope.status.isOpen;

	};
})

.controller('DatepickerCtrl', function ($scope) {
	$scope.today = function() {
		$scope.dt = new Date();
	};
		// $scope.today();

		$scope.clear = function () {
			$scope.dt = null;
		};

		// Disable weekend selection
		$scope.disabled = function(date, mode) {
			return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
		};

		$scope.toggleMin = function() {
			// $scope.minDate = $scope.minDate ? null : new Date();
			var date = new Date();
			$scope.minDate = date.getFullYear() + '-01-02'
		};
		$scope.toggleMin();
		
		$scope.toggleMax = function() {
			$scope.maxDate = $scope.maxDate ? null : new Date();
		};
		$scope.toggleMax();

		$scope.open = function($event) {
			$event.preventDefault();
			$event.stopPropagation();

			$scope.opened = !$scope.opened;
		};

		$scope.dateOptions = {
			formatYear: 'yy',
			startingDay: 1
		};

		$scope.formats = ['dd-MMMM-yyyy', 'dd/MM/yyyy', 'dd.MM.yyyy', 'shortDate'];
		$scope.format = $scope.formats[0];

		var tomorrow = new Date();
		tomorrow.setDate(tomorrow.getDate() + 1);
		var afterTomorrow = new Date();
		afterTomorrow.setDate(tomorrow.getDate() + 2);
		$scope.events =
		[
		{
			date: tomorrow,
			status: 'full'
		},
		{
			date: afterTomorrow,
			status: 'partially'
		}
		];

		$scope.getDayClass = function(date, mode) {
			if (mode === 'day') {
				var dayToCheck = new Date(date).setHours(0,0,0,0);

				for (var i=0;i<$scope.events.length;i++){
					var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

					if (dayToCheck === currentDay) {
						return $scope.events[i].status;
					}
				}
			}

			return '';
		};
	})

.controller('SolicitudeCtrl', function ($scope, $http, SolicitudesList) {
/*	$scope.parishes = Parishes.get(function (data) {
			return $scope.parishes = data.parishes;
		})*/
			
			SolicitudesList('Citizen').then(function (response){
				// console.log(response.data.solicitudes);
				$scope.citizen = response.data.solicitudes;
			}, function (error){
				console.log(error);
			});

			SolicitudesList('Institution').then(function (response){
				// console.log(response.data.solicitudes);
				$scope.institution = response.data.solicitudes;
			}, function (error){
				console.log(error);
			});
})

.controller('CreateSolicitudeCtrl', 
	['$scope', '$controller', 'Citizens', 'Institutions', 'Parishes', 'paginateService', 
	function ($scope, $controller, Citizens, Institutions, Parishes, paginateService) {

		$controller('CreateCitizenCtrl', {$scope : $scope});
		$controller('CreateInstitutionCtrl', {$scope : $scope});
		
		var add = null;
		var search = null;
		var applicantType = '';

		$scope.full_name = null;
		$scope.applicantId = null;
		$scope.identification = null;
		$scope.solicitude = {
			alerts: [],
		}

		$scope.addApplicant = function (){
			add = true;
			search = false;

			$scope.full_name = null;
			$scope.applicantId = null;
			$scope.identification = null;

			$scope.applicantTemplate = 'templates/partials/applicant/'+ applicantType +'-form.html';
		};

		$scope.clear = function (){
			$scope.identification = null;
			$scope.full_name = null;
			$scope.applicantId = null;
			$scope.template = null;
			$scope.applicantType = null;
			$scope.applicantTemplate = null;
		}

		$scope.close = function (){
			add = null;
			search = null
			$scope.template = '';
			$scope.applicant = false;
			$scope.applicantTemplate = '';
		};

		$scope.closeAlertSolicitude = function(index) {
			$scope.solicitude.alerts.splice(index, 1);
		};

		$scope.getApplicant = function (type){
			$scope.applicantType = applicantType = type;
			$scope.template = 'templates/partials/solicitude/applicant.html';
		};

		$scope.parishes = Parishes.get(function (data) {
			return $scope.parishes = data.parishes;
		})

		$scope.searchApplicant = function (){
			search = true;
			add = false;

			if (applicantType === 'citizen') {
				Citizens.get(function (data) {
					$scope.applicants = data.citizens;
				});
			}
			if (applicantType === 'institution') {
				Institutions.get(function (data) {
					$scope.applicants = data.institutions;
				});
			}

			$scope.applicantTemplate = 'templates/partials/solicitude/search-applicant.html';
		};

		$scope.selectApplicant = function (id, identification, full_name) {
			$scope.full_name = full_name;
			$scope.applicantId = id;
			$scope.identification = identification;
		};

		$scope.$watch('applicantType', function () {
			if (add) {
				$scope.addApplicant();
			}
			if (search) {
				$scope.applicantTemplate = '';
				// $scope.searchApplicant();
			}
		});

		$scope.displayed = [];

		$scope.callServer = function callServer (tableState) {

			$scope.isLoading = true;
			var pagination = tableState.pagination;
			// $scope.DisplayedPages = 1;

			var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
			var number = pagination.number || 10;  // Number of entries showed per page.

			paginateService.getPage($scope.applicants, start, number, tableState).then(function (result) {
				
				$scope.displayed = result.data;
				tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
				$scope.isLoading = false;

			});
		};
	}])

.controller('CreateCitizenCtrl', ['$scope', 'Citizens', function ($scope, Citizens) {
	$scope.applicant = {
		alerts: [],
	}

	$scope.citizen = {
		identification: '',
		first_name: '',
		last_name: '',
		address: '',
		prefix_phone: '',
		number_phone: '',
		parish: ''
	};

	$scope.closeAlertApplicant = function(index) {
		$scope.applicant.alerts.splice(index, 1);
	};

	$scope.saveCitizen = function (){
		$scope.applicant = {
			alerts: [],
		}
		$scope.citizen.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
		$scope.citizen.parish_id = $scope.citizen.parish.id;
		delete $scope.citizen.parish;

		Citizens.save($scope.citizen).$promise.then(
			function (data) {
				if (data.success) {
					$scope.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
					$scope.identification = $scope.citizen.identification;
					$scope.applicantId = data.citizen.id;
					$scope.solicitude.alerts = [{
						type: 'success',
						message: 'Persona registrada exitosamente',
					}];
					$scope.close();
				}
			},
			function (fails) {
				angular.forEach(fails.data, function(values, key) {
					angular.forEach(values, function(value){
						$scope.applicant.alerts.push({type: 'danger', message: value})
					})
				})
			})
	}
}])

.controller('CreateInstitutionCtrl', ['$scope', 'Institutions',	function ($scope, Institutions) {
	$scope.applicant = {
		alerts: [],
	}

	$scope.institution = {
		identification: '',
		full_name: '',
		address: '',
		prefix_phone: '',
		number_phone: '',
		parish: '',
		agent_identification: '',
		agent_first_name: '',
		agent_last_name: ''
	};

	$scope.closeAlertApplicant = function(index) {
		$scope.applicant.alerts.splice(index, 1);
	};

	$scope.saveInstitution = function (){
		$scope.applicant = {
			alerts: [],
		}
		$scope.full_name = $scope.institution.full_name;
		$scope.identification = $scope.institution.identification.toUpperCase();
		$scope.applicantId = $scope.institution.identification;

		Institutions.save($scope.institution).$promise.then(
			function (data) {
				if (data.success) {
					$scope.full_name = $scope.institution.full_name;
					$scope.identification = $scope.institution.identification;
					$scope.applicantId = data.institution.id;
					$scope.solicitude.alerts = [{
						type: 'success',
						message: 'Institución registrada exitosamente',
					}];
					$scope.close();
				}
			},
			function (fails) {
				angular.forEach(fails.data, function(values, key) {
					angular.forEach(values, function(value){
						$scope.applicant.alerts.push({type: 'danger', message: value})
					})
				})
			})

	}
}])


})();

(function () {
	'use stric';

	angular.module('SATCI.filters', [])

	.filter("capitalize", function(){
		return function (text) {
			if(text != null){
				return text.substring(0,1).toUpperCase()+text.substring(1);
			}
		}
	})

	.filter('translateApplicant', function () {
		return function (applicant) {
			if(applicant != null) {
				if (applicant === 'citizen') {
					return 'Natural';
				}
				if (applicant === 'institution') {
					return 'Jurídico';
				}
			}
		}
	})

	.filter('indentification', function () {
		return function (applicant) {
			if(applicant != null) {
				if (applicant === 'citizen') {
					return 'Cédula';
				}
				if (applicant === 'institution') {
					return 'RIF';
				}
			}
		}
	})


})();
(function () {
	'use stric';
	
	var resourceUrl = '/api/';
	// var resourceUrl = 'http://localhost/satci/public/api/';
	// var resourceUrl = 'http://192.168.1.26/satci/public/api/';
	// var resourceUrl = 'http://192.168.0.103/satci/public/api/';
	
	angular.module('SATCI.resources', ['ngResource'])


	.factory('Solicitudes', function($resource){
		return $resource( resourceUrl +'solicitude/:id', {id: '@_id'}, {
			update: {
				method: 'PUT', 
				params: {
					id: '@_id'
				}
			}
		});
	})
	.factory('SolicitudesList', function($http){
		return function(applicant){
				return $http.get( resourceUrl +'solicitude/list/' + applicant);
			}
		})	

	.factory('Citizens', function($resource){
		return $resource( resourceUrl + 'citizen/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Institutions', function($resource){
		return $resource( resourceUrl + 'institution/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

	.factory('Parishes', function($resource){
		return $resource( resourceUrl + 'parish/:id', {id: '@_id'}, {
			update: {method: 'PUT', params: {id: '@_id'}}
		});
	})

})();
(function () {
	'use stric';
	
	angular.module('SATCI.services', [])

	.factory('servingData', function () {
		return {
			data: {}
		};
	})

	.factory('redirectWhenLoggedOut', function($q, $injector, $rootScope) {
		return {
			responseError: function(rejection) {
	      // Need to use $injector.get to bring in $state or else we get
	      // a circular dependency error
	      var $state = $injector.get('$state');
	      // Instead of checking for a status code of 400 which might be used
	      // for other reasons in Laravel, we check for the specific rejection
	      // reasons to tell us if we need to redirect to the login state
	      var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid', 'user_not_found'];
	      // Loop through each rejection reason and redirect to the login
	      // state if one is encountered
	      angular.forEach(rejectionReasons, function(value, key) {
	      	if(rejection.data.error === value) {
	          // If we get a rejection corresponding to one of the reasons
	          // in our array, we know we need to authenticate the user so 
	          // we can remove the current user from local storage
	          sessionStorage.removeItem('user');
	          $rootScope.authenticated = false;
						$rootScope.currentUser = null;
	          // Send the user to the auth state so they can login
	          $state.go('login');
	        }
	      });
	      return $q.reject(rejection);
	    }
	  }
	})

.factory('paginateService', ['$q', '$filter', '$timeout', function ($q, $filter, $timeout) {

	function getPage(data, start, number, params) {

		var deferred = $q.defer();

		var filtered = params.search.predicateObject ? $filter('filter')(data, params.search.predicateObject) : data;

		if (params.sort.predicate) {
			filtered = $filter('orderBy')(filtered, params.sort.predicate, params.sort.reverse);
		}

		var result = filtered.slice(start, start + number);
		$timeout(function () {
			deferred.resolve({
				data: result,
				// numberOfPages: (number )
				numberOfPages: Math.ceil(data.length / number)
			});
		}, 600);

		return deferred.promise;
	}

	return {
		getPage: getPage
	};

}])

})();