/**
* Means.Resources Module
*
* Description
*/
angular.module('Means.resources', ['ngResource', 'SATCI.Shared'])
.factory('Means', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}means/:id`, {id: '@_id'}, {
    update: {method: 'PUT', params: {id: '@_id'}}
  });
})