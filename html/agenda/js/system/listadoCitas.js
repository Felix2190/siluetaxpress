$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	listarCitas();
		
		 $( "#slcSucursal" ).change(mostrarCabinas);
		 
		 if($("#hdnRol").val()==1){
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
		 }else{
			 mostrarCabinas();
		 }
		 
		 $( "#slcConsultorio" ).change(listarCitas);
		 $( "#btnSig" ).click(listarCitas);
}

function listarCitas(){
	var idCabina="";
	var alta=$( "#hdnAlta" ).val();
	var nsucursal=$( "#hdnSucursal" ).val();
	if (nsucursal==''&&alta=="")
		nsucursal=$( "#slcSucursal" ).val();
	if(alta==""){
	idCabina=$( "#slcConsultorio" ).val();
	}
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				sucursal:nsucursal,
				paciente:$( "#hdnPaciente" ).val(),
				usuario:$( "#hdnUsuario" ).val(),
				cabina:idCabina,
				fechaInicio:$( "#hdnFechaInicio" ).val(),
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				xajax_consultarCitas(respuesta,$( "#hdnFechaInicio" ).val());
			}
		});
	 
}

function mostrarCabinas(){
	
	var nsucursal=$( "#hdnSucursal" ).val();
	if (nsucursal=='')
		nsucursal=$( "#slcSucursal" ).val();
	$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				Sucursal:nsucursal,
				Consulta:0,
			},
			success : function(data) {
				$("#slcConsultorio").html(data);
			}
		});
	 listarCitas();
}

function ocultarDetalles(id){
	$( "#l"+id ).show();
	$( "#c"+id ).hide();
}

function verDetalles(id){
	$( "#c"+id ).show();
	$( "#l"+id ).hide();
}
function colocaFecha(fecha){
	$( "#hdnFechaInicio" ).val(fecha);
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