/**
* Theme.Resources Module
*
* Description
*/
angular.module('Statistic.resources', ['ngResource', 'SATCI.Shared'])
.factory('Statistics', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}statistics/:id`, {id: '@_id'}, {
    allByStatus: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistics/allByStatus`,
      // isArray: true,
    },
    allByApplicant: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistics/allByApplicant`,
      // isArray: true,
    },
  });
})
