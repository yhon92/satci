(function () {
	'use stric';

	angular.module('SATCI.filters', [])

	.filter("capitalize", function(){
		return function (text) {
			if(text != null){
				return text.substring(0,1).toUpperCase()+text.substring(1);
			}
		}
	})

	.filter('translateApplicant', function () {
		return function (applicant) {
			if(applicant != null) {
				if (applicant === 'citizen') {
					return 'Natural';
				}
				if (applicant === 'institution') {
					return 'Jurídico';
				}
			}
		}
	})

	.filter('indentification', function () {
		return function (applicant) {
			if(applicant != null) {
				if (applicant === 'citizen') {
					return 'Cédula';
				}
				if (applicant === 'institution') {
					return 'RIF';
				}
			}
		}
	})


})();