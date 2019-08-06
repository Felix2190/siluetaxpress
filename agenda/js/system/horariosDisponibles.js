$(document).ready(function(){
	iniciar();
});
var Digital=new Date();
var hours, minutes,seconds,dn,presionado=false;
	 
function iniciar(){
	var nsucursal='';
	if($("#hdnRol").val()!=1)
		nsucursal=$( "#hdnSucursal" ).val();
	
	if($("#hdnRol").val()==1){
		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					sucursalCitaNueva:''
				},
				success : function(data) {
//					respuesta=JSON.parse(data);
					$( "#slcSucursal" ).html(data);
				}
			});
	 }else{
		 mostrarCabinas();
	 }
	
	$( "#slcSucursal" ).change(mostrarCabinas);
	$( "#slcConsultorio" ).change(function(){mostrarHorarios($( "#hdnFechaActual" ).val());});
	
//	mostrarHorarios($( "#hdnFechaActual" ).val());
	actualizaHorarios();
	
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		minDate : '0D'
	});
	
	 $( "#btnSig" ).click(function(){
		 mostrarHorarios($( "#hdnFechaFin" ).val());
	 });
	 
	 $( "#txtFecha" ).change(function(){
		 mostrarHorarios($( "#txtFecha" ).val());
	 });

		
}

function mostrarCabinas(){
	var nsucursal=$( "#hdnSucursal" ).val();
	if (nsucursal=='')
		nsucursal=$( "#slcSucursal" ).val();
	$("#slcConsultorio").html("<option value=''> Selecciona una opción</option>");
	
	if (nsucursal!=''){
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
	}
	mostrarHorarios($( "#hdnFechaActual" ).val());
}

function mostrarHorarios(fechaActual){
	var nsucursal=$( "#hdnSucursal" ).val();
	if (nsucursal=='')
		nsucursal=$( "#slcSucursal" ).val();
	
	var nConsultorio=$( "#slcConsultorio" ).val();
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			Sucursal:nsucursal,
			Consultorio:nConsultorio,
			fechaInicio:fechaActual
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			xajax_mostrarHorarios(respuesta[0],respuesta[1],fechaActual);
		}
	});
}

function actualizaHorarios(){
	
	setTimeout(function() { 
		mostrarHorarios($( "#hdnFechaActual" ).val());
		
		setInterval(function() 
				{ 
			if(!presionado){
				mostrarHorarios($( "#hdnFechaActual" ).val());
				$( "#divAct" ).html(obtenHora());
			}else{
				presionado=false;
			}
			},5600)
		},700);
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

function colocaFechas(fechaF,fechaA,fechaI){
	$( "#hdnFechaFin" ).val(fechaF);
	$( "#hdnFechaActual" ).val(fechaA);
	$( "#hdnFechaInicio" ).val(fechaI);
	 $( "#btnAnt" ).click(function(){
		 mostrarHorarios(fechaI);
	 });

}

function predefineFecha(idSucursal,idCabina,fecha,auxH){
	presionado=true;
	xajax_agendarCita(idSucursal,idCabina,fecha,auxH);
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