$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){

		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					sucursal:$( "#hdnSucursal" ).val(),
					paciente:$( "#hdnPaciente" ).val(),
					usuario:$( "#hdnUsuario" ).val()
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					xajax_consultarCitas(respuesta);
				}
			});
		
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