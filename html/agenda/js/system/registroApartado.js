$(document).ready(function(){
	iniciar();
});
var bandera=true, text;

function consultaDatos(){
	 
	 if($("#hdnRol").val()==1)
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
			
}

function iniciar(){
	
	$("input[name=rango]").change(function(){
		$('.HrI').hide();
		 $('.MinI').hide();
		 $('.HrF').hide();
		 $('.MinF').hide();
		 $('.Fecha2').hide();
		 
		if($(this).val()=="fecha"){
			 $('.Fecha2').show();
			 $('.HrI').show();
			 $('.MinI').show();
			 $('.HrF').show();
			 $('.MinF').show();
		}
		if($(this).val()=="dia"){
		}
		if($(this).val()=="horario"){
			 $('.HrI').show();
			 $('.MinI').show();
			 $('.HrF').show();
			 $('.MinF').show();
		}
	});
	
	consultaDatos();
		 
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
	
	
     $( "#slcSucursal" ).change(function(){
    	 mostrarCabinas();
    	 verHorarios();
//    	 seleccionaDiaChecaSabado();
     });
     
	 $( "#txtFecha" ).change(function(){
		 verHorarios();
	 });
	
	 
	 $( "#slcHrI" ).change(function(){
		 cambioHr();
			setTimeout(function() {
				cambioMin();
			},500);
	 });
	
	 $( "#slcMinI" ).change(function(){
		 cambioMin();
	 });
	
	 $( "#slcHrF" ).change(function(){
		 cambioMin();
	 });
	
	 
		
	$("#btnGuardar").click(function(){
		$("#btnGuardar").hide();
		bandera=true;
		 altaCita(obtenerDias());
	});
	
	$("#btnAceptar").click(function(){
		$('html,body').animate({
		    scrollTop: $("#divInicio").offset().top
		}, 2000);
		bandera=false;
		$('#divFechasNoDisponibles').hide();
		 altaCita(obtenerDias());
	});
	
	$("#btnCancelar").click(function(){
		$('html,body').animate({
		    scrollTop: $("#divInicio").offset().top
		}, 2000);
		$("#btnGuardar").show();
		$('#divFechasNoDisponibles').hide();
	});
	
	if($( "#hdnPredefinida" ).val()=='true'){
		$( "#txtFecha" ).val($( "#hdnFecha" ).val());
		$( "#slcDuracion" ).val('10');
	}
		
}
var arrHrs=[],arrMin=[],horaFin;

function obtenerDias() {
	var arrDias = [];
	var i = 0;
	$('.checkDias:checked').each(function() {
		arrDias[i] = $(this).val();
		i++;
	});
	return arrDias;
}

function verHorarios(){
	var sucursal= $("#slcSucursal").val().trim();
	var fecha = $("#txtFecha1").val().trim();
	$("#slcHrI").html('<option value=""></option>');
	$("#slcMinI").html('<option value=""></option>');
	$("#slcHrF").html('<option value=""></option>');
	$("#slcMinF").html('<option value=""></option>');
	
	if (fecha != "" && sucursal != "" ) {
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSucursalA:sucursal,
				fechaA:fecha
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				arrHrs=respuesta[0];
				arrMin=respuesta[1];
				horaFin=respuesta[2];
				var opcion='',opcion2='', b=true;
				$.each(arrHrs, function( index, hr ) {
					opcion+='<option value="'+hr+'">'+hr+'</option>';
					if(b){
						b=false;
						$.each(arrMin, function( index2, min ) {
							opcion2+='<option value="'+min+'">'+min+'</option>';
						});
					}
					});
				$("#slcHrI").html(opcion);
				$("#slcMinI").html(opcion2);
				
				
				setTimeout(function() {
					 opcion='',opcion2='', b=true;
						$.each(arrHrs, function( index, hr ) {
							opcion+='<option value="'+hr+'">'+hr+'</option>';
							});
						opcion+='<option value="'+horaFin+'">'+horaFin+'</option>';
						opcion2+='<option value="00">00</option>';
						$("#slcHrF").html(opcion);
						$("#slcMinF").html(opcion2);
						
						setTimeout(function() {
							$("#slcHrF").val(horaFin);
						},400);
				},1500);
			}
		});
	}
	
}

