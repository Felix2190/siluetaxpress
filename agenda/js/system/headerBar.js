var idCitaV,numV;
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
	

	setTimeout(function() {
		setInterval(function(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			sucursalVerificaAsistencia:$( "#slcSucursalBar" ).val()
			
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			if(!$.isEmptyObject(respuesta)){
				idCitaV=respuesta['idCita'];
				numV=respuesta['telefono'];
					$( "#msjVerifica" ).show();
					$( "#divVerifica" ).html("&iquest;"+respuesta['nombre_paciente']+" asisti&oacute; a su cita en cabina "+respuesta['cabina']+"?");
			}
		}	
	});
		},7500);
	},2906);

		 $( "#btnSiVerifica" ).click(function(){
			asistencia(true);
		 });
		 
		 $( "#btnNoVerifica" ).click(function(){
			asistencia(false);			 
		 });
		 
		 $( "#btnCerrarVerifica" ).click(function(){
			 $( "#msjVerifica" ).hide();
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
	

	$( "#calendarioVerde" ).datepickerVerde({
		inline: true
	});
   
	setTimeout(function() {
	 url=url.split("/");
		url=url[url.length-1];
		
		if(url!="nuevaCita.php"&&url!="altaPaciente.php"&&url!="editarPaciente.php"&&url!="index.php"&&url!="seguimiento.php"){
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
		},320000);
	setTimeout(function() {
		url=url.split("/");
		url=url[url.length-1];
		
		if(url!="nuevaCita.php"&&url!="altaPaciente.php"&&url!="editarPaciente.php"&&url!="index.php"&&url!="seguimiento.php")
				mostrarMsjEspera("En 15 segundos se direccionar&aacute; a la p&aacute;gina principal.",14);	
	},305000);
	
	setTimeout(function() {
		url=url.split("/");
		url=url[url.length-1];
		
		$.ajax({
			method : "post",
			url : "redireccionar.php",
			data : {
				url:url
			},
			success : function(data) {
			}
		});
		
	},1200);
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

function asistencia(e){
		$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			idCitaVerifica:idCitaV,estatus:e
		},
		success : function(data) {
			$( "#msjVerifica" ).hide();
				window.open("https://web.whatsapp.com/send?phone=52"+numV+"&text="+JSON.parse(data), "_blank");
}
	});

}
	