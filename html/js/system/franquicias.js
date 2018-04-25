$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$("#btnFranquicia").click(function (){
		$("#formulario").show();
		$('html,body').animate({
		    scrollTop: $("#divFormulario").offset().top
		}, 2000);
	});
	$("#btnEnviar").click(altaFranquicia);
}

function altaFranquicia(){
	var existeError = false;
	
	var txtNombre= $("#txtNombre").val().trim();
	if (txtNombre == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}
	
	var slcEstado= $("#slcEstado").val().trim();
	if (slcEstado == "") {
		existeError = true;
		console.log("Error: txtEstado");
	}
	var slcMunicipio= $("#slcMunicipio").val().trim();
	if (slcMunicipio == "") {
		existeError = true;
		console.log("Error: txtMunicipio");
	}
	var txtCiudad= $("#txtCiudad").val().trim();
	if (txtCiudad == "") {
		existeError = true;
		console.log("Error: txtCiudad");
	}
	
	var txtDireccion= $("#txtDireccion").val().trim();
	if (txtDireccion == "") {
		existeError = true;
		console.log("Error: txtDireccion");
	}
	var txtTel= $("#txtTel").val().trim();
	if (txtTel == "") {
		existeError = true;
		console.log("Error: txTelt");
	}
	var txtEmail= $("#txtEmail").val().trim();
	if (txtEmail == "") {
		existeError = true;
		console.log("Error: txtEmail");
	}
	var txtComentarios = $("#txtComentarios").val().trim();
	if (txtComentarios == "") {
		existeError = true;
		console.log("Error: txtComentarios");
	}
	
	if(existeError){
		alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
		alertify.notify('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita','error',3, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

		return false;
	}
	
}
	//$("#").();
//var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');     	 
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);