function cambioMin(){
	 var opcion2='';
	 var auxMin=parseInt($("#slcMinI").val());
	 if(parseInt($("#slcHrI").val())==parseInt($("#slcHrF").val())){
	 $.each(arrMin, function( index2, min ) {
		 if(min>auxMin)
			opcion2+='<option value="'+min+'">'+min+'</option>';
		});
	 }
	 else{
		 $.each(arrMin, function( index2, min ) {
				opcion2+='<option value="'+min+'">'+min+'</option>';
			});
		}
	 $("#slcMinF").html(opcion2);
	 
}

function cambioHr(){
	 var opcion='';
	 var auxHr=parseInt($("#slcHrI").val());
	 $.each(arrHrs, function( index2, Hr) {
		 if(Hr>=auxHr)
			opcion+='<option value="'+Hr+'">'+Hr+'</option>';
		});
	 opcion+='<option value="'+horaFin+'">'+horaFin+'</option>';
	 $("#slcHrF").html(opcion);
	 
}

function altaCita(arrDias){
	var existeError = false;
		
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	var duracion = $("#slcDuracion").val().trim();
	var fecha = $("#txtFecha").val().trim();
	var hora= $("#slcHr").val().trim();
	var minutos= $("#slcMin").val().trim();
	var paciente = $("#slcPaciente").val().trim();
	var servicio = $("#txtServicio").val().trim();
	var comen = $("#txtComentarios").val().trim();
	var consultorio = $("#slcConsultorio").val().trim();

	if ( sucursal == "") {
		existeError = true;
		console.log("Error: sucursal");
	}
	if (consulta == "") {
		existeError = true;
		console.log("Error: consulta");
	}
	if (consultorio == "") {
		existeError = true;
		console.log("Error: consultorio");
	}
	if (duracion == "") {
		existeError = true;
		console.log("Error: duracion");
	}
	if (fecha == "") {
		existeError = true;
		console.log("Error: fecha");
	}
	if (hora == "") {
		existeError = true;
		console.log("Error: hora");
	}
	if (minutos == "") {
		existeError = true;
		console.log("Error: minutos");
	}
	if (paciente == "") {
		existeError = true;
		console.log("Error: paciente");
	}
	if (servicio == "") {
		existeError = true;
		console.log("Error: servicio");
	}
	if (comen == "") {
	//	existeError = true;
		console.log("Error: comen");
	}
	var repetir=$('#checkRepetir').is(':checked');
	var Recordatorio=$('#checkRecordatorio').is(':checked');
	var periodo=$("#slcPeriodo").val().trim();
	var veces = $("#slcVeces").val().trim();
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		$("#btnGuardar").show();
	}else{
		mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
		xajax_guardarCita(paciente,sucursal,consultorio,consulta,duracion,fecha,hora,minutos,servicio,comen,repetir,arrDias,periodo,veces,bandera,Recordatorio);
	}
}

function mostrarCabinas(){
	var sucursal= $("#slcSucursal").val().trim();
	
		$('#divCabinas').hide();
	if(sucursal!='')
	$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				SucursalA:sucursal,
			},
			success : function(data) {
				text='';
				respuesta=JSON.parse(data);
				$.each(respuesta, function( id, valor) {
					text+='<div class="3u 12u$(small)"><input class="checkCabinas" value="'+id+'" id="chk'+id+'" name="chk'+id+'"  type="checkbox"> <label for="chk'+id+'">'+valor+'</label></div>';
				});
				$('#divCabinas').show();
				$("#checksCabinas").html(text);
			}
		});
	
}


function mostrarConfirmacion(){
	$('#divFechasNoDisponibles').show();
	$('html,body').animate({
	    scrollTop: $("#divFechasNoDisponibles").offset().top
	}, 2000);
}

function limpiarDatos(){
	var dias = new Array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');
	$.each(dias, function( index, ch ) {
		$( "#chk"+ch).removeAttr('checked');
	});

	consultaDatos();
	$("#txtFecha").val('');
	$("#txtServicio").val('');
	$("#txtComentarios").val('');
	$("#slcPaciente").val('');
	$("#slcDuracion").val('');
	$( "#checkRepetir").removeAttr('checked');
	$( "#checkRepetir" ).attr('disabled');

	 $('#divRepiteCita').hide();
	 $('#divRepiteCitaDias').hide();

	$("#btnGuardar").show();
}

