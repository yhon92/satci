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
      // show: '&',
      delete: '&',
    },
    templateUrl: `${PathTemplates.partials}shared/applicant-list.html`
  };
})
.directive('noneKey', function() {
  return function(scope, element, attrs) {
    element.bind("keypress", function(event) {
      scope.$apply(function(){
        scope.$eval(attrs.onlyNumbers);
        event.preventDefault();
      });
    });
  };
})
.directive('onlyNumbers', function() {
  return function(scope, element, attrs) {
    element.bind("keypress", function(event) {
      let key = event.keyCode || event.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      num = "0123456789";

      if( num.indexOf(tecla) == -1 ){
        scope.$apply(function(){
          scope.$eval(attrs.onlyNumbers);
          event.preventDefault();
        });
      }
    });
  };
})
.directive('onlyLetters', function() {
  return function(scope, element, attrs) {
    element.bind("keypress", function(event) {
      let key = event.keyCode || event.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      letras = " áéíóúüabcdefghijklmnñopqrstuvwxyz",
      especiales = [8,13,39,46],
      tecla_especial = false

      for(var i in especiales){
        if(key == especiales[i]){
          tecla_especial = true;
          break;
        }
      }

      if( letras.indexOf(tecla) == -1 && !tecla_especial){
        scope.$apply(function(){
          scope.$eval(attrs.onlyLetters);
          event.preventDefault();
        });
      }
    });
  };
})
.directive('maskRif', function() {
  return function(scope, element, attrs) {
    element.bind("keypress", function(event) {
      let key = event.which || event.keyCode;
      let input = element[0].value;
      /*
        69 = e, 101 = E, 71 = g, 103 = G, 73 = i, 105 = I
        74 = j, 106 = J, 77 = m, 109 = M, 80 = i, 112 = P
        82 = r, 114 = R, 86 = v, 118 = V */
      if (((key == 69 || key == 101) || (key == 71 || key == 103) || (key == 73 || key == 105) || 
        (key == 74 || key == 106) || (key == 77 || key == 109) || (key == 80 || key == 112) ||
        (key == 82 || key == 114) ||  (key == 86 || key == 118)) && input.length === 0 ) {
        return true
      }
      if (key == 45 && (input.length === 1 || input.length === 10)) {
        return true
      }
      if (key >= 48 && key <= 57 && (input.length >= 2 && input.length <= 9) || input.length === 11) {
        return true
      }
      scope.$apply(function(){
        scope.$eval(attrs.maskRif);
        event.preventDefault();
      });
    });
  };
})