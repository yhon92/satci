/**
* Director.Resources Module
*
* Description
*/
angular.module('Director.resources', ['ngResource', 'SATCI.Shared'])
.factory('Directors', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}director/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      }
    }
  });
})