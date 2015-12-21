/**
* Shared.directives Module
*
* Description
*/
angular.module('Shared.directives', [])
.directive('applicantList', (PathTemplates) => {
  return {
    restrict: 'E',
    scope: {
      applicant: '=type',
      edit: '@',
      show: '&',
      remove: '&',
    },
    templateUrl: `${PathTemplates.partials}shared/applicant-list.html`
  };
})
.directive('filteredInput', ($filter) => {
  let dirLink = (s,e,a,c) => {
    s.$watch(a.ngModel, (v) => {
    // console.log(v);
      // console.log(s[a.ngModel].length);
      // if (pattern.indexOf('numbers') != -1){
      if (s[a.ngModel] != undefined)
      {
       s[a.ngModel] = s[a.ngModel].replace(/[^\d]/g, "");
      }
    });
  }
  return{
    require: 'ngModel',
    scope: true,
    link: dirLink
  }
})