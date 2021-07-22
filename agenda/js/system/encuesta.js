$(document).ready(function(){
	iniciar2();
});
	 
function iniciar2(){
		$('.numeric').numeric({negative : false});
	
	$("#btnBuscar").click(function (){
		var txtEncuesta= $("#txtEncuesta").val().trim();
		if (txtEncuesta == "") {
			mostrarMsjError('Debe introducir el ID de la encuesta que recibi&oacute; en su whatsapp!!',5);
		}else{
		
			$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			idEncuesta:txtEncuesta
		},

		success : function(data) {
			respuesta=JSON.parse(data);
			console.log(respuesta);
			if(respuesta[0]==1){
				$( "#divPersonal" ).html(respuesta[1]);
				$( "#divEncuesta" ).show();
				$( "#txtEncuesta" ).attr("readonly",true);
				$( "#btnBuscar" ).hide();
				$('html,body').animate({
				    scrollTop: $("#divEncuesta").offset().top
				}, 2000);
			}else{
				mostrarMsjError(respuesta[1],5);
			}
		}
	});
	
/*		$("#formulario").show();
		
*/		}
	});
	
	
	//$("#btnEnviar").click(altaFranquicia);

}
