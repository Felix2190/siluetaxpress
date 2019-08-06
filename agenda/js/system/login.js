$(document).ready(function(){
	if(parseInt(screen.height)<737)
		window.location="loginMovil.php";
	iniciar();
});
	 
function iniciar(){
	$("#slcFranquicia").change(listarSucursales);
	$("#btnEntrar").click(entrar);
	if($("#sesion").val()=="1")
		irAgenda();

}


function listarSucursales(){

	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idFranquiciaLogin: $("#slcFranquicia").val()
			},
			success : function(data) {
				$( "#slcSucursal" ).html(data);
			}
		});
}

function entrar(){
	var user = $("#txtUserName").val();
	var pass = $("#txtPassword").val().trim();
	var franquicia = $("#slcFranquicia").val();
	var sucursal = $("#slcSucursal").val();
	var existeError = false;
	
	if (user == "") {
		existeError = true;
		console.log("Error: txtUserName");
	}
	
	if (pass == "") {
		existeError = true;
		console.log("Error: txtPassword");
	}

	if (franquicia == "") {
		existeError = true;
		console.log("Error: txtfranquicia");
	}
	
	if (sucursal == "") {
		existeError = true;
		console.log("Error: txtSucursal");
	}
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita',3); 
		return false;
	}
	mostrarMsjEspera('Espere un momento... validando datos.', 1);
	xajax_ingresar(user,pass,sucursal,franquicia);
	
}

function irAgenda(){
	setTimeout(function(){
		window.location=$("#hdnURL").val();
	},2500);

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
