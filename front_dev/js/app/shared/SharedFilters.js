angular.module('Shared.filters', [])
.filter("capitalize", () => {
  return (text) => {
    if (text != null) {
      return text.substring(0,1).toUpperCase()+text.substring(1);
    }
  }
})

.filter('titleCase', () => {
  return (input) => {
    input = input.toLowerCase();
    
    let smallWords = /^(a|y|de|del|que|para|con|vs?\.?|via)$/i;

    return input.replace(/[A-Za-z0-9\u00C0-\u00FF]+[^\s-]*/g, (match, index, title) => {
      if (index > 0 && index + match.length !== title.length &&
        match.search(smallWords) > -1 && title.charAt(index - 2) !== ":" &&
        (title.charAt(index + match.length) !== '-' || title.charAt(index - 1) === '-') &&
        title.charAt(index - 1).search(/[^\s-]/) < 0) {
        return match.toLowerCase();
    }

    if (match.substr(1).search(/[A-Z]|\../) > -1) {
      return match;
    }

    return match.charAt(0).toUpperCase() + match.substr(1);
  });
  }
})

.filter('translateApplicant', () => {
  return (applicant) => {
    if (applicant != null) {
      if (applicant === 'citizen' || applicant === 'Citizen') {
        return 'Natural';
      }
      if (applicant === 'institution' || applicant === 'Institution') {
        return 'Jurídico';
      }
    }
  }
})

.filter('indentification', () => {
  return (applicant) => {
    if (applicant != null) {
      if (applicant === 'citizen' || applicant === 'Citizen') {
        return 'Cédula';
      }
      if (applicant === 'institution' || applicant === 'Institution') {
        return 'RIF';
      }
    }
  }
})
.filter('dateTime', ($filter) => {
  return (input, format) => {
    let tempdate = new Date(input.replace(/-/g,"/"));
    return $filter('date')(tempdate, format).toLowerCase();
  };
})