$(document).ready(function(){
	iniciar();
});

function consultaDatos(){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				tiposConsulta:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				$( "#slcConsulta" ).html(respuesta);
				cargarServicios();
			}
		});
		 
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				sucursales:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				$( "#slcSucursal" ).html(respuesta);
				$( "#slcSucursal" ).append("<option value='0'>Todas</option>");
			}
		});}


function iniciar(){
	
	consultaDatos();
		
	$('.numeric').numeric({negative : false});
	
		$('#txtFecha').datepicker({
			yearRange: 'c-10:c',
			changeMonth : true,
			changeYear : true,
			maxDate : '0D'
		});
	
	$( "#slcSucursal" ).change(function(){
   	 mostrarCabinas();
	});
    
    
    $( "#slcConsulta" ).change(function(){
      	 mostrarCabinas();
   	   });
    
    $( "#slcConsulta" ).change(function(){
		 cargarServicios();
	 });

	
    $("#btnBuscar").click(function(){
    	buscarPaciente();
	});
	
}


function mostrarCabinas(){
	$("#slcConsultorio").html('<option value=""></option>');
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	
	if ( sucursal != "" && consulta!= "") {
		$.ajax({
			method : "post",
			url : "adminFunciones.php",

			data : {
				Sucursal:sucursal,
				Consulta:consulta,
			},
			success : function(data) {
				$("#slcConsultorio").html(data);
			}
		});
	
	}else{
		$("#slcConsultorio").html('<option value=""></option>');
	}
}

function buscarPaciente(){
	var existeError = false;
	var nombre = $("#txtNombre").val();
	var apellido = $("#txtApellidos").val();
	var edad = $("#txtEdad").val();
	var telefono = $("#txtTelMovil").val();
	var sexo='';
	$("input[name=sexo]").each(function (index) { 
	       if($(this).is(':checked')){
	    	   sexo = $(this).val();
	       }
	    });
	    
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	var fecha = $("#txtFecha").val().trim();
	var consultorio = $("#slcConsultorio").val().trim();
	var servicio = $("#txtServicio").val();
	var cita='si';
	var estatus= $("#slcEstatus").val().trim();
	
	if ( consulta =="" && consultorio =="" && servicio=="") 
		cita = 'no';
		
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				sucursalP:sucursal,
				consultaP:consulta,
				cabinaP:consultorio,
				fechaRegistroP:fecha,
				servicioP:servicio,
				nombreP:nombre,
				apellidosP:apellido,
				edadP:edad,
				telP: telefono,
				sexoP:sexo,
				citaP:cita,
				estatusP:estatus
			},
			success : function(data) {
				respuesta=JSON.parse(data);
//			alert(data);
				xajax_verTabla(respuesta);
			}
		});
	
}

function cargarServicios(){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idConsulta_:$("#slcConsulta").val().trim()
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				 $( "#txtServicio" ).autocomplete({
				        source: respuesta
				      });
				      
			}
		});
}

function verPaciente(id){
	xajax_verPaciente(id);
}
function editarPaciente(id){
	xajax_editarPaciente(id);
}

function verCita(id){
	xajax_verCita(id);
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