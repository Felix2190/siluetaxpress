$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					listadoVerifica:''
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					xajax_mostrarTabla(respuesta);
				}
			});
}


function asistencia(idCita,e,num){
		$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			idCitaVerifica:idCita,estatus:e
		},
		success : function(data) {
			iniciar();
			if(e=="false"){
//				console.log(JSON.parse(data));
				window.location.href="https://web.whatsapp.com/send?phone=52"+num+"&text="+JSON.parse(data);
			}
		}
	});

}