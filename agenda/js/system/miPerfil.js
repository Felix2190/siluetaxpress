$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$('.numeric').numeric({negative : false});
	
	$("#btnEditar").click(function(){
		$('.definido').hide();
		$('.editar').show();
	});
	
	$("#btnGuardar").click(function(){
///		$('.editar').hide();
//		$('.definido').show();
		guardarCambios();
	});
	
	$("#fileToUpload").change(subirImagen);
}

function subirImagen(){
	var rand = Math.floor((Math.random()*10000)+999);
	  var formData = new FormData();
	var inputFileImage = document.getElementById('fileToUpload');
	  var file = inputFileImage.files[0];
	//obtenemos el nombre del archivo
      var fileName = file.name;
      //obtenemos la extensión del archivo
      ext = fileName.substring(fileName.lastIndexOf('.') + 1);
      //obtenemos el tamaño del archivo
      var tam = file.size;
      //obtenemos el tipo de archivo image/png ejemplo
      var fileType = file.type;
      
      if(!isImage(ext)){
      	mostrarMsjError('El archivo '+fileName+' no es una imagen ',3);
      	$('#fileToUpload').val('');
      	return false;
      }
      
      if(tam>(1024*1024)){
      	mostrarMsjError('El tama&ntilde; m&aacute;ximo a subir es de 2MB',3);
      	$('#fileToUpload').val('');
      	return false;
      }

	if(file!=undefined){
	  formData.append('imagen',file);
	  formData.append('id',rand);
	$.ajax({
	      url: 'adminFunciones.php',  
	      type: 'POST',
	      data: formData,
	      cache: false,
	      contentType: false,	
	      processData: false,
	      success: function(data){
	    	  if(data!=''){
	    		  $('#imgFoto').removeAttr('src');
	  			$('#imgFoto').attr('src',data);
	  			$('#hdnFoto').val(data);
	  			//$("#divFoto").html('<img  src="'+ data +'" height: "280px">');
	    	  }else{
	    		  mostrarMsjError('Ocurri&oacute; un problema al subir la imagen',3);
	    	  }
	      }
	  });
	}
}

function guardarCambios(){
	var existeError = false;
	var datos={};
    
	 datos['foto']= $("#hdnFoto").val();
	 datos['telefono']= $("#txtTelefono").val();
	 if (datos['telefono'] == "") {
		existeError = true;
		console.log("Error: telefono");
	}else{
		if(datos['telefono'].length<10){
			mostrarMsjError('El n&uacute; telef&oacute;nico debe contener 10 d&iacute;gitos ',3);
			return false;
		}
	}
	
	datos['Email']= $("#txtCorreo").val();
	if (datos['Email'] == "") {
		existeError = true;
		console.log("Error: txtEmail");
	}else{
		if(!validarEmail(datos['Email'])){
			mostrarMsjError('El formato del correo electr&oacute;nico es incorrecto ',3);
			return false;
		}
	}
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 2);
		
	xajax_guardar(JSON.stringify(datos));
	

}

function isImage(extension){
    switch(extension.toLowerCase()){
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}

function validarEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
	//$("#").();
//var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');     	 
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);
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