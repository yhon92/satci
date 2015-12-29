/**
* Category.Resources Module
*
* Description
*/
angular.module('Category.resources', ['ngResource', 'SATCI.Shared'])
.factory('Categories', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}category/:id`, {id: '@_id'}, {
    update: {
      method: 'PUT', 
      params: {
        id: '@_id',
      },
    },
    list: {
      method: 'GET', 
      url: `${ResourcesUrl.api}category/list`,
    },
  });
})