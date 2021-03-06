angular.module('SATCI.Datepicker',[])
.controller('DatepickerCtrl', ($scope) => {
	$scope.today = () => {
		$scope.dt = new Date();
	};
	// $scope.today();

	$scope.clear = () => {
		$scope.dt = null;
	};

	// Disable weekend selection
	$scope.disabled = (date, mode) => {
		return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
	};

	$scope.toggleMin = () => {
		// $scope.minDate = $scope.minDate ? null : new Date();
		var date = new Date();
		$scope.minDate = date.getFullYear() + '-01-02'
	};
	$scope.toggleMin();
	
	$scope.toggleMax = () => {
		$scope.maxDate = $scope.maxDate ? null : new Date();
	};
	$scope.toggleMax();

	$scope.open = ($event) => {
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

	$scope.getDayClass = (date, mode) => {
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