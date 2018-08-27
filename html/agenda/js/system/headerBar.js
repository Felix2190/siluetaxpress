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
   
});