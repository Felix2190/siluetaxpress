$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){

	$("#btnGuardar").click(altaPaciente);
}

function altaPaciente(){
	var existeError = false;
	
	var txtNombre= $("#txtNombre").val().trim();
	if (txtNombre == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}

	var txtApellidos= $("#txtApellidos").val().trim();
	if (txtApellidos == "") {
		existeError = true;
		console.log("Error: txtApellido");
	}
	
	var txtTelCasa= $("#txtTelCasa").val().trim();
	if (txtTelCasa == "") {
		existeError = true;
		console.log("Error: txTelCasa");
	}
	var txtTelMovil= $("#txtTelMovil").val().trim();
	if (txtTelMovil == "") {
		existeError = true;
		console.log("Error: txTelMovil");
	}
	
	var txtEmail= $("#txtCorreo").val().trim();
	if (txtEmail == "") {
		existeError = true;
		console.log("Error: txtEmail");
	}
	
	var txtEdad= $("#txtEdad").val().trim();
	if (txtEdad == "") {
		existeError = true;
		console.log("Error: txtEdad");
	}
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita',5);
	}

	mostrarMsjEspera('Espere un momento... guardando informaaci&oacute;n.', 3);
	xajax_guardar(txtNombre, txtApellidos, txtTelCasa, txtTelMovil, txtEmail,txtEdad);
}

function limpiarDatos(){
	$("#txtNombre").val('');
	$("#txtApellidos").val('');
	
	$("#txtTelCasa").val('');
	$("#txtTelMovil").val('');
	$("#txtCorreo").val('');
	
	$("#txtEdad").val('');
	
}
//var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');     	 
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);