angular.module('Solicitude.controllers')
.controller('CreateSolicitudeCtrl', (
  $state,
  $scope, 
  $filter, 
  $controller, 
  $q, 
  AclService,
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

  let _add = null;
  let _search = null;

  $scope.can = AclService.can;

  $scope.solicitude = {
    full_name: '',
    applicant_type: '',
    applicant_id: '',
    identification: '',
    reception_date: '',
    document_date: '',
    topic: '',
  };

  $scope.addApplicant = () =>{
    _add = true;
    _search = false;

    $scope.solicitude.full_name = null;
    $scope.solicitude.applicant_id = null;
    $scope.solicitude.identification = null;

    $scope.applicantTemplate = `${PathTemplates.partials}${$scope.solicitude.applicant_type}/create.html`;
  };

  $scope.clear = () =>{
    
    $scope.solicitude = {
      full_name: null,
      applicant_type: null,
      applicant_id: null,
      identification: null,
      reception_date: null,
      document_date: null,
      topic: null,
    }

    $scope.template = null;
    $scope.applicantTemplate = null;
  }

  $scope.close = () => {
    _add = null;
    _search = null;
    $scope.template = '';
    $scope.applicant = false;
    $scope.applicantTemplate = '';
  };

  $scope.getApplicant = (type) => {
    $scope.solicitude.applicant_type = type;
    $scope.template = `${PathTemplates.partials}solicitude/applicant.html`;
  };

  if ($state.is('solicitudeCreate')) {
    Parishes.get().$promise
    .then((data) => {
      $scope.parishes = data.parishes;
    });
  }

  $scope.searchApplicant = () => {
    $scope.applicantTemplate = null;

    _search = true;
    _add = false;
    let dataUploaded = $q.defer();

    if ($scope.solicitude.applicant_type === 'citizen') {
      Citizens.get().$promise
      .then((data) => {
        $scope.applicants = data.citizens;
        dataUploaded.resolve();
      });
    }
    if ($scope.solicitude.applicant_type === 'institution') {
      Institutions.get().$promise
      .then((data) => {
        $scope.applicants = data.institutions;
        dataUploaded.resolve();
      });
    }

    dataUploaded.promise.then(() => {
      $scope.applicantTemplate = `${PathTemplates.partials}solicitude/search-applicant.html`;
    })
  };

  $scope.saveSolicitude = () => {
    if (!$scope.solicitude.reception_date) {
      $scope.solicitude.reception_date = new Date();
    }

    let solicitude = {
      reception_date: $filter('date')($scope.solicitude.reception_date, 'yyyy-MM-dd'), 
      applicant_type: $scope.solicitude.applicant_type, 
      applicant_id: $scope.solicitude.applicant_id, 
      document_date: $filter('date')($scope.solicitude.document_date, 'yyyy-MM-dd'), 
      topic: $scope.solicitude.topic, 
    };

    Solicitudes.save(solicitude).$promise
    .then( (data) => {
      if (data.success) {
        Alertify.success('Solicitud registrada exitosamente');
        $state.transitionTo('solicitude', { 
          reload: true, inherit: false, notify: false 
        });
      }
    })
    .catch((fails) => {
      if (fails.status != 500) {
        for (let firstKey in fails.data) {
          for (let secondKey in fails.data[firstKey]) {
            Alertify.error(fails.data[firstKey][secondKey]);
          }
        }
      } else {
        console.log(fails);
      };
    });
  }

  $scope.selectApplicant = (id, identification, full_name) => {
    $scope.solicitude.full_name = full_name;
    $scope.solicitude.applicant_id = id;
    $scope.solicitude.identification = identification;
  };

  $scope.$watch('solicitude.applicant_type', () => {
    if (_add) {
      $scope.addApplicant();
    }
    if (_search) {
      $scope.searchApplicant();
    }
  });

  $scope.displayed = [];

  $scope.callServer = function callServer (tableState) {

    $scope.isLoading = true;
    let pagination = tableState.pagination;
      // $scope.DisplayedPages = 1;

      let start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
      let number = pagination.number || 10;  // Number of entries showed per page.

      paginateService.getPage($scope.applicants, start, number, tableState).then((result) => {
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
