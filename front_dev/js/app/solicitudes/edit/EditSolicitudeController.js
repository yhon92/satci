angular.module('Solicitude.controllers')
.controller('EditSolicitudeCtrl',(
  $state,
  $scope,
  $stateParams,
  $filter,
  $uibModal,
  Alertify,
  Solicitudes) => {

  Solicitudes.get({id: $stateParams.id}).$promise
    .then( (data) => {
      let solicitude = data.solicitude;

      if (solicitude.status != 'Recibido') {
        Alertify.alert('No es permitido editar la solicitud <strong class="text-danger">No. '
          + solicitude.solicitude_number +'</strong>'+
          ' por estar en estado <strong class="text-danger">'+ solicitude.status +'</strong>');
        $state.transitionTo('solicitude', {
          reload: true, notify: false 
        });
      }else{
        $scope.solicitude = solicitude;
      }

    }, (fails) => {

    });

  $scope.showApplicant = (type, applicant) => {
    let modalInstance = $uibModal.open({
      templateUrl: `modalShow${type}-template`,
      controller: ($scope, $uibModalInstance, applicant) => {
        $scope.applicant = applicant;

        $scope.close = () => {
          $uibModalInstance.close();
        };
      },
      size: 'sm',
      resolve: {
        applicant: () => {
          return applicant;
        }
      }
    });
  }

  $scope.saveSolicitude = () => {
    let solicitude = {
      document_date: $filter('date')($scope.solicitude.document_date, 'yyyy-MM-dd'), 
      topic: $scope.solicitude.topic, 
      status: $scope.solicitude.status
    }
    console.log(solicitude)
    Solicitudes.update({id: $stateParams.id}, solicitude).$promise
      .then( (data) => {
        if (data.success) {
          Alertify.success('Solicitud modificada exitosamente');
          $state.transitionTo('solicitude', { 
            reload: true, inherit: false, notify: false 
          });
        }
      }, (fails) => {
        if (fails.status != 500){
          for (let firstKey in fails.data) {
            for (let secondKey in fails.data[firstKey]) {
              Alertify.error(fails.data[firstKey][secondKey])
            }
          }
        }else {
          console.log(fails);
        };
      });

  };

  $scope.cancel = () => {
    $state.transitionTo('solicitude', {
        reload: true, notify: false 
      });
  };

  /******************************************************Datepicker******************************************************/
  $scope.datepicker = {
    document_date: null,
    // document_date: $scope.solicitude.document_date,
  };

  $scope.clear = () => {
    $scope.datepicker = {
      document_date: null,
    }
  };

  $scope.today = () => {
    $scope.solicitude.document_date = new Date();
  };
  // $scope.today();

  // Disable weekend selection
  $scope.disabled = (date, mode) => {
    return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
  };

  $scope.toggleMin = () => {
    // $scope.minDate = $scope.minDate ? null : new Date();
    let date = new Date();
    $scope.minDate = date.getFullYear() + '-01-02'
  };
  $scope.toggleMin();

  $scope.toggleMax = () => {
    $scope.maxDate = $scope.maxDate ? null : new Date();
  };
  $scope.toggleMax();

  $scope.open = ($event, value) => {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.datepicker[value] = !$scope.datepicker[value];
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
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