$(document).ready(function(){
	iniciar();
});
	 var primero=true,duracion,hr,min,chkbox,cabina,b,opcion='',opcion2='',idCita,evento_boton=true,fecha;
	 var arrFechas=new Array(),arrMin=new Array();
function iniciar(){
	actualizarCita();
	
	
	setTimeout(function() {
		establece_datapicker();
		
		setInterval(function() {
			actualizarCita();
			establece_datapicker();
			
			},30000)
			
		},2000);
	
	 $( "#btnPaciente" ).click(function(){
			cancelar('paciente');
		 });
		 
		 $( "#btnEncargado" ).click(function(){
			cancelar('encargado');			 
		 });
		 
		 $( "#btnCerrar" ).click(function(){
			 $( "#msjConfirm" ).hide();
			 });

}

function actualizarCita(){
	    $.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			idCita:$( "#hdnCita" ).val()
		},

		success : function(data) {
			respuesta = JSON.parse(data);
			idCita=respuesta[0]['idCita'];
			if(primero){
				duracion=respuesta[0]['duracion'];
				var horario=respuesta[0]['hora'].split(':');
				hr=horario[0];
				min=horario[1];
				cabina=respuesta[0]['idCabina'];
				chkbox=respuesta[0]['enviarRecordatorio2'];
				comentario='';
				fecha=respuesta[0]['fecha'];
			}else{
				duracion=$( "#slcDuracion" ).val();
				hr=$( "#slcHr" ).val();
				min=$( "#slcMin" ).val();
				cabina=$( "#slcConsultorio" ).val();
				chkbox=$('#checkRecordatorio').is(':checked');
				comentario=$( "#txtComentarios" ).val();
				fecha=$( "#txtFecha" ).val();
			} //alert(duracion+' '+min+' '+cabina);
			xajax_cargarInformacion(respuesta[0],duracion,hr,min,cabina,chkbox,comentario,fecha);
		}
	});

	    $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idCitaAct:$( "#hdnCita" ).val()
			},

			success : function(data) {
				respuesta = JSON.parse(data);
				xajax_cargarActualizaciones(respuesta);
			}
		});

}

function cargarHorasMin(arrH,hr_,minuto){
	$( "#slcDuracion" ).change(function(){
		 verHorarios();
		});
	$( "#slcConsultorio" ).change(function(){
		 verHorarios();
		});
	$( "#txtFecha" ).change(function(){
		 verHorarios();
	 });
	
	arrFechas=JSON.parse(arrH);
//	alert(arrH);
	 opcion='',opcion2='';
	b=true;/*/
//	arrFechas=new Array();
	if(arrFechas.length==0){
		arrFechas[parseInt($( "#hdnHR" ).val())]=new Array('-');
	}
	//alert(arrFechas["08"]);
	if(arrFechas[parseInt($( "#hdnHR" ).val())]==undefined)
		arrFechas[parseInt($( "#hdnHR" ).val())]=new Array('-');/*/
	primero=true;
	$.each(arrFechas, function( index, arr ) {
		opcion+='<option value="'+index+'" '+(index==hr_?'selected':'')+'>'+index+'</option>';/*/
		if(arr.length==0){
			arr[index]=new Array('-');
		}/*/
		if((parseInt($( "#hdnHR" ).val())==parseInt(index))/*/&&(parseInt($( "#hdnCabina" ).val())==parseInt($("#slcConsultorio").val()))/*/){
			if(primero/*/&&parseInt($( "#slcDuracion" ).val())<=parseInt($( "#hdnDuracion" ).val())/*/){
				/*/	arr.push(minuto);
				min=minuto;
				hr=hr_;/*/
				primero=false;
			}
			$.each(arr, function( index2, min ) {
				opcion2+='<option value="'+min+'"  '+(parseInt(min)==parseInt(minuto)?'selected':'')+'>'+min+'</option>';
			});
		}
		});
	$("#slcHr").html(opcion);
	$("#slcMin").html(opcion2);
	 
	$( "#slcHr" ).change(function(){
		 opcion2='';
		 
		 arrMin=arrFechas[$("#slcHr").val()];/*/
		 if((parseInt($( "#hdnHR" ).val())==parseInt($("#slcHr").val()))&&(parseInt($( "#hdnCabina" ).val())==parseInt($("#slcConsultorio").val()))&&(parseInt($( "#slcDuracion" ).val())<=parseInt($( "#hdnDuracion" ).val()))){
					arrMin.push($( "#hdnMIN" ).val());
		 }/*/
		 $.each(arrMin, function( index2, min ) {
				opcion2+='<option value="'+min+'">'+min+'</option>';
			});
		 $("#slcMin").html(opcion2);

		 establece_datapicker();	
	 });
	
}

