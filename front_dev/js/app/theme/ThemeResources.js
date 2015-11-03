/**
* Theme.Resources Module
*
* Description
*/
angular.module('Theme.resources', ['ngResource', 'SATCI.Shared'])
.factory('Themes', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}theme/:id`, {id: '@_id'}, {
    update: {method: 'PUT', params: {id: '@_id'}}
  });
})
