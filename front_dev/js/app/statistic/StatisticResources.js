/**
* Theme.Resources Module
*
* Description
*/
angular.module('Statistic.resources', ['ngResource', 'SATCI.Shared'])
.factory('Statistics', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}statistic/:id`, {id: '@_id'}, {
    solicitudeByStatus: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/solicitudeByStatus`,
      // isArray: true,
    },
    solicitudeByApplicant: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/solicitudeByApplicant`,
      // isArray: true,
    },
    solicitudeByTheme: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/solicitudeByTheme`,
      // isArray: true,
    },
    assignedByStatus: {
      method: 'POST', 
      url: `${ResourcesUrl.api}statistic/assignedByStatus`,
      // isArray: true,
    },
  });
})
