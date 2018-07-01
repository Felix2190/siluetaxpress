$(document).ready(function(){
	iniciar();
});
	 
var Digital=new Date();
var hours, minutes,seconds,dn;

function iniciar(){
	listarCitas($( "#hdnFechaActual" ).val());
	actualizaHorarios();
	
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		minDate : '0D'
	});
	
	
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
		 
		 $( "#slcConsultorio" ).change(function(){
			 listarCitas($( "#hdnFechaActual" ).val());
		 });
		
		 $( "#btnSig" ).click(function(){
			 listarCitas($( "#hdnFechaFin" ).val());
		 });
		 
		 $( "#txtFecha" ).change(function(){
			 listarCitas($( "#txtFecha" ).val());
		 });
		
}

function listarCitas(fechaI){
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
				fechaInicio:fechaI
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				xajax_consultarCitas(respuesta,fechaI);
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
	listarCitas($( "#hdnFechaActual" ).val());
}

function ocultarDetalles(id){
	$( "#l"+id ).show();
	$( "#c"+id ).hide();
}

function verDetalles(id){
	$( "#c"+id ).show();
	$( "#l"+id ).hide();
}
function colocaFechas(fechaF,fechaA,fechaI){
	$( "#hdnFechaFin" ).val(fechaF);
	$( "#hdnFechaActual" ).val(fechaA);
	$( "#hdnFechaInicio" ).val(fechaI);
	 $( "#btnAnt" ).click(function(){
		 listarCitas(fechaI);
	 });

}

function actualizaHorarios(){
	
	setTimeout(function() { 
		setInterval(function() 
				{ 
			listarCitas($( "#hdnFechaActual" ).val());
			$( "#divAct" ).html(obtenHora());
			},15000)
		},2000);
}

function obtenHora(){
	Digital=new Date();
	 hours=Digital.getHours();
	 minutes=Digital.getMinutes();
	 seconds=Digital.getSeconds();
	 dn="AM";
	 if (hours>12){
	 dn="PM";
	 hours=hours-12;
	 }
	 if (hours==0)
	 hours=12;
	 if (minutes<=9)
	 minutes="0"+minutes;
	 if (seconds<=9)
	 seconds="0"+seconds;
	 
	 return "<strong>&Uacute;ltima actualizaci&oacute;n... "+hours+":"+minutes+":"+seconds+" "+dn+"</strong>";
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