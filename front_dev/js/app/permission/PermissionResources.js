/**
* Permission.Resources Module
*
* Description
*/
angular.module('Permission.resources', ['ngResource', 'SATCI.Shared'])
.factory('Permissions', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}permission/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
  });
})
