$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$("#btnFranquicia").click(function (){
		$("#formulario").show();
		$('html,body').animate({
		    scrollTop: $("#divFormulario").offset().top
		}, 2000);
	});
}
	//$("#").();