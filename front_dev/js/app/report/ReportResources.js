/**
* Theme.Resources Module
*
* Description
*/
angular.module('Report.resources', ['ngResource', 'SATCI.Shared'])
.factory('Reports', ($resource, ResourcesUrl) => {
  return $resource( `${ResourcesUrl.api}report/:id`, {id: '@_id'}, {
    allByStatus: {
      method: 'POST', 
      url: `${ResourcesUrl.api}report/allByStatus`,
      // isArray: true,
    },
    allByApplicant: {
      method: 'POST', 
      url: `${ResourcesUrl.api}report/allByApplicant`,
      // isArray: true,
    },
  });
})
