$(document).ready(function(){
	iniciar2();
});
var txtEncuesta,recepcion;
function iniciar2(){
		$('.numeric').numeric({negative : false});
	
	$("#btnBuscar").click(function (){
		txtEncuesta= $("#txtEncuesta").val().trim();
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
				$( "#siluetaExpress" ).html(respuesta[2]);
				recepcion=respuesta[3];
				if(recepcion==1){
					$( "#divRecepcion" ).show();
					$( "#divPersonalRecepcion" ).html(respuesta[4]);
				}
				
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
	
	
	$("#btnEnviar").click(enviarEncuesta);

}

function enviarEncuesta(){
	$("#btnEnviar").hide();
	var personal,evalua,personalR=0,evaluaR=0;
	$("input[name=personal]").each(function (index) { 
	       if($(this).is(':checked')){
	    	   personal = $(this).val();
	       }
	    });
	    if (personal == "") {
			mostrarMsjError("Debe seleccionar una persona");
			$("#btnEnviar").show();
			return false;
		}
	$("input[name=evalua]").each(function (index) { 
	       if($(this).is(':checked')){
	    	   evalua = $(this).val();
	       }
	    });
	    if (evalua == "") {
			mostrarMsjError("Debe seleccionar una evaluaci&oacute;n");
			$("#btnEnviar").show();
			return false;
		}
		
	if(recepcion==1){
		$("input[name=recepcion]").each(function (index) { 
	       if($(this).is(':checked')){
	    	   personalR = $(this).val();
	       }
	    });
	    if (personalR == "") {
			mostrarMsjError("Debe seleccionar una persona");
			$("#btnEnviar").show();
			return false;
		}
	$("input[name=evaluaR]").each(function (index) { 
	       if($(this).is(':checked')){
	    	   evaluaR = $(this).val();
	       }
	    });
	    if (evaluaR == "") {
			mostrarMsjError("Debe seleccionar una evaluaci&oacute;n");
			$("#btnEnviar").show();
			return false;
		}
	
	}
	
	mostrarMsjEspera("Espere un momento...")
	let opinion = $("#txtOpinion").val().trim();
	
	xajax_guardar(txtEncuesta,personal,evalua,opinion,personalR,evaluaR);
	$("#btnEnviar").show();
	
}