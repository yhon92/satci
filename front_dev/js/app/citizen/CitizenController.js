/**
* Citizens.controller Module
*
* Description
*/
angular.module('Citizen.controller', ['Alertify', 'Citizen.resources'])
.controller('CitizenCtrl', ($scope, Alertify, Citizens) => {

  Citizens.get().$promise
  .then((data) => {
    $scope.citizens = data.citizens;
    $scope.citizens.type = 'Naturales';
  },
  (errors) => {
    
  });

  $scope.removeCitizen = (id) => {

    let index = getIndex($scope.citizens, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar a: '+
      '</br>Cédula: <strong class="text-danger">'+ $scope.citizens[index].identification +'</strong>'+
      '</br>Nombre: <strong class="text-danger">'+ $scope.citizens[index].full_name +'</strong>'
    )
    .then((ok) => {
      Citizens.delete({id: id}).$promise
        .then( (data) => {
          if (data.success) {
            $scope.citizens.splice(index,1);
            Alertify.success('¡Registro eliminado exitosamente!');
          }
          if (data.conflict) {
            Alertify.error('¡No es posible eliminar por tener solicitudes asociadas!');
          }
          if (data.error) {
            Alertify.error('¡Ocurrio un error al intentar eliminar!');
          }
        }, (fails) => {
          if (fails.status != 500){
            angular.forEach(fails.data, (values, key) => {
              angular.forEach(values, (value) => {
                Alertify.error(value)
              })
            })
          }else {
            console.log(fails);
          };
        });
    }, (cancel) => {
      return false;
    }); 
  };

  function getIndex(Things,id){
    for (let i = 0; i < Things.length; i++) {
      if (Things[i].id == id) {
        return i;
      }
    }
  };
});
