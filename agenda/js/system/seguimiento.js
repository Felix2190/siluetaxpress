$(document).ready(function(){
	iniciar();
});
var idSeg=0, arrProductos=[];	 

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
	$("#btnAgregar").click(agregarProducto);
	 $( "#btnImprimir" ).click(function(){
//			grafLinea=myLine.toBase64Image();
		grafLinea['imc']=myLine['chart-area2'].toBase64Image();
		grafLinea['peso']=myLine['chart-area'].toBase64Image();
			xajax_verPDF(grafLinea['peso'],grafLinea['imc']);

		 });
		 
	$(".imc").keyup(function(){
		peso = $("#txtPeso").val();
		estatura=parseFloat($("#dtEstatura").val());
		if(estatura==0)
			estatura = $("#txtEstatura").val();
		if(peso!=""&&estatura!=""){
			imc=peso/(estatura*estatura);
			$("#txtIMC").val(imc.toFixed(3));
		}else
			$("#txtIMC").val('');
	});
	cargarProductos();
	verListado();
}

var peso,estatura,imc,grafLinea=[];

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
	datos['idSeg']=idSeg;
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
	
	datos['Estatura']= parseFloat($("#dtEstatura").val());
	if(datos['Estatura']==0){
		datos['Estatura']= $("#txtEstatura").val();
		if (datos['Estatura'] == "" || datos['Estatura'] == 0) {
			existeError = true;
			console.log("Error: txtEstatura");
		}
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
	datos['Pierna']= $("#txtPierna").val();
	if (datos['Pierna'] == "") {
		datos['Pierna']=0;
		console.log("Error: txtPierna");
	}
	datos['Musculo']= $("#txtMusculo").val();
	if (datos['Musculo'] == "") {
		datos['Musculo']=0;
		console.log("Error: txtMusculo");
	}
	datos['Grasa']= $("#txtGrasa").val();
	if (datos['Grasa'] == "") {
		datos['Grasa']=0;
		console.log("Error: txtGrasa");
	}
	datos['FC']= $("#txtFC").val();
	if (datos['FC'] == "") {
		datos['FC']=0;
		console.log("Error: txtFC");
	}
	datos['PA']= $("#txtPA").val();
	if (datos['PA'] == "") {
		datos['PA']=0;
		console.log("Error: txtPA");
	}
	datos['Sintomas']= $("#txtSintomas").val();
	datos['Dieta']= $("#txtDieta").val();
	datos['Tratamiento']= $("#txtTratamiento").val();
	
	var arrSeg = [];
	var i = 0;
	$('.checkSeg:checked').each(function() {
		arrSeg[i] = $(this).val();
		i++;
	});
//	limpiarTxt();
	datos['SintomasArr']=arrSeg
	datos['Productos'] = arrProductos;
	if(existeError){
		$("#btnGuardar").show();
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
	xajax_guardar(JSON.stringify(datos));
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
	$("#txtPierna").val('');
	$("#txtMusculo").val('');
	$("#txtGrasa").val('');
	$("#txtFC").val('');
	$("#txtPA").val('');
	$('.checkSeg:checked').each(function() {
		$(this).prop("checked",false);
	});
	$("#tbodyProducto").html('');
	arrProductos.length=0;
  	$('#divTablaP').hide();
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
				informacion=JSON.parse(data);
				info=informacion['nota'];
				productos = informacion['productos'];
				$("#divInfoSeg").show()
				$("#dtPeso").html(info['pesoKg']);
				$("#dt_Estatura").html($("#dtEstatura").val());
				$("#dtIMC").html(info['IMC']);
				$("#dtTalle").html(info['talla']);
				$("#dtPecho").html(info['pecho']);
				$("#dtCintura").html(info['cintura']);
				$("#dtAbdomen").html(info['abdomen']);
				$("#dtCadera").html(info['cadera']);
				$("#dtDieta").html(info['dieta']);
				$("#dtTratamiento").html(info['tratamiento']);
				$("#dtNombre").html(info['nombreCom']);
				$("#dtSucursal").html(info['sucursal']);
				$("#dtFecha").html(info['fecha']);
				$("#dtPierna").html(info['pierna']);
				$("#dtMusculo").html(info['musculo']);
				$("#dtGrasa").html(info['grasa']);
				$("#dtFC").html(info['fc']);
				$("#dtPA").html(info['pa']);
				
				auxArrProductos=[],arrAuxSintomas=[];
				
				if(info['estrenimiento']==1)
					arrAuxSintomas.push('estre&ntilde;imiento');
				if(info['cansancio']==1)
					arrAuxSintomas.push('cansancio');
				if(info['sueno']==1)
					arrAuxSintomas.push('sue&ntilde;o');
				if(info['mareo']==1)
					arrAuxSintomas.push('mareo');
				if(info['nausea']==1)
					arrAuxSintomas.push('nausea');
				if(info['bocaSeca']==1)
					arrAuxSintomas.push('bocaSeca');
				
				$("#dtSintomas").html(arrAuxSintomas.join(', '));
				if(info['otrosSintomas']!='')
					$("#dtSintomas").append(', '+info['otrosSintomas']);
				
				$.each(productos, function( idProducto, txtProducto ) {
					auxArrProductos.push(txtProducto);
				});
				$("#dtProductos").html(auxArrProductos.join(', '));
				
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
		$("#divBtnHoja").show();
	}else{
		
	}
}


