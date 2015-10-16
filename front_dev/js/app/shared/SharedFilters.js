angular.module('Shared.filters', [])
.filter('filterPattern', () => {
  return (input, pattern) => {
   if (pattern.indexOf('numbers') != -1){
     input = input.replace(/[^\d.]/g, "");
   }
   else if (pattern.indexOf('alphabets') != -1){
    input = input.replace(/[^a-zA-Z ]/g, "");
  }
  else if (pattern.indexOf('alphaNumeric') != -1){
    input = input.replace(/[^a-zA-Z\d]/g, "");
  }

  console.log('return input ' +  input);
  return input;
  }
})
.filter("capitalize", () => {
  return (text) => {
    if(text != null){
      return text.substring(0,1).toUpperCase()+text.substring(1);
    }
  }
})

.filter('translateApplicant', () => {
  return (applicant) => {
    if(applicant != null) {
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
    if(applicant != null) {
      if (applicant === 'citizen' || applicant === 'Citizen') {
        return 'Cédula';
      }
      if (applicant === 'institution' || applicant === 'Institution') {
        return 'RIF';
      }
    }
  }
})