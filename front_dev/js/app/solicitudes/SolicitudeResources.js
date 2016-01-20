angular.module('Solicitude.resources', ['ngResource', 'SATCI.Shared'])
.factory('Solicitudes', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}solicitude/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
    list: {
      method: 'GET', 
      params: {
        applicant: '@_applicant',
      },
      url: `${ResourcesUrl.api}solicitude/list/:applicant`
    },
  });
})
.factory('SolicitudesAssign', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}solicitude/assign/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
    list: {
      method: 'GET', 
      params: {
        solicitude: '@_solicitude',
      }, 
      url: `${ResourcesUrl.api}solicitude/assign/list/:solicitude`,
    },
    updateObservation: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
      url: `${ResourcesUrl.api}solicitude/assign/observation/:id`,
    },
  });
})