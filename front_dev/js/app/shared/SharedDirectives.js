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
.directive('noneKey', () => {
  return (scope, element, attrs) => {
    element.bind("keypress", (event) => {
      scope.$apply(() => {
        scope.$eval(attrs.onlyNumbers);
        event.preventDefault();
      });
    });
  };
})
.directive('onlyNumbers', () => {
  return (scope, element, attrs) => {
    element.bind("keypress", (event) => {
      let key = event.keyCode || event.which;
      let tecla = String.fromCharCode(key).toLowerCase();
      let num = "0123456789";
      let especiales = [8, 37, 39, 46];
      let tecla_especial = false;

      for (var i in especiales) {
        if (key == especiales[i]) {
          tecla_especial = true;
          break;
        }
      }

      if (num.indexOf(tecla) == -1  && !tecla_especial) {
        scope.$apply(() => {
          scope.$eval(attrs.onlyNumbers);
          event.preventDefault();
        });
      }
    });
  };
})
.directive('onlyLetters', () => {
  return (scope, element, attrs) => {
    element.bind("keypress", (event) => {
      let key = event.keyCode || event.which;
      let tecla = String.fromCharCode(key).toLowerCase();
      let letras = " áéíóúüabcdefghijklmnñopqrstuvwxyz";
      let especiales = [8, 13, 37, 39, 46];
      let tecla_especial = false;

      for (var i in especiales) {
        if (key == especiales[i]) {
          tecla_especial = true;
          break;
        }
      }

      if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        scope.$apply(() => {
          scope.$eval(attrs.onlyLetters);
          event.preventDefault();
        });
      }
    });
  };
})
.directive('maskRif', () => {
  return (scope, element, attrs) => {
    element.bind("keypress", (event) => {
      let key = event.which || event.keyCode;
      let input = element[0].value;

      /*
        86 = V, 118 = v, 69 = E, 101 = e, 80 = P, 112 = p,
        71 = G, 103 = g, 74 = J, 106 = j,  67 = C, 99 = c
        */
      if (((key == 86 || key == 118) || (key == 69 || key == 101) || (key == 80 || key == 112) || 
          (key == 71 || key == 103) || (key == 74 || key == 106) || (key == 67 || key == 99)) && input.length === 0 ) {
          return true
      }
      if (key == 45 && (input.length === 1 || input.length === 10)) {
        return true
      }
      if (key >= 48 && key <= 57 && (input.length >= 2 && input.length <= 9) || input.length === 11) {
        return true
      }
      if (key == 8 || key == 37 || key == 39 || key == 46) {
        return true
      }

      scope.$apply(() => {
        scope.$eval(attrs.maskRif);
        event.preventDefault();
      });
    });
  };
})