(function () {
	'use stric';
	
	angular.module('SATCI.controllers',[])
	.controller('NavCtrl', ['$scope', '$location', function ($scope, $location) {
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
			date = new Date();
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

	.controller('SolicitudeCtrl', ['$scope', 'Solicitudes', function ($scope, Solicitudes) {
			/*Solicitudes.get(function (data){
				$scope.solicitudes = data.solicitudes;
			});*/
	}])

	.controller('CreateSolicitudeCtrl', 
		['$scope', '$controller', 'Citizens', 'Institutions', 'Parishes', 'paginateService', 
		function ($scope, $controller, Citizens, Institutions, Parishes, paginateService) {

		$controller('CreateCitizenCtrl', {$scope : $scope});
		$controller('CreateInstitutionCtrl', {$scope : $scope});
		
		var add = null;
		var search = null;
		// var applicantType = '';

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


			// console.log($scope.citizen)
			Citizens.save($scope.citizen).$promise.then(
				function (data) {
					console.log(data)
					if (data.success) {
						$scope.full_name = $scope.citizen.first_name +' '+ $scope.citizen.last_name;
						$scope.identification = $scope.citizen.identification;
						$scope.applicantId = $scope.citizen.identification;
						$scope.solicitude.alerts = [{
							type: 'success',
							message: 'Persona registrada exitosamente',
						}];
						$scope.close();
					}
				},
				function (fails) {
/*					angular.forEach(fails.data, function (value, key) {
						console.log(value)
						$scope.applicant.alerts.push({type: 'danger', message: value})
					})*/
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

		$scope.saveInstitution = function (){
			$scope.full_name = $scope.institution.full_name;
			$scope.identification = $scope.institution.identification.toUpperCase();
			$scope.applicantId = $scope.institution.identification;
		}
	}])


})();