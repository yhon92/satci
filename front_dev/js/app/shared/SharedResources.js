/**
* Shared.resources Module
*
* Description
*/
angular.module('Shared.resources', ['ngResource'])
.factory('Parishes', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}parish/:id`, {id: '@_id'}, {
    update: {method: 'PUT', params: {id: '@_id'}}
  });
})