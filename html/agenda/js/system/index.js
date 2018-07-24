$(document).ready(function(){
	
	iniciar();
});
	 
function iniciar(){
	
/*	 $.ajax({
			method : "post",
			url : "http://www.siluetaexpress.com.mx/agenda/recepcionSMS.php",
			data : {
				text:'CANCELAR C18',
				keyword:'CANCELAR',
				telnum:'527331258053'
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				$( "#slcSucursal" ).html(respuesta);
			}
		});
	
*/
	actualizaResumen();
	
	
}
function knob_(){
	$(".knob").knob();
}

function actualizaResumen(){
	var nsucursal,usuario='';
	if($("#hdnRol").val()!=1){
		nsucursal=$( "#hdnSucursal" ).val();
		usuario=$( "#hdnUsuario" ).val();
	}else{
		nsucursal=$( "#slcSucursal" ).val();
	}
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				fechaIndex:$( "#txtFecha" ).val(),
				SucursalIndex:nsucursal,
				usuarioIndex:usuario
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				//alert(data);
				xajax_verGraficas(respuesta);
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
