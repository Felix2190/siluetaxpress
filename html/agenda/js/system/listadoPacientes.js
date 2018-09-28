$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	setTimeout(function() {
		listarPacientes(); 
	},700);
	
	if($("#hdnRol").val()==1){
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
	 }
	$( "#slcSucursal" ).change(listarPacientes);
}

function listarPacientes(){
	var nsucursal=$( "#hdnSucursal" ).val();
	if (nsucursal=='')
		nsucursal=$( "#slcSucursal" ).val();

	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			listadoPacientes:nsucursal
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			xajax_verTabla(respuesta,nsucursal);
		}
	});

}

function verPaciente(id){
	xajax_verPaciente(id);
}
function editarPaciente(id){
	xajax_editarPaciente(id);
}

function verCita(id){
	xajax_verCita(id);
}


function eliminarPaciente(id){
	//alert(idCita);
	confirmacion("Elimina a paciente", "Escribe su contrase&ntilde;a para continuar", id);
}

function mostrarCitas(idCita){
	xajax_mostrarCitas(idCita);
}

function confirmacion(titulo, texto, id, divAlerta){
    alertify.prompt( titulo, texto, ''
    , function(evt,password) {
    	if(password=='789'){
    	 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					eliminarPaciente:id
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					if(respuesta[0]=='true'){
						mostrarMsjExito('Se ha eliminado correctamente al paciente!!',3);
						setTimeout(function() {
							listarPacientes(); 
						},2000);
						
					}else{
						mostrarMsjError('Ocurri&oacute; un error!! <br />'+respuesta[1]+', int&eacute;ntelo mas tarde',5);
					}
				}
			});
    	}else{
			//el password es incorrecto
			mostrarMsjError('La contrase&ntilde;a es incorrecta!. ',2);
		}

    }
    , function() { 
    }).set('modal', true).set('closable',false);

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