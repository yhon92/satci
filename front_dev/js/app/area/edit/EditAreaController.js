angular.module('Area.controllers')
.controller('EditAreaCtrl', ($scope, $filter, $uibModalInstance, Alertify, Helpers, directors, means, area, Areas) => {
  $scope.title = 'Editar';

  $scope.button = {
    submit: 'Guardar',
    cancel: 'Cancelar'
  };
  
  $scope.directors = directors;

  $scope.means = means;
  
  $scope.area = {
    // "id": area.id,
    "name": area.name,
    "email": area.email,
    "director": area.director.id,
    "means": getID(area.means),
  };
  
  $scope.save = () => {
    $scope.area.name = $filter('titleCase')($scope.area.name);

    let data = {
      name: $scope.area.name,
      email: $scope.area.email,
      director_id: $scope.area.director,
      means: $scope.area.means,
    };

    Areas.update({id: area.id}, data).$promise
    .then((data) => {
      if (data.success) {
        Alertify.success('¡Área editada!');
        area = buildAreaRow();
        $uibModalInstance.close(area)
      }
      if (data.error) {
        Alertify.error('¡No se pudo editar el área!');
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
      }
    });
  };

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };

  function buildAreaRow() {
    let indexDirector = Helpers.getIndex(directors, $scope.area.director);
    let groupMeans = [];

    if (!$scope.area.email.length) {
      $scope.area.email = area.email;
    }

    for (let i = 0; i < $scope.area.means.length; i++) {
      for (let z = 0; z < means.length; z++) {
        if ($scope.area.means[i] === means[z].id) {
          groupMeans.push(means[z]);
        }
      }
    }

    return {
      id: area.id,
      name: $scope.area.name,
      email: $scope.area.email,
      director: directors[indexDirector],
      means: groupMeans,
    };
  }

  function getID(arr) {
    let rv = [];
    for (let i = 0; i < arr.length; ++i) {
      if (arr[i] !== undefined) {
        rv.push(arr[i].id);
      }
    }
    return rv;
  }
  // 
  // function toObject(arr) {
  //   let rv = {};
  //   for (let i = 0; i < arr.length; ++i) {
  //     if (arr[i] !== undefined) {
  //       rv[arr[i].id] = arr[i];
  //     }
  //   }
  //   return rv;
  // }
})
