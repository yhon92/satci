/**
* Institution.controller Module
*
* Description
*/
angular.module('Institution.controllers', ['ui.router', 'Alertify', 'SATCI.Shared', 'Institution.resources'])
.controller('InstitutionCtrl', ($scope, Alertify, Institutions) => {

  Institutions.get().$promise
  .then((data) => {
    $scope.institutions = data.institutions;
    $scope.institutions.type = 'Jurídicos';
  },
  (errors) => {
    
  });

  $scope.deleteInstitution = (id) => {

    let index = getIndex($scope.institutions, id);

    Alertify.set({ labels: {ok: "Eliminar", cancel: "Cancelar"} });

    Alertify.confirm('Confirma que desea eliminar a: '+
      '</br>Cédula: <strong class="text-danger">'+ $scope.institutions[index].identification +'</strong>'+
      '</br>Nombre: <strong class="text-danger">'+ $scope.institutions[index].full_name +'</strong>'
    )
    .then((ok) => {
      Institutions.delete({id: id}).$promise
        .then( (data) => {
          if (data.success) {
            $scope.institutions.splice(index,1);
            Alertify.success('¡Institución eliminada!');
          }
          if (data.conflict) {
            Alertify.log('¡No es posible eliminar por tener solicitudes asociadas!');
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