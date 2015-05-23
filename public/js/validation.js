function soloLetras(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúüabcdefghijklmnñopqrstuvwxyz";
	especiales = [8,37,39,46];
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

function soloNum(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	num = "0123456789";
	especiales = [8,37,39,46];
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

function soloBorrar(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	num = "";
	especiales = [8,13,];
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

function ningunaTecla(e){
	return false;
}