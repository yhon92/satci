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

		['$rootScope', '$scope', 'Citizens', 'Institutions', 'paginateService', 
		
		function ($rootScope, $scope, Citizens, Institutions, paginateService) {

		var add = null;
		var search = null;
		var applicantType = '';

		$rootScope.full_name = null;
		$rootScope.applicantId = null;
		$rootScope.identification = null;

		$scope.getApplicant = function (type){
			$scope.applicantType = applicantType = type;
			$scope.template = 'templates/partials/solicitude/applicant.html';
		};

		$scope.addApplicant = function (){
			$rootScope.identification = null;
			$rootScope.full_name = null;
			$rootScope.applicantId = null;

			$scope.applicantTemplate = 'templates/partials/applicant/'+ applicantType +'-form.html';
			add = true;
		};

		$scope.close = function (){
			$scope.template = '';
			add = false;
			$scope.applicantTemplate = '';
		};
		$scope.clear = function (){
			$rootScope.identification = null;
			$rootScope.full_name = null;
			$rootScope.applicantId = null;
			$scope.template = null;
			$scope.applicantType = null;
			$scope.applicantTemplate = null;
		}

		$scope.searchApplicant = function (){
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

		$scope.$watch(function () {
			if (add) {
				$scope.addApplicant();
			}
		});

		$scope.displayed = [];

		$scope.callServer = function callServer (tableState) {

			$scope.isLoading = true;
			var pagination = tableState.pagination;

			var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
			var number = pagination.number || 10;  // Number of entries showed per page.

			paginateService.getPage($scope.applicants, start, number, tableState).then(function (result) {
				
				$scope.displayed = result.data;
				tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
				$scope.isLoading = false;

			});
		};

		$scope.selectApplicant = function (id, identification, full_name) {
			// console.log(id + ' - ' + identification + ' - ' + full_name);
			$rootScope.applicantId = id;
			$rootScope.identification = identification;
			$rootScope.full_name = full_name;
		}
	}])

	.controller('CreateApplicantCtrl', ['$rootScope', '$scope', 'Citizens', 'Institutions', 
		
		function ($rootScope, $scope, Citizens, Institutions) {

		$scope.submit = function (){
			$rootScope.full_name = $scope.applicant.first_name;
			$rootScope.applicantId = $scope.applicant.identification;
			$rootScope.identification = $scope.applicant.identification;
			console.log($scope.applicant.first_name);
		}

	}])

})();