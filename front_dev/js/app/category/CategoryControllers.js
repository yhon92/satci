angular.module('Category.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Category.resources'])
.controller('CategoryCtrl', ($scope, $uibModal, Alertify, Categories) => {
  
  Categories.get().$promise
  .then((data) => {
    $scope.categories = data.categories;
  },
  (error) => {

  })

  $scope.add = () => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalCategory-template',
      controller: ($scope, $timeout, $uibModalInstance) => {
        $scope.title = 'Agregar';

        $scope.category = null;

        $scope.save = () => {
          let data = {
            name: $scope.category
          }

          Categories.save(data).$promise
          .then((data) => {
            if (data.success) {
              Alertify.success('¡Categoría registrada exitosamente!')
              $uibModalInstance.close(data.category)
            }
            if (data.error) {
              Alertify.error('¡No se pudo registrar la categoría!');
            }
          },
          (fails) => {
            if (fails.status != 500) {
              angular.forEach(fails.data, (values, key) => {
                angular.forEach(values, (value) => {
                  Alertify.error(value)
                })
              })
            } else {
              console.log(fails);
            };
          })
        };

        $scope.cancel = () => {
          $uibModalInstance.dismiss();
        };
      },
      size: 'sm',

    });

    modalInstance.result.then((data) => {
      $scope.categories.push(data);
      console.log(data)
    });


  };

  $scope.show = (category) => {
    console.log(category)
  },

  $scope.edit = (category) => {
    console.log($scope)
  };

  $scope.delete = (category) => {
    console.log(category)
  };
})
