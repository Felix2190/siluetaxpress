$(document).ready(function(){
	iniciar();
});
function iniciar(){
	
	$("#btnGuardar").click(altaTipo);
}

function altaTipo(){
	var existeError = false;
	var idTipoUsuario = $("#idTipoUsuario").val();
	var cargo = $("#txtNombre").val();
	var abreviatura = $("#txtAbreviatura").val();
	
	if ( cargo == "") {
		existeError = true;
		console.log("Error: cargo");
	}
	if ( abreviatura == "") {
		existeError = true;
		console.log("Error: abreviatura");
	}
	$('html,body').animate({
	    scrollTop: $("#divArriba").offset().top
	}, 200);
	
	var numAbrev = abreviatura.split(" ");
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
	}else{
		if(contarCaracteres(abreviatura, '.')<parseInt(numAbrev.length)){
			mostrarMsjError('La abreviatura est&aacute; mal escrita',5);
			return false;
		}
		mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
		xajax_guardarCargo(idTipoUsuario,cargo,abreviatura);
	}
}

function contarCaracteres(cadena, caracter){
	  var indices = [];
	  for(var i = 0; i < cadena.length; i++) {
	    if (cadena[i].toLowerCase() === caracter) indices.push(i);
	  }
		return indices.length;
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