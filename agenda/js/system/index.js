$(document).ready(function(){
	
	iniciar();
});
	 
function iniciar(){
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		minDate : '0D'
	});

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
						$( "#slcSucursal" ).change(actualizaResumen);
					}
				});
		
		
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				consultaCredito:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				if(respuesta[0]==true){
					var credito=parseInt(respuesta[1])
					if(700>credito&credito<900)
						mostrarMsjEspera("S&oacute;lo restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas!!",6);
					if(500>credito&credito<700)
						mostrarMsjEspera("S&oacute;lo restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas!!",8);
					if(400>credito&credito<500)
						mostrarMsjError("S&oacute;lo restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas!!",10);
					if(0>credito&credito<400)
						mostrarMsjError("S&oacute;lo restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas!",15);
					
				}
			}
		});
		
	}else{
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				consultaCredito:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				if(respuesta[0]==true){
					var credito=parseInt(respuesta[1])
					if(700>credito&credito<900)
						mostrarMsjEspera("Restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas. Comun&iacute;cate con Lezlie.",6);
					if(500>credito&credito<700)
						mostrarMsjEspera("Restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas. Comun&iacute;cate con Lezlie.",8);
					if(400>credito&credito<500)
						mostrarMsjError("Restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas. Comun&iacute;cate con Lezlie.",10);
					if(0>credito&credito<400)
						mostrarMsjError("Restan "+respuesta[1]+" de saldo para el env&iacute;o de confirmaci&oacute;n de citas. Comun&iacute;cate con Lezlie.",15);
				
				}
			}
		});
		
	}
	
	$( "#txtFecha" ).change(actualizaResumen);
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
	setTimeout(function() { 
		setInterval(function() 
				{ 
			actualizaResumen();
			},120000)
		},2000);
	
var tiempo=300000,sesiont=0,min=60000;
		setInterval(function() 
				{ 
			sesiont+=min;
			$( "#ptiempo" ).html('Tiempo restante: '+(parseInt(tiempo-sesiont)/min)+' min.');
			},60000);

	//cerrar sesi�n
	setTimeout(function() { 
		window.location="logout.php";
	},300000);
	setTimeout(function() {
		mostrarMsjEspera("En breve se cerrar&aacute; la sesi&oacute;n actual, realice una acci&oacute;n para cancelar el cierre",20);	
	},280000);
	
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
				xajax_verGraficas(respuesta,nsucursal);
			}
		});
}


function verCita(idCita){
	presionado=true;
	xajax_verCita(idCita);
}