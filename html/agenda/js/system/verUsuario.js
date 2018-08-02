$(document).ready(function(){
	iniciar();
});
var hrEntreI,hrEntreF,hrSabI,hrSabF,resp;
function iniciar(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			sucursales:''
		},

		success : function(data) {
			respuesta=JSON.parse(data);
			$( "#slcSucursal" ).html(respuesta);
		}
	});
	
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			listadoCargos:''
		},

		success : function(data) {
			respuesta=JSON.parse(data);
			$( "#slcCargo" ).html(respuesta);
		}
	});
	
	$('.numeric').numeric({negative : false});
	
	$("#btnGuardar").click(altaUsuario);
	
	$("#txtNombre").blur(function(){
		 var userN = $(this).val().split(" ");
		 if(userN[0]!=''){
			 validarCampo('login','userName',userN[0])
			 setTimeout(function() {
				
			 if(resp=='true')
				 $("#txtUserName").val(userN[0]);
			 else{
				 $("#txtUserName").val('');
			 }
				},1500);
				
		 }
	});
	
	$("#btnActivar").click(function(){
		estableceEstatus('activo');
	});
	$("#btnBloquear").click(function(){
		estableceEstatus('inactivo');
	});
	setTimeout(function() {
		$("#slcSucursal").val($("#idSucursal").val());
		$("#slcCargo").val($("#idTipoUsuario").val());
	},700);
}

function altaUsuario(){
	var existeError = false;
	var sucursal = $("#slcSucursal").val();
	var Cargo = $("#slcCargo").val();
	var nombre = $("#txtNombre").val();
	var apellidos = $("#txtApellidos").val();
	var userName = $("#txtUserName").val();
	var correo = $("#txtCorreo").val();
	var telefono = $("#txtTelefono").val();
	
	if ( apellidos == "") {
		existeError = true;
		console.log("Error: apellidos");
	}
	if ( Cargo == "") {
		existeError = true;
		console.log("Error: Cargo");
	}
	if ( nombre == "") {
		existeError = true;
		console.log("Error: nombre");
	}
	if ( sucursal == "") {
		existeError = true;
		console.log("Error: sucursal");
	}
	if ( telefono == "") {
		existeError = true;
		console.log("Error: telefono");
	}else{
		if(telefono.length<10){
			mostrarMsjError('El n&uacute;mero telef&oacute;nico es incorrecto ',3);
			return false;
		}
	}
	if ( userName == "") {
		existeError = true;
		console.log("Error: userName");
	}
	if ( correo == "") {
		existeError = true;
		console.log("Error: correo");
	}else{
	
	if(!validarEmail(correo)){
		mostarMsjError('El formato del correo electr&oacute;nico es incorrecto ',3);
		return false;
	}
	}

	$('html,body').animate({
	    scrollTop: $("#divArriba").offset().top
	}, 200);
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
	}else{
		mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 8);

		validarCampo('login','userName',userName)
		 setTimeout(function() {
			
		 if(resp=='true'){
			 validarCampo('usuario','correo',correo)
			 setTimeout(function() {
				
			 if(resp=='true'){
				 xajax_guardarUsuario(nombre, apellidos, sucursal, Cargo, correo, telefono, userName);
			 } else{
				 mostrarMsjError('El correo electr&oacute;nico ingresado ya existe',3);
				 $("#txtCorreo").val('');
			 }
				},1500);
			 
			 
		 } else{
			 mostrarMsjError('El username ingresado ya existe',3);
			 $("#txtUserName").val('');
		 }
			},1500);
	}
}

function validarEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}

function enviarEmail(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			correo:'ortizfelix9021@gmail.com',
			mensaje:'prueba mensaje',
			asunto:'este es un asunto'
		},

		success : function(data) {
			respuesta=JSON.parse(data);
		}
	});
}
function validarCampo(tabla,campo,valor) {
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			campo:campo,
			valor:valor,
			tabla:tabla
		},

		success : function(data) {
			resp= data;
		}
	});
}

function estableceEstatus(estatus){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			estatusU:estatus,
			idLogin:$("#idLogin").val()
		},

		success : function(data) {
			if(data=='true'){
				mostrarMsjError('El estatus ha sido modificado',3);
				setTimeout(function() {window.location='verUsuario.php'},1500);
			}else{
				 mostrarMsjError('No se pudo cambiar el estatus, int&eacute;ntelo m&aacute;s tarde. ('+data+')',3);
			}
		}
	});

}
// $("#").();
// var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);
/*
     $.ajax(
      {
      	method:"post",
					url: "adminFunciones.php",  					
					data: 
					{  						
					},
					
					success: function(data) 
					{
  					respuesta=JSON.parse(data);
					}
	    });

 
 */