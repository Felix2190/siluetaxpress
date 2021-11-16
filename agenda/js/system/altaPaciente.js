$(document).ready(function(){
	iniciar();
});
	 var peso,estatura,imc;
function iniciar(){
	/*$(".numeric").keyup(function (){
		 this.value = (this.value + '').replace(/[^0-9]/g, '');
		});*/
	$('.numeric').numeric({negative : false});
/*	$(".imc").keyup(function(){
		peso = $("#txtPesoInicial").val();
		estatura = $("#txtEstatura").val();
		if(peso!=""&&estatura!=""){
			imc=peso/(estatura*estatura);
			$("#txtIMC").val(imc.toFixed(3));
		}else
			$("#txtIMC").val('');
	});
	*/
/*
	$.datepicker.setDefaults($.datepicker.regional['es-MX']);;
	$('#txtFecha').datepicker({
		yearRange: 'c-100:c',
		changeMonth : true,
		changeYear : true,
		minDate : '-120Y',
		maxDate : '0D'
	});
	*/

	$("input[name=datos]").click(function(){
		if($(this).val()=="Completo"){
			 $('#divCompleto').show();
			 $('#divMinimo').hide();
		}else{
			$('#divMinimo').show();
			$('#divCompleto').hide();
			 $.ajax({
					method : "post",
					url : "adminFunciones.php",
					data : {
						sucursales:''
					},
					success : function(data) {
						respuesta=JSON.parse(data);
						$( "#slcSucursal2" ).html(respuesta);
					}
				});
		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					medios:''
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					$( "#slcMedio2" ).html(respuesta);
				}
			});
			
			$("#slcMedio2").change(function(){
				if($( "#slcMedio2" ).val()=="6"){
					 $('.otromedio').show();
				}else{
					$('.otromedio').hide();
				}
			});
		}
	});
	
	
	$("#slcMedio").change(function(){
		if($( "#slcMedio" ).val()=="6"){
			 $('.otromedio').show();
		}else{
			$('.otromedio').hide();
		}
	});
	
	$("input[name=cirugias]").click(function(){
		if($(this).val()=="Si"){
			 $('.divCirugia').show();
		}else{
			$('.divCirugia').hide();
		}
	});

	$("input[name=estrenimiento]").click(function(){
		if($(this).val()=="Si"){
			 $('.divEstren').show();
		}else{
			$('.divEstren').hide();
		}
	});

	$("input[name=alergia]").click(function(){
		if($(this).val()=="Si"){
			 $('.divAlergia').show();
		}else{
			$('.divAlergia').hide();
		}
	});

	$("input[name=fuma]").click(function(){
		if($(this).val()=="Si"){
			 $('.divFuma').show();
		}else{
			$('.divFuma').hide();
		}
	});

	$("input[name=cafe]").click(function(){
		if($(this).val()=="Si"){
			 $('.divCafe').show();
		}else{
			$('.divCafe').hide();
		}
	});

	$("input[name=bebidas]").click(function(){
		if($(this).val()=="Si"){
			 $('.divBebidas').show();
		}else{
			$('.divBebidas').hide();
		}
	});

	$("input[name=actividadFisica]").click(function(){
		if($(this).val()=="Si"){
			 $('.divActividad').show();
		}else{
			$('.divActividad').hide();
		}
	});
	
	$("input[name=desayunoF]").click(function(){
		if($(this).val()=="Si"){
			 $('.divDesayuno').show();
		}else{
			$('.divDesayuno').hide();
		}
	});
	
	$("input[name=colacionF]").click(function(){
		if($(this).val()=="Si"){
			 $('.divColacion1').show();
		}else{
			$('.divColacion1').hide();
		}
	});
	
	$("input[name=comidaF]").click(function(){
		if($(this).val()=="Si"){
			 $('.divComida').show();
		}else{
			$('.divComida').hide();
		}
	});

	$("input[name=colacion2F]").click(function(){
		if($(this).val()=="Si"){
			 $('.divColacion2').show();
		}else{
			$('.divColacion2').hide();
		}
	});
	
	$("input[name=cenaF]").click(function(){
		if($(this).val()=="Si"){
			 $('.divCena').show();
		}else{
			$('.divCena').hide();
		}
	});
	
	 if($("#hdnRol").val()==1)
		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					sucursales:''
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					$( "#slcSucursal" ).html(respuesta);
					$( "#slcSucursal2" ).html(respuesta);
				}
			});
		
		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					medios:''
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					$( "#slcMedio" ).html(respuesta);
					$( "#slcMedio2" ).html(respuesta);
				}
			});

	/*
	$("input[name=]").click(function(){
		if($(this).val()=="Si"){
			 $('.div').show();
		}else{
			$('.div').hide();
		}
	});
	*/
	$("#btnGuardar").click(altaPaciente);
	$("#btnGuardar2").click(altaPaciente2);
}

