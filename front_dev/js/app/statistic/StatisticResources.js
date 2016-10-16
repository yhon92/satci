/**
* Theme.Resources Module
*
* Description
*/
angular.module('Statistic.resources', ['ngResource', 'SATCI.Shared'])
.factory('Statistics', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}statistic/:id`, {id: '@_id'}, {
    allByStatus: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/allByStatus`,
      // isArray: true,
    },
    allByApplicant: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/allByApplicant`,
      // isArray: true,
    },
    allSolicitudeByTheme: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/allSolicitudeByTheme`,
      // isArray: true,
    },

  });
})
