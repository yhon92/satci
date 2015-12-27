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
      controller: ($scope, $filter, $uibModalInstance) => {
        $scope.title = 'Agregar';

        $scope.category = null;

        $scope.save = () => {
          let data = {
            name: $filter('titleCase')($scope.category)
          }

          Categories.save(data).$promise
          .then((data) => {
            if (data.success) {
              Alertify.success('¡Categoría registrada!')
              $uibModalInstance.close(data.category)
            }
            if (data.error) {
              Alertify.error('¡No se pudo registrar la categoría!');
            }
          },
          (fails) => {
            if (fails.status != 500) {
              for (let firstKey in fails.data) {
                for (let secondKey in fails.data[firstKey]) {
                  Alertify.error(fails.data[firstKey][secondKey])
                }
              }
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
    });
  };

  $scope.show = (category) => {
    console.log(category)
  },

  $scope.edit = (category) => {
    let modalInstance = $uibModal.open({
      templateUrl: 'modalCategory-template',
      controller: ($scope, $filter, $uibModalInstance, category) => {
        $scope.title = 'Editar';

        $scope.category = category.name;

        $scope.save = () => {
          $scope.category = $filter('titleCase')($scope.category);

          let data = {
            name: $scope.category
          }

          Categories.update({id: category.id}, data).$promise
          .then((data) => {
            if (data.success) {
              Alertify.success('¡Categoría editada!')
              category.name = $scope.category;
              $uibModalInstance.close(category)
            }
            if (data.error) {
              Alertify.error('¡No se pudo editar la categoría!');
            }
          },
          (fails) => {
            if (fails.status != 500) {
              for (let firstKey in fails.data) {
                for (let secondKey in fails.data[firstKey]) {
                  Alertify.error(fails.data[firstKey][secondKey])
                }
              }
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
      resolve: {
        category: () => {
          return category;
        }
      }

    });
  };

  $scope.delete = (category) => {

    let id = category.id;
    
    let index = getIndex($scope.categories, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar la categoría: '+
      '</br>Nombre: <strong class="text-danger">'+ category.name +'</strong>'
    )
    .then((ok) => {
      Categories.delete({id: id}).$promise
        .then( (data) => {
          if (data.success) {
            $scope.categories.splice(index,1);
            Alertify.success('¡Categoría eliminada!');
          }
          if (data.conflict) {
            Alertify.log('¡No es posible eliminar por tener <strong class="text-warning">Temas</strong> asociados!');
          }
          if (data.error) {
            Alertify.error('¡Ocurrio un error al intentar eliminar!');
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
    }, (cancel) => {
      return false;
    }); 
  };

  function getIndex(Things, id){
    for (let i = 0; i < Things.length; i++) {
      if (Things[i].id == id) {
        return i;
      }
    }
  };
})
