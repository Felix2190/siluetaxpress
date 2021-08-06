$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$("#btnGuardar").click(guardar);
}

function guardar(){
	mostrarMsjEspera("Espere un momento");
	var promociones=[];
	for (let i = 1; i <= 10; i++) {
		promociones[$("#hd"+i).val()] =	$("#txtPromocion"+i).val().trim();
		if(promociones[$("#hd"+i).val()]==""){
			mostrarMsjError("Debe de ingresar todas las promociones");
			return ;
		} 
	}
	xajax_actualizar(promociones);
	console.log(promociones);
}