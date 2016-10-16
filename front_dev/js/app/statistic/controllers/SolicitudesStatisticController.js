angular.module('Statistic.controllers')
.controller('SolicitudesStatisticCtrl', ($scope, $filter, $uibModal, Alertify, Helpers, Statistics) => {

  $scope.solicitudes = {
    date_from: null,
    date_to: null,
  };

  $scope.dataTotal = [];
  $scope.notData = true;

  let colors = Helpers.paletteColors;
                
  $scope.optionsTotal = {
    chart: {
      type: 'pieChart',
      height: 500,
      x: function(d){return d.status;},
      y: function(d){return d.quantity;},
      showLabels: true,
      duration: 500,
      color: function(d,i){
        return (d.data && d.data.color) || colors[i % colors.length]
      },
      labelThreshold: 0.01,
      labelSunbeamLayout: true,
      labelType: 'percent',
      valueFormat: function(d) {
        return d3.format('.,2f')(d);
      },
      legend: {
        /*margin: {
          top: 1,
          right: 200,
          bottom: 0,
          left: 0
        },*/
        align: false,
        rightAlign: false,
      },

      noData: '',
    }
  };

  $scope.searchSolicitudes = () => {

    let data = {
      date_from: $filter('date')($scope.solicitudes.date_from, 'yyyy-MM-dd'),
      date_to: $filter('date')($scope.solicitudes.date_to, 'yyyy-MM-dd'),
      parish: $scope.parish,
    };

    if (data.parish === undefined || data.parish === '') {
      data.parish = 'all';
    }

    Statistics.allByStatus(data).$promise
    .then((response) => {
      if (response.succes) {
        $scope.notData = false;
        let [totalQuantity, totalPercent] = calculatingPercentage(response.data);
        $scope.totalQuantity = totalQuantity;
        $scope.totalPercent = totalPercent;
        $scope.dataTotal = response.data;
      }
      if (response.error) {
        $scope.notData = true;
        $scope.totalQuantity = null;
        $scope.totalPercent = null;
        $scope.dataTotal = [];
        Alertify.log('¡No hay datos disponibles!');
      }
    })
    .catch((fails) => {
      console.log(fails);
    });

  };

  function calculatingPercentage(data) {
    let totalQuantity = 0;
    let totalPercent = 0;
    
    for (let i in data) {
      totalQuantity += data[i].quantity;
    }

    for (let i in data) {
      let percent = 0;
      
      percent = Math.round((data[i].quantity / totalQuantity) * 100);
      data[i].percent = percent;
      totalPercent += percent;
    }
     
    return [totalQuantity, totalPercent];
  }


  /******************************************************Datepicker******************************************************/
  $scope.datepicker = {
    date_from: null,
    date_to: null,
  };

  $scope.clear = () => {
    $scope.datepicker = {
      date_from: null,
      date_to: null,
    };
  };

  $scope.dateOptions = {
    maxDate: '',
    minDate: '',
    formatYear: 'yy',
    startingDay: 1
  };


  $scope.today = () => {
    $scope.datepicker.date_from = new Date();
    $scope.datepicker.date_to = new Date();
  };
  // $scope.today();

  // Disable weekend selection
  $scope.disabled = (date, mode) => {
    return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
  };

  $scope.toggleMin = () => {
    // $scope.dateOptions.minDate = $scope.dateOptions.minDate ? null : new Date();
    let date = new Date();
    $scope.dateOptions.minDate = new Date(date.getFullYear() + '-01-02');
  };
  $scope.toggleMin();

  $scope.toggleMax = () => {
    $scope.dateOptions.maxDate = $scope.dateOptions.maxDate ? null : new Date();
  };
  $scope.toggleMax();

  $scope.open = ($event, value) => {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.datepicker[value] = !$scope.datepicker[value];
  };


  $scope.formats = ['dd-MMMM-yyyy', 'dd/MM/yyyy', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];

  let tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  let afterTomorrow = new Date();
  afterTomorrow.setDate(tomorrow.getDate() + 2);
  $scope.events =
  [{
    date: tomorrow,
    status: 'full'
  },
  {
    date: afterTomorrow,
    status: 'partially'
  }];

  $scope.getDayClass = (date, mode) => {
    if (mode === 'day') {
      let dayToCheck = new Date(date).setHours(0,0,0,0);

      for (let i=0;i<$scope.events.length;i++){
        let currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

        if (dayToCheck === currentDay) {
          return $scope.events[i].status;
        }
      }
    }

    return '';
  };
})