/**
* Area.Resources Module
*
* Description
*/
angular.module('Area.resources', ['ngResource', 'SATCI.Shared'])
.factory('Areas', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}area/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
  });
})
