$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		maxDate : '0D',
			beforeShowDay: function(date) {
			    var day = date.getDay();
			    return [(day != 0), ''];
			}
	});
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
	verListado();
}

var peso,estatura,imc;

function verListado(){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idPacienteSeguimiento:$("#idPaciente").val()
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				if(respuesta['total']>0){
					$("#divTabla").show()
					xajax_mostrarTabla(respuesta['info']);
				}else{
					$("#divTabla").hide()
					mostrarMsjError("A&uacute;n no existen notas de seguimientos",3);
				}
			}
		});
}

function guardar(){
	$("#btnGuardar").hide();
	var existeError = false;
	var datos={};
	datos['idPaciente']= $("#idPaciente").val();
	
	datos['Fecha']= $("#txtFecha").val();
	if (datos['Fecha'] == "") {
		existeError = true;
		console.log("Error: txtFecha");
	}
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
	datos['Sintomas']= $("#txtSintomas").val();
	datos['Dieta']= $("#txtDieta").val();
	datos['Tratamiento']= $("#txtTratamiento").val();

	if(existeError){
		$("#btnGuardar").show();
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
	xajax_guardar(JSON.stringify(datos));
//	limpiarTxt();
}
var regAvance=false;
function visualizacion(){
	if(regAvance){
		$("#divReg").hide();
		regAvance=false;
	}else{
		$("#divReg").show();
		regAvance=true;
	}
}

function limpiarTxt(){
	$("#btnGuardar").show();
	$("#txtPeso").val('');
	$("#txtEstatura").val('');
	$("#txtIMC").val('');
	$("#txtTalle").val('');
	$("#txtPecho").val('');
	$("#txtCintura").val('');
	$("#txtAbdomen").val('');
	$("#txtCadera").val('');
	$("#txtSintomas").val('');
	$("#txtDieta").val('');
	$("#txtTratamiento").val('');
	$("#divReg").hide();
	regAvance=false;
}

function verDetalle(idSeg){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSeguimiento: idSeg
			},
			success : function(data) {
				info=JSON.parse(data);
				$("#divInfoSeg").show()
				$("#dtPeso").html(info['pesoKg']);
				$("#dtEstatura").html(info['estatura']);
				$("#dtIMC").html(info['IMC']);
				$("#dtTalle").html(info['talla']);
				$("#dtPecho").html(info['pecho']);
				$("#dtCintura").html(info['cintura']);
				$("#dtAbdomen").html(info['abdomen']);
				$("#dtCadera").html(info['cadera']);
				$("#dtSintomas").html(info['sintomas']);
				$("#dtDieta").html(info['dieta']);
				$("#dtTratamiento").html(info['tratamiento']);
				$("#dtNombre").html(info['nombreCom']);
				$("#dtSucursal").html(info['sucursal']);
				$("#dtFecha").html(info['fecha']);
				$('html,body').animate({
				    scrollTop: $("#divInfoSeg").offset().top
				}, 2000);
			
			}
		});
}

var iniciarGraf =function (grafica,t1,grafica2,t2) {
	var subGraf = [];
	var x=120;
	$("#misgraficas").hide();
	if (grafica[1] > 0) {
		var graficar = new GraficarChart('chart-area', 'grafPay', 'legend',
				x+((t1-1)*40), 250, grafica);
		var graficar = new GraficarChart('chart-area2', 'grafPay2', 'legend2',
				x+((t2-1)*40), 250, grafica2);
		$("#misgraficas").show();
	}else{
		
	}
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