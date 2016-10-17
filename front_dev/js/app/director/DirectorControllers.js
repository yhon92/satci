angular.module('Director.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Director.resources'])
.controller('DirectorCtrl', ($scope, $sce, $uibModal, Helpers, Alertify, Directors, Reports) => {

  Directors.get().$promise
  .then((data) => {
    $scope.directors = data.directors;
  })
  .catch((fails) => {

  });

  $scope.print = () => {
    let directors = Reports.getListDirectors();
    directors.then((response) => {

      let modalInstance = $uibModal.open({
        templateUrl: 'modalViewPdf-template',
        controller: ($scope, $uibModalInstance, pdf) => {

          let file = new Blob([pdf], {type: 'application/pdf'});
          let fileURL = URL.createObjectURL(file);

          $scope.pdf = {
            title: 'Lista de Directores y Jefes',
            content: $sce.trustAsResourceUrl(fileURL),
          };
          
          $scope.close = () => {
            $uibModalInstance.dismiss();
          };

        },
        size: 'lg',
        resolve: {
          pdf: () => {
            return response.data;
          }
        }
      });

    });
  };
  
  $scope.filter = {
    name: '',
  };
  
  $scope.isCollapsed = true;
  
  $scope.toggleCollapsed = () => {
    $scope.filter.name = '';
    $scope.isCollapsed = !$scope.isCollapsed;
  };

  $scope.add = () => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormDirector-template',
      controller: 'CreateDirectorCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false
    });

    modalInstance.result.then((data) => {
      $scope.directors.push(data);
    });
  };

  $scope.show = (director) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalShowDirector-template',
      controller: 'ShowDirectorCtrl',
      size: 'dm',
      resolve: {
        director: () => {
          return director;
        }
      }
    });
  };

  $scope.edit = (director) => {

    let index = Helpers.getIndex($scope.directors, director.id);
    
    let modalInstance = $uibModal.open({
      templateUrl: 'modalFormDirector-template',
      controller: 'EditDirectorCtrl',
      size: 'sm',
      backdrop: 'static',
      keyboard: false,
      resolve: {
        director: () => {
          return director;
        }
      }
    });

    modalInstance.result.then((data) => {
      $scope.directors[index].identification = data.identification;
      $scope.directors[index].full_name = data.full_name;
      $scope.directors[index].first_name = data.first_name;
      $scope.directors[index].last_name = data.last_name;
      $scope.directors[index].email = data.email;
      $scope.directors[index].prefix_phone = data.prefix_phone;
      $scope.directors[index].number_phone = data.number_phone;
      $scope.directors[index].resolution = data.resolution;
    });
  };

  $scope.delete = (director) => {

    let id = director.id;
    
    let index = Helpers.getIndex($scope.directors, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar al director: '+
      '</br>Nombre: <strong class="text-danger">'+ director.full_name +'</strong>'
      )
    .then((ok) => {
      Directors.delete({id: id}).$promise
      .then( (data) => {
        if (data.success) {
          $scope.directors.splice(index,1);
          Alertify.success('¡Director eliminado!');
        }
        if (data.conflict) {
          Alertify.log('¡No es posible eliminar por tener <strong class="text-warning">Áreas</strong> asociadas!');
        }
        if (data.error) {
          Alertify.error('¡Ocurrio un error al intentar eliminar!');
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
    }, (cancel) => {
      return false;
    }); 
  };

})
