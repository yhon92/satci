angular.module('Solicitude.Create', ['ui.router', 'Alertify', 'SATCI.Shared', 'Solicitude.resources'])
.controller('CreateSolicitudeCtrl', (
  $state,
  $scope, 
  $filter, 
  $controller, 
  $q, 
  $timeout, 
  Alertify,
  Citizens, 
  Institutions, 
  Parishes, 
  Solicitudes, 
  paginateService, 
  PathTemplates) => {

  $controller('CreateCitizenCtrl', {$scope : $scope});
  $controller('CreateInstitutionCtrl', {$scope : $scope});
  // $controller('DatepickerCtrl', {$scope : $scope});

  let add = null;
  let search = null;
  let applicant_type = '';

  $scope.solicitude = {
    full_name: '',
    applicant_id: '',
    identification: '',
    reception_date: '',
    document_date: '',
    topic: '',
  }

  $scope.addApplicant = () =>{
    add = true;
    search = false;

    $scope.full_name = null;
    $scope.applicant_id = null;
    $scope.identification = null;

    $scope.applicantTemplate = `${PathTemplates.partials}${applicant_type}/create.html`;
  };

  $scope.clear = () =>{
    $scope.identification = null;
    $scope.full_name = null;
    $scope.applicant_id = null;
    $scope.template = null;
    $scope.applicant_type = null;
    $scope.applicantTemplate = null;
  }

  $scope.close = () => {
    add = null;
    search = null
    $scope.template = '';
    $scope.applicant = false;
    $scope.applicantTemplate = '';
  };

  $scope.getApplicant = (type) => {
    $scope.solicitude.applicant_type = applicant_type = type;
    $scope.template = `${PathTemplates.partials}solicitude/applicant.html`;
  };

  $scope.parishes = Parishes.get((data) => {
    return $scope.parishes = data.parishes;
  })

  $scope.searchApplicant = () => {
    search = true;
    add = false;
    let dataUploaded = $q.defer();

    if (applicant_type === 'citizen') {
      Citizens.get((data) => {
        $scope.applicants = data.citizens;
        dataUploaded.resolve();
      });
    }
    if (applicant_type === 'institution') {
      Institutions.get((data) => {
        $scope.applicants = data.institutions;
        dataUploaded.resolve();
      });
    }

    dataUploaded.promise.then(() => {
      $scope.applicantTemplate = `${PathTemplates.partials}solicitude/search-applicant.html`;
    })
  };

  $scope.saveSolicitude = () => {

    let solicitude = {
      reception_date: $filter('date')($scope.solicitude.reception_date, 'yyyy-MM-dd'), 
      applicant_type: $scope.solicitude.applicant_type, 
      applicant_id: $scope.solicitude.applicant_id, 
      document_date: $filter('date')($scope.solicitude.document_date, 'yyyy-MM-dd'), 
      topic: $scope.solicitude.topic, 
    }

    Solicitudes.save(solicitude).$promise.then(
      (data) => {
        if (data.success) {
          Alertify.success('Solicitud registrada exitosamente');
          $state.transitionTo('solicitude', { 
            reload: true, inherit: false, notify: false 
          });
        }
      }, 
      (fails) => {
        if (fails.status != 500) 
        {
          angular.forEach(fails.data, (values, key) => {
            angular.forEach(values, (value) => {
              Alertify.error(value)
            })
          })
        }
        else
        {
          console.log(fails);
        };
      })
  }

  $scope.selectApplicant = (id, identification, full_name) => {
    $scope.solicitude.full_name = full_name;
    $scope.solicitude.applicant_id = id;
    $scope.solicitude.identification = identification;
  };

  $scope.$watch('applicant_type', () => {
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
    let pagination = tableState.pagination;
      // $scope.DisplayedPages = 1;

      let start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
      let number = pagination.number || 10;  // Number of entries showed per page.

      paginateService.getPage($scope.applicants, start, number, tableState).then(function (result) {
        $scope.displayed = result.data;
        tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
        $scope.isLoading = false;
      })
    };

    /******************************************************Datepicker******************************************************/
    $scope.datepicker = {
      reception_date: null,
      document_date: null,
    };

    $scope.clear = () => {
      $scope.datepicker = {
        reception_date: null,
        document_date: null,
      }
    };

    $scope.today = () => {
      $scope.datepicker.reception_date = new Date();
      $scope.datepicker.document_date = new Date();
    };
    // $scope.today();

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
