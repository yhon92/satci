/**
* Solcitude.directives Module
*
* Description
*/
angular.module('Solicitude.directives', ['SATCI.Shared'])
.directive('solicitudeList', (PathTemplates) => {
  return {
    restrict: 'E',
    scope: {
      applicant: '=type',
      show: '&',
    },
    templateUrl: `${PathTemplates.partials}solicitude/solicitude-list-applicant.html`
  };
})