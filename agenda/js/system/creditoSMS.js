$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			consultaCredito:''
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			if(respuesta[0]==true)
				$( "#divCredito" ).html('<div class="4u 12u$(small)"><div class="box"><ul><li><strong>Cr&eacute;dito disponible:&emsp;'+respuesta[1]+'</strong></li></ul></div></div>');
			else{
				mostrarMsjError('El servicio no est&aacute; disponible',3);
				$( "#divCredito" ).html('');
			}
		}
	});
	
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			consultaSMS:''
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			xajax_mostrarTabla(respuesta);
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