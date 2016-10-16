angular.module('Statistic.controllers')
.controller('ThemesStatisticCtrl', ($scope, $filter, $uibModal, Alertify, Helpers, Statistics) => {

  $scope.date_from = null;
  $scope.date_to = null;

  $scope.dataChart = [{
    key: 'Datos Temas',
    values: [],
  }];

  $scope.notData = true;

  let colors = Helpers.paletteColors;
                
  $scope.optionsChart = {
    chart: {
      type: 'discreteBarChart',
      height: 450,
      margin : {
          top: 20,
          right: 20,
          bottom: 50,
          left: 55
      },
      x: function(d){return d.theme;},
      y: function(d){return d.quantity + (1e-10);},
      showValues: true,
      valueFormat: function(d){
          return d3.format(',.0f')(d);
      },
      duration: 500,
      xAxis: {
          // axisLabel: 'Temas',
          rotateLabels: -50,
          fontSize: 9,
      },
      yAxis: {
          axisLabel: '',
          axisLabelDistance: -10,
      },
      noData: '',
    }
  };

  $scope.searchSolicitudes = () => {

    let data = {
      date_from: $filter('date')($scope.date_from, 'yyyy-MM-dd'),
      date_to: $filter('date')($scope.date_to, 'yyyy-MM-dd'),
      parish: $scope.parish,
    };

    if (data.parish === undefined || data.parish === '') {
      data.parish = 'all';
    }

    Statistics.allSolicitudeByTheme(data).$promise
    .then((response) => {
      if (response.succes) {
        $scope.notData = false;
        let [totalQuantity, totalPercent] = calculatingPercentage(response.data);
        $scope.totalQuantity = totalQuantity;
        $scope.totalPercent = totalPercent;
        $scope.dataResumen = response.data;
        $scope.dataChart[0].values = response.data;

        let svgContainer = document.getElementById('themesChart');
        let svg = svgContainer.querySelector('svg');
        // svg.style.height = '800px';
        svg.style.height = '580px';
      }
      if (response.error) {
        $scope.notData = true;
        $scope.totalQuantity = null;
        $scope.totalPercent = null;
        $scope.dataChart[0].values = [];
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
      percent = (data[i].quantity / totalQuantity) * 100;
      
      percent = Number(Math.round(percent+'e2')+'e-2');

      data[i].percent = percent;
      totalPercent += percent;
    }
     
    return [totalQuantity, Math.round(totalPercent)];
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