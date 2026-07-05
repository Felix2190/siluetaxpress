$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		maxDate : '0D'
	});
	
	consultaCitas();
	$( "#txtFecha" ).change(consultaCitas);
	$( "#btnEncuesta" ).click(enviarLinkEncuesta);
}
var listCitas;
function consultaCitas(){
	$("#divCitas").hide();
	listCitas=[];
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				fechaCita:$("#txtFecha").val()
			},
			success : function(data) {
				info=JSON.parse(data);
				if(info[0]==1){
					$("#divCitas").show();
					listCitas=info[1];
					xajax_mostrarCitas(info[1]);
					$("#btnEncuesta").show();

				}else
					mostrarMsjError('No se encontraron citas!',5);

			}
		});
}

function enviarLinkEncuesta(){
	$("#btnEncuesta").hide();
	idCitasLink = [];
	$('input[name="checkCitas"]:checked').each(function () {
	    idCitasLink.push(this.value);
	});
	if(idCitasLink.length>0)
		xajax_enviarLinkEncuesta(idCitasLink,listCitas);
	else
		mostrarMsjError('No se seleccionaron citas!',5);
}

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}
