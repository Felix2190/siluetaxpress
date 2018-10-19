$(document).ready(function(){


	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			sucursalBar:''
		},
		success : function(data) {
			$( "#slcSucursalBar" ).html(data);
		}
	});
	
	$( "#slcSucursalBar" ).change(function(){
		mostrarMsjEspera('Espere un momento...', 2);
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				actualizaSucursal:$( "#slcSucursalBar" ).val()
			},
			success : function(data) {
				if(data=="true")
					window.location=window.location;
			}
		});
	});
	

	$( "#calendarioLila" ).datepickerLila({
		inline: true
	});
   

	setTimeout(function() { 
		if(window.location!="nuevaCita.php"&&window.location!="altaPaciente.php")
			window.location=window.location;
		},300000);
	
});