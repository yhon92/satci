function onlyLetters(e){
	debugger;
	var key = e.keyCode || e.which,
	tecla = String.fromCharCode(key).toLowerCase(),
	letras = " áéíóúüabcdefghijklmnñopqrstuvwxyz",
	especiales = [8,37,39,46],
	tecla_especial = false

	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function onlyNumbers(e){
	var key = e.keyCode || e.which,
	tecla = String.fromCharCode(key).toLowerCase(),
	num = "0123456789",
	especiales = [8,37,39,46],
	tecla_especial = false

	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	if(num.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function onlyClear(e){
	var key = e.keyCode || e.which,
	tecla = String.fromCharCode(key).toLowerCase(),
	num = "",
	especiales = [8,13,],
	tecla_especial = false
	
	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	if(num.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function noKey (e){
	return false;
}
// Forma de Uso: onkeyup="cedulaMask(this)"
function cedulaMask (input){
	// var number = new String(input.value);
	// number = number.replace(/\./g,''); //quita todos los puntos de la cadena
	// var result = '';
	// while( number.length > 3 ){
	// 	result = '.' + number.substr(number.length - 3) + result;
	// 	number = number.substring(0, number.length - 3);
	// }
	// result = number + result;
	// input.value = result;



	var num = input.value.replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	}
	// else{
		// alert('Solo se permiten numeros');
		// input.value = input.value.replace(/[^\d\.]*/g,'');
	// }
}

function solicitudeNumberMask (input, e) {
	var key = e.which || e.keyCode;
	var input = input.value;
	
	if (key == 45 && (input.length === 3)) {
		return true;
	}
	if (key >= 48 && key <= 57 && (input.length >= 0 && input.length <= 2) || (input.length >= 4 && input.length <= 6)) {
		return true;
	}
	return false;
}

function rifMask (input, e){
	var key = e.which || e.keyCode;
	var input = input.value;

	/*
		69 = E, 101 = e, 71 = G, 103 = g, 73 = I, 105 = i
		74 = J, 106 = j, 77 = M, 109 = m, 80 = P, 112 = p
		82 = R, 114 = r, 86 = V, 118 = v
		*/
		if (((key == 69 || key == 101) || (key == 71 || key == 103) || (key == 73 || key == 105) || 
			(key == 74 || key == 106) || (key == 77 || key == 109) || (key == 80 || key == 112) ||
			(key == 82 || key == 114) ||	(key == 86 || key == 118)) && input.length === 0 ) {
			return true;
	}
	if (key == 45 && (input.length === 1 || input.length === 10)) {
		return true;
	}
	if (key >= 48 && key <= 57 && (input.length >= 2 && input.length <= 9) || input.length === 11) {
		return true;
	}
	return false;
}