function altaPaciente(){
	var existeError2 = false,existeError = false;
	var datos={},paciente={},hoja={};
	var faltan=0;

	 paciente['Nombre']= $("#txtNombre").val().trim();
	if (paciente['Nombre'] == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}

	paciente['Apellidos']= $("#txtApellidos").val().trim();
	if (paciente['Apellidos'] == "") {
		existeError = true;
		console.log("Error: txtApellido");
	}
	
	
	paciente['TelCasa']= $("#txtTelCasa").val().trim();
	if (paciente['TelCasa'] == "") {
		//existeError2 = true;
		console.log("Error: txTelCasa");
	}
	paciente['TelMovil']= $("#txtTelMovil").val().trim();
	if (paciente['TelMovil'] == "") {
//		existeError = true;
		console.log("Error: txTelMovil");
	}
	
	paciente['Edad']= $("#txtEdad").val().trim();
	if (paciente['Edad'] == "") {
		existeError = true;
		console.log("Error: txtEdad");
	}
	
	paciente['ocupacion']= $("#txtOcupacion").val().trim();
	if (paciente['ocupacion'] == "") {
	//	existeError = true;
		console.log("Error: ocupacion");
	}
	
	paciente['fechaNac']= $("#txtFecha").val().trim();
	if (paciente['fechaNac'] == "") {
//		existeError = true;
		paciente['fechaNac']="1900-01-01"
		console.log("Error: fechaNac");
	}
	
	paciente['sexo'] = '';
    $("input[name=sexo]").each(function (index) { 
       if($(this).is(':checked')){
    	   paciente['sexo'] = $(this).val();
       }
    });
    
    if (paciente['sexo'] == "") {
		existeError = true;
		console.log("Error: txt");
	}
    
    paciente['sucursal']= $("#slcSucursal").val().trim();
    if ( paciente['sucursal'] == "") {
		existeError = true;
		console.log("Error: sucursal");
	}
	
    hoja['pesoHabitual']= $("#txtPesoHabitual").val().trim();
	if (hoja['pesoHabitual'] == "") {
		hoja['pesoHabitual']=0;
		faltan++;
		console.log("Error: txtPesoHabitual");
	}
	hoja['pesoIdeal']= $("#txtPesoIdeal").val().trim();
	if (hoja['pesoIdeal'] == "") {
		faltan++;
		hoja['pesoIdeal']=0;
		console.log("Error: txtPesoIdeal");
	}
	/*
	hoja['pesoInicial']= $("#txtPesoInicial").val().trim();
	if (hoja['pesoInicial'] == "") {
		hoja['pesoInicial']=0;
		console.log("Error: txtpesoInicial");
	}
*/
		
	hoja['Estatura']= $("#txtEstatura").val().trim();
	if (hoja['Estatura'] == "") {
		hoja['Estatura']=0;
		console.log("Error: txtEstatura");
	}
	/*
	var errorIMC=false;
	if ((hoja['Estatura'] != 0&&hoja['pesoInicial'] == 0)||(hoja['Estatura'] == 0&&hoja['pesoInicial'] != 0))
		errorIMC=true;
	
	hoja['IMC']= $("#txtIMC").val().trim();
	if (hoja['IMC'] == "")
		hoja['IMC']=0;
	
	*/
    hoja['cirugias'] = '';
    $("input[name=cirugias]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['cirugias'] = $(this).val();
       }
    });
    if (hoja['cirugias'] == "") {
		existeError2 = true;
		faltan+=2;
		console.log("Error: txt");
	}
    if (hoja['cirugias'] == "Si") {
	    hoja['cirugia']= $("#txtCirugias").val().trim();
		if (hoja['cirugia'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: cirugia");
		}
    }	
    hoja['enfermedades']= $("#txtEnfermedades").val().trim();
	if (hoja['enfermedades'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: enfermedades");
	}
	
	hoja['estrenimiento'] = '';
    $("input[name=estrenimiento]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['estrenimiento'] = $(this).val();
       }
    });
    if (hoja['estrenimiento'] == "") {
		existeError2 = true;
		faltan+=2;
		console.log("Error: estrenimiento");
	}
	
    if (hoja['estrenimiento'] == "Si") {
	    hoja['estrenimientoF'] = '';
	    $("input[name=estrenimientoF]").each(function (index) { 
	       if($(this).is(':checked')){
	    	   hoja['estrenimientoF'] = $(this).val();
	       }
	    });
	    if (hoja['estrenimientoF'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: estrenimientoF");
		}
    }
    
    hoja['menstrual'] = '';
    $("input[name=menstrual]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['menstrual'] = $(this).val();
       }
    });
    if (hoja['menstrual'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: menstrual");
	}
    
    hoja['alergia'] = '';
    $("input[name=alergia]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['alergia'] = $(this).val();
       }
    });
    if (hoja['alergia'] == "") {
		existeError2 = true;
		faltan+=2;
		console.log("Error: alergia");
	}
    
    if (hoja['alergia'] == "Si") {
    	hoja['alergias']= $("#txtAlergias").val().trim();
    	if (hoja['alergias'] == "") {
    		existeError = true;
    		faltan++;
    		console.log("Error: alergias");
    	}
    }
    
    hoja['hrsDormir']= $("#txtDormir").val().trim();
	if (hoja['hrsDormir'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: hrsDormir");
	}
	
	hoja['hrsComida']= $("#txtComida").val();
	if (hoja['hrsComida'] == "") {
		faltan++;
		existeError2 = true;
		console.log("Error: hrsComida");
	}
	
	hoja['cafe'] = '';
    $("input[name=cafe]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['cafe'] = $(this).val();
       }
    });
    if (hoja['cafe'] == "") {
		existeError2 = true;
		faltan+=2;
		console.log("Error: cafe");
	}
    if (hoja['cafe'] == "Si") {
    	$("input[name=cafeF]").each(function (index) { 
    	       if($(this).is(':checked')){
    	    	   hoja['cafeF'] = $(this).val();
    	       }
    	    });
    	    if (hoja['cafeF'] == "") {
    			existeError = true;
    			faltan++;
    			console.log("Error: cafeF");
    		}
    }
    
    
    hoja['bebidas'] = '';
    $("input[name=bebidas]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['bebidas'] = $(this).val();
       }
    });
    if (hoja['bebidas'] == "") {
		existeError2 = true;
		faltan+=2;
		console.log("Error: bebidas");
	}
    if (hoja['bebidas'] == "Si") {
    	$("input[name=bebidasF]").each(function (index) { 
    	       if($(this).is(':checked')){
    	    	   hoja['bebidasF'] = $(this).val();
    	       }
    	    });
    	    if (hoja['bebidasF'] == "") {
    			existeError = true;
    			faltan++;
    			console.log("Error: bebidasF");
    		}
    }
    
    
    hoja['fuma'] = '';
    $("input[name=fuma]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['fuma'] = $(this).val();
       }
    });
    if (hoja['fuma'] == "") {
		existeError2 = true;
		faltan+=2;
		console.log("Error: fuma");
	}
    if (hoja['fuma'] == "Si") {
    	$("input[name=fumaF]").each(function (index) { 
    	       if($(this).is(':checked')){
    	    	   hoja['fumaF'] = $(this).val();
    	       }
    	    });
    	    if (hoja['fumaF'] == "") {
    			existeError = true;
    			faltan++;
    			console.log("Error: fumaF");
    		}
    }
    
    hoja['desagradable']= $("#txtDesagradable").val().trim();
	if (hoja['desagradable'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: Desagradable");
	}
	
	hoja['ansiedad'] = '';
    $("input[name=ansiedad]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['ansiedad'] = $(this).val();
       }
    });
    if (hoja['ansiedad'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: ansiedad");
	}
    
    hoja['actividadFisica'] = '';
    $("input[name=actividadFisica]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['actividadFisica'] = $(this).val();
       }
    });
    if (hoja['actividadFisica'] == "") {
		existeError2 = true;
		faltan+=4;
		console.log("Error: actividadFisica");
	}
    
    if (hoja['actividadFisica'] == "Si") {
    	hoja['actividad']= $("#txtActividad").val().trim();
    	if (hoja['actividad'] == "") {
    		existeError = true;
    		faltan++;
    		console.log("Error: actividad");
    	}
    	
    	hoja['tiempo']= $("#txtTiempo").val().trim();
    	if (hoja['tiempo'] == "") {
    		existeError = true;
    		faltan++;
    		console.log("Error: tiempo");
    	}
    	
    	hoja['tiempoSimbolo']= $("#slcTiempo").val().trim();
    	
    	hoja['tiempoActividad'] = '';
        $("input[name=actividadTiempo]").each(function (index) { 
           if($(this).is(':checked')){
        	   hoja['tiempoActividad'] = $(this).val();
           }
        });
        if (hoja['tiempoActividad'] == "") {
    		existeError = true;
    		faltan++;
    		console.log("Error: tiempoActividad");
    	}
    }
    
    hoja['motivacion']= $("#slcMotivacion").val().trim();
	if (hoja['motivacion'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: motivacion");
	}
	
	hoja['hrLevantar']= $("#slcHrLevantarH").val()+":"+$("#slcHrLevantarM").val()+$("#slcHrLevantar_").val();
	if (hoja['hrLevantar'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: hrLevantar");
	}
	
	hoja['hrAcostar']= $("#slcHrAcostarH").val()+":"+$("#slcHrAcostarM").val()+$("#slcHrAcostar_").val();
	if (hoja['hrAcostar'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: hrAcostar");
	}
	
	hoja['hrEjercicio']= $("#slcHrEjercicioH").val()+":"+$("#slcHrEjercicioM").val()+$("#slcHrEjercicio_").val();
	if (hoja['hrEjercicio'] == "") {
		existeError2 = true;
		faltan++;
		console.log("Error: hrEjercicio");
	}
	
	hoja['desayunoF'] = '';
    $("input[name=desayunoF]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['desayunoF'] = $(this).val();
       }
    });
    if (hoja['desayunoF'] == "") {
		existeError2 = true;
		faltan+=3;
		console.log("Error: desayunoF");
	}
    
    if (hoja['desayunoF'] == "Si") {
	    hoja['hrDesayuno']= $("#slcHrDesayunoH").val()+":"+$("#slcHrDesayunoM").val()+$("#slcHrDesayuno_").val();
		if (hoja['hrDesayuno'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: hrDesayuno");
		}
		
		hoja['desayuno']= $("#txtDesayuno").val().trim();
		if (hoja['desayuno'] == "") {
			existeError2 = true;
			faltan++;
			console.log("Error: desayuno");
		}
    }
    
    hoja['colacionF'] = '';
    $("input[name=colacionF]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['colacionF'] = $(this).val();
       }
    });
    if (hoja['colacionF'] == "") {
		existeError2 = true;
		faltan+=3;
		console.log("Error: colacionF");
	}
    
    if (hoja['colacionF'] == "Si") {
	    hoja['hrColacion1']= $("#slcHrColacion1H").val()+":"+$("#slcHrColacion1M").val()+$("#slcHrColacion1_").val();
		if (hoja['hrColacion1'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: hrColacion1");
		}
		
		hoja['colacion1']= $("#txtColacion1").val().trim();
		if (hoja['colacion1'] == "") {
			existeError2 = true;
			console.log("Error: colacion1");
		}
    }
    
    
    hoja['comidaF'] = '';
    $("input[name=comidaF]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['comidaF'] = $(this).val();
       }
    });
    if (hoja['comidaF'] == "") {
		existeError2 = true;
		faltan+=3;
		console.log("Error: comidaF");
	}
    
    if (hoja['comidaF'] == "Si") {
	  hoja['hrComida']= $("#slcHrComidaH").val()+":"+$("#slcHrComidaM").val()+$("#slcHrComida_").val();
		if (hoja['hrComida'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: hrComida");
		}
		
		hoja['comida']= $("#txtComidaPM").val().trim();
		if (hoja['comida'] == "") {
			existeError2 = true;
			faltan++;
			console.log("Error: comida");
		}
    }

    hoja['colacion2F'] = '';
    $("input[name=colacion2F]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['colacion2F'] = $(this).val();
       }
    });
    if (hoja['colacion2F'] == "") {
		existeError2 = true;
		faltan+=3;
		console.log("Error: colacion2F");
	}
    
    if (hoja['colacion2F'] == "Si") {
	  hoja['hrColacion2']= $("#slcHrColacion2H").val()+":"+$("#slcHrColacion2M").val()+$("#slcHrColacion2_").val();
		if (hoja['hrColacion2'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: hrColacion2");
		}
		
		hoja['colacion2']= $("#txtColacion2").val().trim();
		if (hoja['colacion2'] == "") {
			existeError2 = true;
			console.log("Error: colacion2");
		}
    }
    
    hoja['cenaF'] = '';
    $("input[name=cenaF]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['cenaF'] = $(this).val();
       }
    });
    if (hoja['cenaF'] == "") {
		existeError2 = true;
		faltan+=3;
		console.log("Error: cenaF");
	}
    
    if (hoja['cenaF'] == "Si") {
	     hoja['hrCena']= $("#slcHrCenaH").val()+":"+$("#slcHrCenaM").val()+$("#slcHrCena_").val();
		if (hoja['hrCena'] == "") {
			existeError = true;
			faltan++;
			console.log("Error: hrCena");
		}
		
		hoja['cena']= $("#txtCena").val().trim();
		if (hoja['cena'] == "") {
			existeError2 = true;
			faltan++;
			console.log("Error: cena");
		}
    }
    
    hoja['Observaciones']= $("#txtObservaciones").val().trim();
	if (hoja['Observaciones'] == "") {
		console.log("Error: txtObservaciones");
	}
	
	hoja['Tratamiento']= $("#txtTratamientoA").val().trim();
	if (hoja['Tratamiento'] == "") {
		faltan++;
		console.log("Error: txtTratamiento");
	}
	hoja['Antecedentes']= $("#txtAntecedentes").val().trim();
	if (hoja['Antecedentes'] == "") {
		faltan++;
		console.log("Error: txtAntecedentes");
	}
	
	 paciente['idMedio']= $("#slcMedio").val().trim();
	if (paciente['idMedio'] == "") {
		existeError = true;
		console.log("Error: idMedio");
	}else {
		if(parseInt(paciente['idMedio'])==6){
			 paciente['otroMedio']= $("#txtOtroMedio").val().trim();
			if (paciente['otroMedio'] == "") {
				existeError = true;
				console.log("Error: otroMedio");
			}
		}
	}
	/*
	hoja['']= $("#txt").val().trim();
	if (hoja[''] == "") {
		existeError2 = true;
		console.log("Error: ");
	}
	
	hoja[''] = '';
    $("input[name=]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja[''] = $(this).val();
       }
    });
    if (hoja[''] == "") {
		existeError2 = true;
		console.log("Error: ");
	}
	*/
    
    paciente['Email']= $("#txtCorreo").val().trim();
	if (paciente['Email'] == "") {
		//existeError2 = true;
		console.log("Error: txtEmail");
	}else{
		if(!validarEmail(paciente['Email'])){
			mostrarMsjError('El formato del correo electr&oacute;nico es incorrecto ',3);
			return false;
		}
	}
	
	if (paciente['TelMovil'] != "") {
		if (paciente['TelMovil'].length<10) {
			mostrarMsjError('El n&uacute;mero telef&oacute;nico es incorrecto ',3);
			return false;
		}
	}else{
		paciente['TelMovil'] == "NINGUNO";
	}
	
	var completitud=100-((100/45)*faltan);
	hoja['completitud']=Number(completitud.toFixed(2));
	datos['hojaclinica']=hoja;
	datos['paciente']=paciente;
	
