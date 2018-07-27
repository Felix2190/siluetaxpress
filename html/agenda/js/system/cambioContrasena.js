$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$("#btnActualizar").click(cambioPassword);
}

function cambioPassword(){

	if($("#txtPasswordNuevo").val()==""||$("#txtPasswordNuevo2").val()==""||$("#txtPassword").val()=="")
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',3);
	else
	 $.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			password:$("#txtPassword").val(),
		},

		success : function(data) {
			if(data=='true'){
			if($("#txtPasswordNuevo").val()==$("#txtPasswordNuevo2").val())
				$.ajax({
					method : "post",
					url : "adminFunciones.php",
					data : {
						passwordNuevo:$("#txtPasswordNuevo").val(),
					},

					success : function(data) {
						if(data=='true'){
							mostrarMsjEspera('Ha actualizado correctamente su contrase&ntilde;a', 3);
						}else
							mostrarMsjError('No se pudo actualizar su contrase&ntilde;a, int&eacute;ntelo m&aacute;s tarde',3);
						
						$("#txtPasswordNuevo").val("");
						$("#txtPasswordNuevo2").val("");
						$("#txtPassword").val("");
							
					}
			});
				else{
					mostrarMsjError('Las contrase&ntilde;as nuevas no coinciden',3);
					$("#txtPasswordNuevo").val("");
					$("#txtPasswordNuevo2").val("");
					$("#txtPassword").val("");
				}
			}
			else{
				mostrarMsjError('Ha ingresado mal su contrase&ntilde;a anterior',3);
				$("#txtPassword").val("");
			}
			
		}
	});
	
}
	// $("#").();
// var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');
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