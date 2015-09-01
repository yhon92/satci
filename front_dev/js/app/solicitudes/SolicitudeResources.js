angular.module('Solicitude.resources', ['ngResource', 'SATCI.Shared'])
.factory('Solicitudes', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}solicitude/:id`, {id: '@_id'}, {
    update: { method: 'PUT', params: { id: '@_id' } }
  });
})
.factory('SolicitudesList', ($http, ResourcesUrl) => {
  return (applicant) => {
    return $http.get( `${ResourcesUrl.api}solicitude/list/${applicant}` );
  }
})  