//	alert(JSON.stringify(datos));
/*	if(errorIMC){
		mostrarMsjError("Datos incompletos para el registro de seguimiento.");
		return false;;
	}
	*/
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
	xajax_guardar(JSON.stringify(datos));
}

function altaPaciente2(){
	var existeError2 = false,existeError = false;
	var datos={},paciente={},hoja={};
	var faltan=0;
    
	 paciente['Nombre']= $("#txtNombre2").val().trim();
	if (paciente['Nombre'] == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}

	paciente['Apellidos']= $("#txtApellidos2").val().trim();
	if (paciente['Apellidos'] == "") {
		console.log("Error: txtApellido");
	}
	
	paciente['TelMovil']= $("#txtTelMovil2").val().trim();
	if (paciente['TelMovil'] == "") {
//		existeError = true;
		console.log("Error: txTelMovil");
	}
	
	
	paciente['sexo'] = '';
    $("input[name=sexo2]").each(function (index) { 
       if($(this).is(':checked')){
    	   paciente['sexo'] = $(this).val();
       }
    });
    
    if (paciente['sexo'] == "") {
		existeError = true;
		console.log("Error: txt");
	}
    
    paciente['sucursal']= $("#slcSucursal2").val().trim();
    if ( paciente['sucursal'] == "") {
		existeError = true;
		console.log("Error: sucursal");
	}

    paciente['Email']= $("#txtCorreo2").val().trim();
	if (paciente['Email'] == "") {
		//existeError2 = true;
		console.log("Error: txtEmail");
	}else{
		if(!validarEmail(paciente['Email'])){
			mostrarMsjError('El formato del correo electr&oacute;nico es incorrecto ',3);
			return false;
		}
	}

	if (paciente['TelMovil'] != "") {
		if (paciente['TelMovil'].length<10) {
			mostrarMsjError('El n&uacute;mero telef&oacute;nico es incorrecto ',3);
			return false;
		}
	}else{
		paciente['TelMovil'] == "NINGUNO";
	}

	paciente['fechaNac']="1900-01-01"
	
	
	 paciente['idMedio']= $("#slcMedio2").val().trim();
	if (paciente['idMedio'] == "") {
		existeError = true;
		console.log("Error: idMedio");
	}else {
		if(parseInt(paciente['idMedio'])==6){
			 paciente['otroMedio']= $("#txtOtroMedio").val().trim();
			if (paciente['otroMedio'] == "") {
				existeError = true;
				console.log("Error: otroMedio");
			}
		}
	}
		
	hoja['completitud']=0;
	datos['paciente']=paciente;
	datos['hojaclinica']=hoja;
		
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
	xajax_guardar2(JSON.stringify(datos));
}

function limpiarDatos(){
	$("#txtNombre").val('');
	$("#txtApellidos").val('');
	
	$("#txtTelCasa").val('');
	$("#txtTelMovil").val('');
	$("#txtCorreo").val('');
	
	$("#txtEdad").val('');
	
}

function validarEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}

//var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');     	 
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);
