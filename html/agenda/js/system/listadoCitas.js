$(document).ready(function(){
	iniciar();
});
	 
var Digital=new Date();
var hours, minutes,seconds,dn,cita;

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
		 
		 $( "#btnPaciente" ).click(function(){
			cancelar('paciente');
		 });
		 
		 $( "#btnEncargado" ).click(function(){
			cancelar('encargado');			 
		 });
		 
		 $( "#btnCerrar" ).click(function(){
			 $( "#msjConfirm" ).hide();
			 });
			 
		 /*
		 alertify.confirm('Confirm Title', 'Confirm Message', function(){ alertify.success('Ok') }
         , function(){ alertify.error('Cancel')}).set('labels',{ok:'Encargado',cancel:'Paciente'}).set('modal', true).set('closable',false); 
		 
		 var confirm= alertify.confirm('Probando confirm','Confirmar solicitud?',null,null).set('labels', {ok:'Confirmar', acccpt:'aceptar'}); 	
		 
		 confirm.set({transition:'slide'});   	
		  
		 confirm.set('onok', function(){ //callbak al pulsar botón positivo
		     	alertify.success('Has confirmado');
		 });
		  
		 confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
		     alertify.error('Has Cancelado el dialog');
		 });

		 confirm.set('onclose', function(){ //callbak al pulsar botón negativo
		     alertify.error('Has acept el dialog');
		 });
		 */
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
			},4500)
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

function cancelarCita(password,canceladaPor){

	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			password:password
		},
		success : function(data) {
			if(data=='true'){
				$.ajax({
					method : "post",
					url : "adminFunciones.php",
					data : {
						idCitaCancelar:cita,
						por:canceladaPor
					},
					success : function(data) {
						$( "#msjConfirm" ).hide();
						
						if(data=='true')
							mostrarMsjExito('Se ha cancelado la cita correctamente por el '+canceladaPor+'.',5);
						else
							mostrarMsjError('Ha ocurrido un error, int&eacute;ntelo m&aacute;s tarde.',5);
					}
				});
			}else{
				//el password es incorrecto
				mostrarMsjError('La contrase&ntilde;a es incorrecta!. ',2);
				setTimeout(function() { 
					cancelar(canceladaPor);
					},2400);

			}

		}
	});
}

function cancelar(canceladaPor){
	//alert(idCita);
	mensajeConfirmacion("Cancelar cita", "Escribe su contrase&ntilde;a para continuar", canceladaPor, "msjConfirm");
}

function verOpciones(idCita){
	 $( "#msjConfirm" ).show();
		cita=idCita;
}

function verCita(idCita){
	xajax_verCita(idCita);
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