function verHorarios(){
	
	var sucursal= $("#hdnSucursal").val();
	var consulta = $("#hdnConsulta").val();
	var consultorio = $("#slcConsultorio").val().trim();
	 duracion = $("#slcDuracion").val().trim();
	var fecha = $("#txtFecha").val();
	$("#slcHr").html('<option value=""></option>');
	$("#slcMin").html('<option value=""></option>');
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSucursal:sucursal,
				fecha:fecha,
				idConsulta:consulta,
				duracion:duracion,
				idConsultorio:consultorio
			},
			success : function(data) {
				arrFechas=JSON.parse(data);/*/
				if(arrFechas.length==0){
					arrFechas[parseInt($( "#hdnHR" ).val())]=new Array('-');
				}
				//alert(arrFechas["08"]);
				if(arrFechas[parseInt($( "#hdnHR" ).val())]==undefined)
					arrFechas[parseInt($( "#hdnHR" ).val())]=new Array('-');
				/*/
				opcion='',opcion2='';
				$.each(arrFechas, function( index, arr ) {
					opcion+='<option value="'+index+'">'+index+'</option>';/*/
					if(arr.length==0){
						arr[index]=new Array('-');
					}/*/
					if((parseInt($( "#hdnHR" ).val())==parseInt(index))){/*/
						primero=true;
						if(primero&&parseInt($( "#slcDuracion" ).val())<=parseInt($( "#hdnDuracion" ).val())){
							arr.push(parseInt($( "#hdnMIN" ).val()));
							primero=false;
						}/*/
						$.each(arr, function( index2, min ) {
							opcion2+='<option value="'+min+'"  '+(parseInt(min)==parseInt(parseInt($( "#hdnHR" ).val()))?'selected':'')+'>'+min+'</option>';
						});
					}
					});
				$("#slcHr").html(opcion);
				$("#slcMin").html(opcion2);
			}
		});
	
}

function visualizar(v,estatus){
	if(v=='si'){
		$( "#divGuardar" ).show();
		activarBtn();
	}else
		$( "#divGuardar" ).hide();
	
	if(estatus=='En curso'||estatus=='Nueva'){
		$( "#btnAgregar" ).click(function(){
			if($( "#txtComentarios" ).val()==""){
				mostrarMsjError('No se ha ingresado un comentario!!',3);
				return false;
			}
			xajax_agregaComentario($( "#txtComentarios" ).val(),idCita);
			$( "#txtComentarios" ).val('');
		 });
		if(estatus=='Nueva')
		$( "#btnCancelar" ).click(function(){
			$( "#msjConfirm" ).show();
		 });
	}
	primero=false;
}

function activarBtn(){
	if(evento_boton){
		$( "#btnGuardar" ).click(function(){
		if($( "#slcHr" ).val()=="0"||$( "#slcMin" ).val()=="-"||$( "#slcMin" ).val()==undefined){
			mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
			return false;
		}		
		var consultorio = $("#slcConsultorio").val().trim();
		 duracion = $("#slcDuracion").val().trim();
		var hora=$( "#slcHr" ).val();
		var minuto=$( "#slcMin" ).val();
		chkbox=$('#checkRecordatorio').is(':checked');
		var fecha = $("#txtFecha").val();
		xajax_guardarCambios(idCita,duracion,hora,minuto,consultorio,chkbox,fecha);
	 });
	}
	
	evento_boton=false;
}

function cancelar(canceladaPor){
	//alert(idCita);
	mensajeConfirmacion("Cancelar cita", "Escribe su contrase&ntilde;a para continuar", canceladaPor, "msjConfirm");
}


function cancelarCita(password,canceladaPor){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			password:password
		},
		success : function(data2) {
			//if(data2=='true'){
			if(password=='789'){
					$.ajax({
					method : "post",
					url : "adminFunciones.php",
					data : {
						idCitaCancelar:idCita,
						por:canceladaPor
					},
					success : function(data3) {
						$( "#msjConfirm" ).hide();
						
						if(data3=='true')
							mostrarMsjExito('Se ha cancelado la cita correctamente por el '+canceladaPor+'.',5);
						if(data3=='false')
							mostrarMsjError('Ha ocurrido un error, int&eacute;ntelo m&aacute;s tarde.',5);
						if(data3=='false2')
							mostrarMsjError('No se puede enviar el SMS, el n&uacute;mero es incorrecto.',5);
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

function establece_datapicker(){
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		minDate : '0D',
			beforeShowDay: function(date) {
			    var day = date.getDay();
			    return [(day != 0), ''];
			}
	});
}

	// $("#").();
// var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');
// alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse
// (default)
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