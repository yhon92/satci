/**
* Institution.resources Module
*
* Description
*/
angular.module('Institution.resources', ['ngResource', 'SATCI.Shared'])
.factory('Institutions', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}institution/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
  });
})