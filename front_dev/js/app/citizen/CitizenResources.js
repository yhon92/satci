/**
* Citizens.resources Module
*
* Description
*/
angular.module('Citizen.resources', ['ngResource', 'SATCI.Shared'])
.factory('Citizens', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}citizen/:id`, {id: '@_id'}, {
    update: {method: 'PUT', params: {id: '@_id'}}
  });
})