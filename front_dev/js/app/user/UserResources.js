/**
* User.Resources Module
*
* Description
*/
angular.module('User.resources', ['ngResource', 'SATCI.Shared'])
.factory('Users', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}user/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
    list: {
      method: 'GET', 
      url: `${ResourcesUrl.api}user/list`,
    },
  });
})
