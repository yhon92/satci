/**
* Theme.Resources Module
*
* Description
*/
angular.module('Report.resources', ['ngResource', 'SATCI.Shared'])
.factory('Reports', ($http, ResourcesUrl) => {
  return {
    /*getByStatus: {
      method: 'POST', 
      url: `${ResourcesUrl.api}report/allByStatus`,
      // isArray: true,
    },*/
    getListApplicants: (data) => {
      return $http({
        method: 'POST', 
        url: `${ResourcesUrl.api}report/list/applicant`,
        data: data,
        responseType: 'arraybuffer',
      });
    },
    getListDirectors: () => {
      return $http({
        method: 'POST', 
        url: `${ResourcesUrl.api}report/list/directors`,
        responseType: 'arraybuffer',
      });
    }
  }
});
