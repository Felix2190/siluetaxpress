$(document).ready(function(){
	iniciar();
});
var hrEntreI,hrEntreF,hrSabI,hrSabF;
function iniciar(){
	
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			listadoEstados:''
		},

		success : function(data) {
			respuesta=JSON.parse(data);
			$( "#slcEstado" ).html(respuesta);
		}
	});
	
	$('.numeric').numeric({negative : false});
	
	$("#btnAgregar").click(altaSucursal);
	
	$("#slcEstado").change(cambioMunicipio);
	
	$("#slcHrEntreF").change(checarEntre);
	
	$("#slcHrSabF").change(checarSabado);

}
function cambioMunicipio(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			cve_ent:$("#slcEstado").val()
		},

		success : function(data) {
			respuesta=JSON.parse(data);
			$( "#slcMunicipio" ).html(respuesta);
		}
	});
}

function altaSucursal(){
	var existeError = false;
	var ent = $("#slcEstado").val();
	var mun = $("#slcMunicipio").val();
	var sucursal = $("#txtNombre").val();
	var direccion = $("#txtDireccion").val();
	var numCon = $("#txtConsultorios").val();
	var numCa = $("#txtCabinas").val();
	
	if ( ent == "") {
		existeError = true;
		console.log("Error: ent");
	}
	if ( mun == "") {
		existeError = true;
		console.log("Error: mun");
	}
	if ( sucursal == "") {
		existeError = true;
		console.log("Error: sucursal");
	}
	if ( direccion == "") {
		existeError = true;
		console.log("Error: direccion");
	}
	if ( numCon == "") {
		existeError = true;
		console.log("Error: numCon");
	}
	if ( numCa == "") {
		existeError = true;
		console.log("Error: numCa");
	}

	$('html,body').animate({
	    scrollTop: $("#divArriba").offset().top
	}, 200);
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
	}else{
		if(!checarEntre()||!checarSabado())
			return false;
		
		if(numCon==0||numCa==0){
			mostrarMsjError('Debe de existir por lo menos un consultorio o cabina', 3);
			return false;
		}
		mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
		xajax_guardarSucursal(ent,mun,sucursal,direccion,hrEntreI,hrEntreF,hrSabI,hrSabF,numCon,numCa);
	}
}

function checarEntre(){
	hrEntreI=parseInt($("#slcHrEntreI").val());
	hrEntreF=parseInt($("#slcHrEntreF").val());
	console.log(hrEntreI+' '+hrEntreF);
	if(hrEntreI==hrEntreF){
		mostrarMsjError('El horario de salida debe ser diferente al del entrada', 3);
		return false;
	}
	if(hrEntreI>hrEntreF){
		mostrarMsjError('El horario de salida debe ser mayor al del entrada', 3);
		return false;
	}
	return true;
}

function checarSabado(){
	hrSabI=parseInt($("#slcHrSabI").val());
	hrSabF=parseInt($("#slcHrSabF").val());
	console.log(hrSabI+' '+hrSabF);
	if(hrSabI==hrSabF){
		mostrarMsjError('El horario de salida debe ser diferente al del entrada', 3);
		return false;
	}
	
	if(hrSabI>hrSabF){
		mostrarMsjError('El horario de salida debe ser mayor al del entrada', 3);
		return false;
	}
	return true;
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