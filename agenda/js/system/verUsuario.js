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
	
	$("#btnPass").click(function(){
		$('html,body').animate({
		    scrollTop: $("#divArriba").offset().top
		}, 200);
		mostrarMsjEspera('Espere un momento...',15);
		xajax_generaPassword($("#idUsuario").val(),$("#idLogin").val());
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
	
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			listadoSucursales:$("#idUsuario").val()
			
		},

		success : function(data) {
			arrSucursales=JSON.parse(data);
			$.each(arrSucursales, function( id, value ) {
				$('#chk'+id).prop('checked', true);
				});
		}
	});
	
}

function altaUsuario(){
	var existeError = false;
//	var sucursal = $("#slcSucursal").val();
	var idUsuario = $("#idUsuario").val();
	
	$('html,body').animate({
	    scrollTop: $("#divArriba").offset().top
	}, 200);
	/*
	if ( sucursal == "") {
		existeError = true;
		console.log("Error: sucursal");
	}
*/
	
	var arrSucursal = [];
	var i = 0;
	$('.checkSucursal:checked').each(function() {
		arrSucursal[i] = $(this).val();
		i++;
	});
	if(i==0){
		mostrarMsjError('Debe seleccionar por lo menos 1 sucursal',3);
		return false;
	}
	
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
	}else{
		mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.',5);

		xajax_guardarUsuario(idUsuario,arrSucursal);
			 
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