function cargarProductos(){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				txtProductos:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				 $( "#txtProductos" ).autocomplete({
				        source: respuesta
				      });
				      
			}
		});
}

function agregarProducto(){
	  var tamano = $('.row_tabla').length, txtProducto=$( "#txtProductos" ).val();

	 if(txtProducto!='')
	   $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				agregaProducto:txtProducto
			},
			success : function(idProducto) {
		       if(arrProductos.indexOf(idProducto) == -1){
		   	  	$('#divTablaP').show();

		         var fila='<tr class="row_tabla" id="fila'+tamano+'">'+
					'<td colspan="4">'+
					'<input type="hidden" id="idP'+tamano+'" value="'+idProducto+'" />'+txtProducto+'</td>'+
					'<td><a onClick="quitar_producto('+tamano+','+idProducto+');"> <img src="images/eliminaProducto.png" style="width: 15px" /></a></td>'+
				'</tr>';
				 $('#tbodyProducto').append(fila);
				 $('#txtProductos').val('');
				 arrProductos.push(idProducto);
				 cargarProductos();
			   }
			}
		});
}

function eliminaProductoArray ( item ) {
    var i = arrProductos.indexOf( item+"" );
    if ( i != -1 ) {
    	arrProductos.splice( i, 1 );
    }
}

function quitar_producto(pos,id){
	  $('#fila'+pos).remove();
	  if($('.row_tabla').length==0){
	  	$('#divTablaP').hide();
	  	
	  }
	  eliminaProductoArray ( id)
}        

function editar(idS){
	idSeg=idS;
	var tamano , fila;
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSeguimiento: idS
			},
			success : function(data) {
				informacion=JSON.parse(data);
				info=informacion['nota'];
				productos = informacion['productos'];
				$("#divReg").show();
				$("#txtPeso").val(info['pesoKg']);
				$("#txtEstatura").val(info['estatura']);
				$("#txtIMC").val(info['IMC']);
				$("#txtTalle").val(info['talla']);
				$("#txtPecho").val(info['pecho']);
				$("#txtCintura").val(info['cintura']);
				$("#txtAbdomen").val(info['abdomen']);
				$("#txtCadera").val(info['cadera']);
				$("#txtSintomas").val(info['sintomas']);
				$("#txtDieta").val(info['dieta']);
				$("#txtTratamiento").val(info['tratamiento']);
				$("#txtNombre").val(info['nombreCom']);
				$("#txtSucursal").val(info['sucursal']);
				$("#txtFecha").val(info['fecha2']);
				$("#txtPierna").val(info['pierna']);
				$("#txtMusculo").val(info['musculo']);
				$("#txtGrasa").val(info['grasa']);
				$("#txtPA").val(info['pa']);
				$("#txtFC").val(info['fc']);
				if(info['estrenimiento']==1)
					$("#checkEstrenimiento").prop("checked",true);
				if(info['cansancio']==1)
					$("#checkEstrenimiento").prop("checked",true);
				if(info['sueno']==1)
					$("#checkSueno").prop("checked",true);
				if(info['mareo']==1)
					$("#checkMareo").prop("checked",true);
				if(info['nausea']==1)
					$("#checkNausea").prop("checked",true);
				if(info['bocaSeca']==1)
					$("#checkBoca").prop("checked",true);
				
				$.each(productos, function( idProducto, txtProducto ) {
					$('#divTablaP').show();
			   	 tamano = $('.row_tabla').length;
			      fila='<tr class="row_tabla" id="fila'+tamano+'">'+
						'<td colspan="4">'+
						'<input type="hidden" id="idP'+tamano+'" value="'+idProducto+'" />'+txtProducto+'</td>'+
						'<td><a onClick="quitar_producto('+tamano+','+idProducto+');"> <img src="images/eliminaProducto.png" style="width: 15px" /></a></td>'+
					'</tr>';
					 $('#tbodyProducto').append(fila);
					 $('#txtProductos').val('');
					 arrProductos.push(idProducto);
				});
				
				$('html,body').animate({
				    scrollTop: $("#divReg").offset().top
				}, 2000);
				regAvance=true;
			
			}
		});
}

function editarPaciente(id){
	xajax_editarPaciente(id);
}

