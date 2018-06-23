$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	/*$(".numeric").keyup(function (){
		 this.value = (this.value + '').replace(/[^0-9]/g, '');
		});*/
	$('.numeric').numeric({negative : false});
	
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		maxDate : '0D'
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
}

function altaPaciente(){
	var existeError = false;
	var datos={},paciente={},hoja={};
	
    
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
		existeError = true;
		console.log("Error: txTelCasa");
	}
	paciente['TelMovil']= $("#txtTelMovil").val().trim();
	if (paciente['TelMovil'] == "") {
		existeError = true;
		console.log("Error: txTelMovil");
	}
	
	paciente['Email']= $("#txtCorreo").val().trim();
	if (paciente['Email'] == "") {
		existeError = true;
		console.log("Error: txtEmail");
	}
	
	paciente['Edad']= $("#txtEdad").val().trim();
	if (paciente['Edad'] == "") {
		existeError = true;
		console.log("Error: txtEdad");
	}
	
	paciente['ocupacion']= $("#txtOcupacion").val().trim();
	if (paciente['ocupacion'] == "") {
		existeError = true;
		console.log("Error: ocupacion");
	}
	
	paciente['fechaNac']= $("#txtFecha").val().trim();
	if (paciente['fechaNac'] == "") {
		existeError = true;
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
	
    
    hoja['cirugias'] = '';
    $("input[name=cirugias]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['cirugias'] = $(this).val();
       }
    });
    if (hoja['cirugias'] == "") {
		existeError = true;
		console.log("Error: txt");
	}
    if (hoja['cirugias'] == "Si") {
	    hoja['cirugia']= $("#txtCirugias").val().trim();
		if (hoja['cirugia'] == "") {
			existeError = true;
			console.log("Error: cirugia");
		}
    }	
    hoja['enfermedades']= $("#txtEnfermedades").val().trim();
	if (hoja['enfermedades'] == "") {
		existeError = true;
		console.log("Error: enfermedades");
	}
	
	hoja['estrenimiento'] = '';
    $("input[name=estrenimiento]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['estrenimiento'] = $(this).val();
       }
    });
    if (hoja['estrenimiento'] == "") {
		existeError = true;
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
		existeError = true;
		console.log("Error: menstrual");
	}
    
    hoja['alergia'] = '';
    $("input[name=alergia]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['alergia'] = $(this).val();
       }
    });
    if (hoja['alergia'] == "") {
		existeError = true;
		console.log("Error: alergia");
	}
    
    if (hoja['alergia'] == "Si") {
    	hoja['alergias']= $("#txtAlergias").val().trim();
    	if (hoja['alergias'] == "") {
    		existeError = true;
    		console.log("Error: alergias");
    	}
    }
    
    hoja['hrsDormir']= $("#txtDormir").val().trim();
	if (hoja['hrsDormir'] == "") {
		existeError = true;
		console.log("Error: hrsDormir");
	}
	
	hoja['hrsComida']= $("#txtComida").val().trim();
	if (hoja['hrsComida'] == "") {
		existeError = true;
		console.log("Error: hrsComida");
	}
	
	hoja['cafe'] = '';
    $("input[name=cafe]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['cafe'] = $(this).val();
       }
    });
    if (hoja['cafe'] == "") {
		existeError = true;
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
		existeError = true;
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
		existeError = true;
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
    			console.log("Error: fumaF");
    		}
    }
    
    hoja['desagradable']= $("#txtDesagradable").val().trim();
	if (hoja['desagradable'] == "") {
		existeError = true;
		console.log("Error: Desagradable");
	}
	
	hoja['ansiedad'] = '';
    $("input[name=ansiedad]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['ansiedad'] = $(this).val();
       }
    });
    if (hoja['ansiedad'] == "") {
		existeError = true;
		console.log("Error: ansiedad");
	}
    
    hoja['actividadFisica'] = '';
    $("input[name=actividadFisica]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['actividadFisica'] = $(this).val();
       }
    });
    if (hoja['actividadFisica'] == "") {
		existeError = true;
		console.log("Error: actividadFisica");
	}
    
    if (hoja['actividadFisica'] == "Si") {
    	hoja['actividad']= $("#txtActividad").val().trim();
    	if (hoja['actividad'] == "") {
    		existeError = true;
    		console.log("Error: actividad");
    	}
    	
    	hoja['tiempo']= $("#txtTiempo").val().trim();
    	if (hoja['tiempo'] == "") {
    		existeError = true;
    		console.log("Error: tiempo");
    	}
    	
    	hoja['tiempoActividad'] = '';
        $("input[name=actividadTiempo]").each(function (index) { 
           if($(this).is(':checked')){
        	   hoja['tiempoActividad'] = $(this).val();
           }
        });
        if (hoja['tiempoActividad'] == "") {
    		existeError = true;
    		console.log("Error: tiempoActividad");
    	}
    }
    
    hoja['motivacion']= $("#slcMotivacion").val().trim();
	if (hoja['motivacion'] == "") {
		existeError = true;
		console.log("Error: motivacion");
	}
	
	hoja['hrLevantar']= $("#slcHrLevantar").val().trim();
	if (hoja['hrLevantar'] == "") {
		existeError = true;
		console.log("Error: hrLevantar");
	}
	
	hoja['hrAcostar']= $("#slcHrAcostar").val().trim();
	if (hoja['hrAcostar'] == "") {
		existeError = true;
		console.log("Error: hrAcostar");
	}
	
	hoja['hrEjercicio']= $("#slcHrEjercicio").val().trim();
	if (hoja['hrEjercicio'] == "") {
		existeError = true;
		console.log("Error: hrEjercicio");
	}
	
	hoja['desayunoF'] = '';
    $("input[name=desayunoF]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja['desayunoF'] = $(this).val();
       }
    });
    if (hoja['desayunoF'] == "") {
		existeError = true;
		console.log("Error: desayunoF");
	}
    
    if (hoja['desayunoF'] == "Si") {
	    hoja['hrDesayuno']= $("#slcHrDesayuno").val().trim();
		if (hoja['hrDesayuno'] == "") {
			existeError = true;
			console.log("Error: hrDesayuno");
		}
		
		hoja['desayuno']= $("#txtDesayuno").val().trim();
		if (hoja['desayuno'] == "") {
			existeError = true;
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
		existeError = true;
		console.log("Error: colacionF");
	}
    
    if (hoja['colacionF'] == "Si") {
	    hoja['hrColacion1']= $("#slcHrColacion1").val().trim();
		if (hoja['hrColacion1'] == "") {
			existeError = true;
			console.log("Error: hrColacion1");
		}
		
		hoja['colacion1']= $("#txtColacion1").val().trim();
		if (hoja['colacion1'] == "") {
			existeError = true;
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
		existeError = true;
		console.log("Error: comidaF");
	}
    
    if (hoja['comidaF'] == "Si") {
	  hoja['hrComida']= $("#slcHrComida").val().trim();
		if (hoja['hrComida'] == "") {
			existeError = true;
			console.log("Error: hrComida");
		}
		
		hoja['comida']= $("#txtComida").val().trim();
		if (hoja['comida'] == "") {
			existeError = true;
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
		existeError = true;
		console.log("Error: colacion2F");
	}
    
    if (hoja['colacion2F'] == "Si") {
	  hoja['hrColacion2']= $("#slcHrColacion2").val().trim();
		if (hoja['hrColacion2'] == "") {
			existeError = true;
			console.log("Error: hrColacion2");
		}
		
		hoja['colacion2']= $("#txtColacion2").val().trim();
		if (hoja['colacion2'] == "") {
			existeError = true;
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
		existeError = true;
		console.log("Error: cenaF");
	}
    
    if (hoja['cenaF'] == "Si") {
	     hoja['hrCena']= $("#slcHrCena").val().trim();
		if (hoja['hrCena'] == "") {
			existeError = true;
			console.log("Error: hrCena");
		}
		
		hoja['cena']= $("#txtCena").val().trim();
		if (hoja['cena'] == "") {
			existeError = true;
			console.log("Error: cena");
		}
    }
	/*
	hoja['']= $("#txt").val().trim();
	if (hoja[''] == "") {
		existeError = true;
		console.log("Error: ");
	}
	
	hoja[''] = '';
    $("input[name=]").each(function (index) { 
       if($(this).is(':checked')){
    	   hoja[''] = $(this).val();
       }
    });
    if (hoja[''] == "") {
		existeError = true;
		console.log("Error: ");
	}
	*/
    
	
	
	datos['hojaclinica']=hoja;
	datos['paciente']=paciente;
	
//	alert(JSON.stringify(datos));
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaaci&oacute;n.', 3);
	xajax_guardar(JSON.stringify(datos));
}

function limpiarDatos(){
	$("#txtNombre").val('');
	$("#txtApellidos").val('');
	
	$("#txtTelCasa").val('');
	$("#txtTelMovil").val('');
	$("#txtCorreo").val('');
	
	$("#txtEdad").val('');
	
}
//var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');     	 
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);
