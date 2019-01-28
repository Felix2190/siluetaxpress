$(document).ready(function(){
	var url=window.location.href;

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
	 url=url.split("/");
		url=url[url.length-1];
		
		if(url!="nuevaCita.php"&&url!="altaPaciente.php"&&url!="editarPaciente.php"&&url!="index.php"){
//			alert(url[url.length-1]);
			$.ajax({
				method : "post",
				url : "redireccionar.php",
				data : {
					url:url
				},
				success : function(data) {
					console.log(data);
					window.location="index.php";
				}
			});

		}
			//window.location=window.location;
		},180000);
	setTimeout(function() {
		url=url.split("/");
		url=url[url.length-1];
		
		if(url!="nuevaCita.php"&&url!="altaPaciente.php"&&url!="editarPaciente.php"&&url!="index.php")
				mostrarMsjEspera("En 15 segundos se direccionar&aacute; a la p&aacute;gina principal.",14);	
	},165000);
	/*
	setTimeout(function() {
		url=url.split("/");
		url=url[url.length-1];
		
		if(url!="nuevaCita.php"&&url!="altaPaciente.php")	
			mostrarMsjEspera("En un minuto, esta p&aacute;gina se actualizar&aacute;...",12);	
	},200000);
	
	
	setTimeout(function() {
		setInterval(function(){
				url=url.split("/");
				url=url[url.length-1];
		
				if(url!="nuevaCita.php"&&url!="altaPaciente.php"){
					mostrarMsjEspera("En breve, esta p&aacute;gina se actualizar&aacute;...",12);
					setTimeout(function() {
						window.location="redireccionar.php";
					},30000);
				}
		},35000);
	},290600);
	*/
});
	