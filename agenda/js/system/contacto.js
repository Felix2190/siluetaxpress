$(document).ready(function(){
	$("#btnEnviar").click(altaComentario);
	$('.numeric').numeric({negative : false});
});
	 
function iniciar(){
	
}

function altaComentario(){
	var existeError = false;
	
	var txtNombre= $("#txtNombre").val().trim();
	if (txtNombre == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}
	
	var txtApellidos= $("#txtApellidos").val().trim();
	if (txtApellidos == "") {
		existeError = true;
		console.log("Error: txtApellidos");
	}

	var txtTelefono= $("#txtTelefono").val().trim();
	if (txtTelefono == "") {
		existeError = true;
		console.log("Error: txtTelefono");
	}

	var txtCorreo= $("#txtCorreo").val().trim();
	if (txtCorreo == "") {
		existeError = true;
		console.log("Error: txtCorreo");
	}
	else{
		if(!validarEmail(txtCorreo)){
			mostrarMsjError('El formato del correo electr&oacute;nico es incorrecto ',3);
			return false;
		}
	}

	var txtComentarios= $("#txtComentarios").val();
	if (txtComentarios == "") {
		existeError = true;
		console.log("Error: txtComentarios");
	}
	$('html,body').animate({
	    scrollTop: $("#divFormulario").offset().top
	}, 200);

	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita',5);
		return false;
	}
	
	if (txtTelefono.length<10) {
		mostrarMsjError('El n&uacute;mero telef&oacute;nico es incorrecto ',3);
		return false;
	}
	
	
	mostrarMsjEspera('Enviando informaci&oacute;n... espere un momento!',12);
	xajax_guardar(txtNombre,txtApellidos,txtTelefono,txtCorreo,txtComentarios);
	
}

function limpiarDatos(correo){
	 $("#txtNombre").val('');
	 $("#txtApellidos").val('');
		$("#txtTelefono").val('');
		$("#txtCorreo").val('');
		$("#txtComentarios").val('');
		$.ajax({
			method : "post",
			url : "agenda/include/controler/adminFunciones.inc.php",
			data : {
				notificacion:correo
			},
			success : function(data) {
			}
		});
}
function validarEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
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
