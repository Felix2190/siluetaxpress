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
		if(window.location!="nuevaCita.php"&&window.location!="altaPaciente.php"){
			var url=window.location.href;
			
			url=url.split("/");
//			alert(url[url.length-1]);
			$.ajax({
				method : "post",
				url : "redireccionar.php",
				data : {
					url:url[url.length-1]
				},
				success : function(data) {
	//				alert(data);
					window.location="redireccionar.php";
				}
			});

		}
			//window.location=window.location;
		},306000);
	
	setTimeout(function() {
		mostrarMsjEspera("En un minuto, esta p&aacute;gina se actualizar&aacute;...",12);	
	},200000);
	
	
	setTimeout(function() { mostrarMsjEspera("En breve, esta p&aacute;gina se actualizar&aacute;...",15);
	},280600);
	
});