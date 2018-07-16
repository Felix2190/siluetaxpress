$(document).ready(function(){
	iniciar();
});
	 var primero=true,duracion,hr,min,chkbox,cabina,b,opcion='',opcion2='';
	 var arrFechas=new Array();
function iniciar(){
	actualizarCita();
	
	setTimeout(function() { 
		setInterval(function() {
			actualizarCita();
			},50000)
		},2000);

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
			if(primero){
				duracion=respuesta[0]['duracion'];
				var horario=respuesta[0]['hora'].split(':');
				hr=horario[0];
				min=horario[1];
				cabina=respuesta[0]['idCabina'];
				chkbox=respuesta[0]['enviarRecordatorio2'];
			}else{
				duracion=$( "#slcDuracion" ).val();
				hr=$( "#slcHr" ).val();
				min=$( "#slcMin" ).val();
				cabina=$( "#slcConsultorio" ).val();
				chkbox=$('#checkRecordatorio').is(':checked');
			}
			xajax_cargarInformacion(respuesta[0],duracion,hr,min,cabina,chkbox);
			primero=false;
		}
	});
}

function cargarHorasMin(arrH,hr,minuto){
	$( "#slcDuracion" ).change(function(){
		 verHorarios();
		});
	$( "#slcConsultorio" ).change(function(){
		 verHorarios();
		});

	arrFechas=JSON.parse(arrH);
//	alert(minuto);
	 opcion='';
	b=true;
	$.each(arrFechas, function( index, arr ) {
		opcion+='<option value="'+index+'" '+(index==hr?'selected':'')+'>'+index+'</option>';
		opcion2='';
			$.each(arr, function( index2, min ) {
				opcion2+='<option value="'+min+'"  '+(parseInt(min)==parseInt(minuto)?'selected':'')+'>'+min+'</option>';
			});
		});
	$("#slcHr").html(opcion);
	$("#slcMin").html(opcion2);
	 $( "#slcHr" ).change(function(){
		 opcion2='';
		 $.each(arrFechas[$("#slcHr").val()], function( index2, min ) {
				opcion2+='<option value="'+min+'">'+min+'</option>';
			});
		 $("#slcMin").html(opcion2);
});
}

function verHorarios(){
	var sucursal= $("#hdnSucursal").val();
	var consulta = $("#hdnConsulta").val();
	var consultorio = $("#slcConsultorio").val().trim();
	 duracion = $("#slcDuracion").val().trim();
	var fecha = $("#hdnFecha").val();
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
				arrFechas=JSON.parse(data);
				opcion='',opcion2='', b=true;
				$.each(arrFechas, function( index, arr ) {
					opcion+='<option value="'+index+'">'+index+'</option>';
					if(b){
						b=false;
						$.each(arr, function( index2, min ) {
							opcion2+='<option value="'+min+'">'+min+'</option>';
						});
					}
					});
				$("#slcHr").html(opcion);
				$("#slcMin").html(opcion2);
			}
		});
	
}

function visualizar(v){
	if(v=='si')
		$( "#divGuardar" ).show();
	else
		$( "#divGuardar" ).hide();
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