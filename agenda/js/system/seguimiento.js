$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$('.numeric').numeric({negative : false});
	$("#btnGuardar").click(guardar);
	$(".imc").keyup(function(){
		peso = $("#txtPeso").val();
		estatura = $("#txtEstatura").val();
		if(peso!=""&&estatura!=""){
			imc=peso/(estatura*estatura);
			$("#txtIMC").val(imc.toFixed(3));
		}else
			$("#txtIMC").val('');
	});
	
}
var peso,estatura,imc;
function guardar(){
	var existeError = false;
	var datos={};
	datos['idPaciente']= $("#idPaciente").val();
	
	datos['Peso']= $("#txtPeso").val();
	if (datos['Peso'] == "") {
		existeError = true;
		console.log("Error: txtPeso");
	}
	datos['Estatura']= $("#txtEstatura").val();
	if (datos['Estatura'] == "") {
		existeError = true;
		console.log("Error: txtEstatura");
	}
	datos['IMC']= $("#txtIMC").val();
	if (datos['IMC'] == "") {
		existeError = true;
		console.log("Error: txtIMC");
	}
	datos['Talle']= $("#txtTalle").val();
	if (datos['Talle'] == "") {
		existeError = true;
		console.log("Error: txtTalle");
	}
	datos['Pecho']= $("#txtPecho").val();
	if (datos['Pecho'] == "") {
		existeError = true;
		console.log("Error: txtPecho");
	}
	datos['Cintura']= $("#txtCintura").val();
	if (datos['Cintura'] == "") {
		existeError = true;
		console.log("Error: txtCintura");
	}
	datos['Abdomen']= $("#txtAbdomen").val();
	if (datos['Abdomen'] == "") {
		existeError = true;
		console.log("Error: txtAbdomen");
	}
	datos['Cadera']= $("#txtCadera").val();
	if (datos['Cadera'] == "") {
		existeError = true;
		console.log("Error: txtCadera");
	}
	datos['Sintomass']= $("#txtSintomas").val();
	datos['Dieta']= $("#txtDieta").val();
	datos['Tratamiento']= $("#txtTratamiento").val();

	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
	xajax_guardar(JSON.stringify(datos));
	
}
	//$("#").(); 
/*
     $.ajax(
      {
      	method:"post",
					url: "adminFunciones.php",  					
					data: 
					{  						
					},
					
					success: function(data) 
					{
  					respuesta=JSON.parse(data);
					}
	    });

 
 */