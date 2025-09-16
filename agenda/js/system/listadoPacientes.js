$(document).ready(function(){
	iniciar();
	});
	 
var arrSucursal=[]; 

function iniciar(){
	setTimeout(function() {
		listarPacientes(); 
		 $('#slcSucursalBar option').each(function() {
			 arrSucursal.push($(this).text());
		 });
		 console.log(arrSucursal);
	},400);
	
		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					sucursalBar:''
				},
				success : function(data) {
					$( "#slcSucursal" ).html(data);
				}
			});
		 

		 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					sucursalFranquicia:''
				},
				success : function(data) {
					$( "#slcSucursalFranquicia" ).html(data);
				}
			});
	$( "#slcSucursalFranquicia" ).change(listarPacientes);


}

function listarPacientes(){
/*	nsucursal=$( "#hdnSucursal" ).val();
	if (nsucursal=='')
	*/	

	mostrarMsjEspera("Espere un momento, se est&aacute; cargando la informaci&oacute;n...",5);
	nsucursal=$( "#slcSucursalFranquicia" ).val();
	nsucursal='';

	setTimeout(function() {
			    $.ajax({
			        url: 'getListadoPacientes.php?sucursal='+nsucursal+' ',
					type: 'GET',
			        dataType: 'json',
					success: function(data) {
			            var tabla = $('#pacientesTBody'); 
						tabla.empty(); 

			            $.each(data, function(index, item) {
						if(item.fechaProxima!=null)
							arrFechaProxima= item.fechaProxima.split("-");
						arrFecha= item.fecha.split("-");
			                var fila = $('<tr>');
			                fila.append($('<td >').html(item.nombreP + (nsucursal==''?('<br /> ['+item.sucursal+']'):'')));
			                fila.append($('<td>').text(item.telefonoCel));
			                fila.append($('<td>').text(item.completitud));
							fila.append($('<td>').text(arrFecha[2]+"/"+arrFecha[1]+"/"+arrFecha[0]));
							fila.append($('<td>').text(item.consultasHechas));
							fila.append($('<td>').text(item.consultasProximas));
//							fila.append($('<td>').text(item.consultasProximas));
							fila.append($('<td>').html(item.fechaProxima!=null?("<a onClick='verCita("+item.cita+")'> <img src='images/editaCita.png' title='"+arrFechaProxima[2]+" de "+obtenMes(parseInt(arrFechaProxima[1])-1)+" del "+arrFechaProxima[0]+"' style='width: 30px' /></a>"):'-'));
							      html="<a onClick='verPaciente("+item.idPaciente+")'><img src='images/ver.png' title='Ver' style='width: 30px' /></a>"+
							"<a onClick='editarPaciente("+item.idPaciente+")'><img src='images/editPaciente.png' title='editar' style='width: 30px' /></a>";
							if(parseInt(item.consultasProximas )>0)
							    html+="<a onClick='mostrarCitas("+item.idPaciente+")'> <img src='images/citas.png' style='width: 30px' /></a>";
							else if($.inArray(item.sucursal,arrSucursal)>0||$("#hdnRol").val()==1||$("#hdnIdUsuario").val()==43||$("#hdnIdUsuario").val()==52)
								html+="<a onClick='eliminarPaciente("+item.idPaciente+")'> <img src='images/eliminaPaciente.png' style='width: 30px' /></a>";
							html+="<a onClick='verSeg("+item.idPaciente+")'> <img src='images/folder.png' style='width: 30px' /></a>";
							fila.append($('<td>').html(html));
		//					fila.append($('<td>').text());
			                tabla.append(fila);
						                    
			            });
						new DataTable('#myTable');

			        },
			        error: function(error) {
			            console.error("Error al cargar los datos:", error);
			        }
			    });
	},50);
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

function verSeg(id){
	xajax_seguimiento(id);
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
						},1000);
						
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

function estiloTabla(sucursal){
	$('#tablesorting-1').tablesorter({
  		theme          : "bootstrap", // this will 
  		widthFixed     : true,
  		headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
  		widgets        : [ "uitheme", "filter", "zebra" ],
      serverSideSorting : true,
  		widgetOptions  : {
  			zebra : ["even", "odd"],
  			filter_reset : ".reset",
  		}
  	}).tablesorterPager({
            serverSideSorting : true,
            ajaxUrl:   'getListadoPacientes.php?page={page}&size={size}&{sortList:col}&{filterList:filter}&sucursal='+sucursal+' ',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
           //   $("#tablesorting-1").trigger("update");
              $(table).find('tbody').empty();

                if (ajax) {
                    $.each(ajax[1], function (i, item) {
                    	if(item.fechaProxima!=null)
                    		arrFechaProxima= item.fechaProxima.split("-");
                    	arrFecha= item.fecha.split("-");
                          var html = "<td>" + item.nombreP + ($( "#slcSucursalFranquicia" ).val()==''?('<br /> ['+item.sucursal+']'):'')+"</td>" +
                            "<td>" + item.telefonoCel + "</td>" +
                            "<td>" + item.completitud + "%</td>" +
                            "<td>" + arrFecha[2]+"/"+arrFecha[1]+"/"+arrFecha[0]+ "</td>" +
                            "<td>" + item.consultasHechas + "</td>" +
                            "<td>" + item.consultasProximas + "</td>" +
                            "<td>" ;
                          if(item.fechaProxima!=null)
                            html+="<a onClick='verCita("+item.cita+")'> <img src='images/editaCita.png' title='"+arrFechaProxima[2]+" de "+obtenMes(parseInt(arrFechaProxima[1])-1)+" del "+arrFechaProxima[0]+"' style='width: 30px' /></a>";
                            
                          html+="</td><td><a onClick='verPaciente("+item.idPaciente+")'><img src='images/ver.png' title='Ver' style='width: 30px' /></a>"+
                    "<a onClick='editarPaciente("+item.idPaciente+")'><img src='images/editPaciente.png' title='editar' style='width: 30px' /></a>";
                    if(parseInt(item.consultasProximas )>0)
                        html+="<a onClick='mostrarCitas("+item.idPaciente+")'> <img src='images/citas.png' style='width: 30px' /></a>";
                    else if($.inArray(item.sucursal,arrSucursal)>0||$("#hdnRol").val()==1||$("#hdnIdUsuario").val()==43||$("#hdnIdUsuario").val()==52)
                    	html+="<a onClick='eliminarPaciente("+item.idPaciente+")'> <img src='images/eliminaPaciente.png' style='width: 30px' /></a>";
                          		"</td>";
                    html+="<a onClick='verSeg("+item.idPaciente+")'> <img src='images/folder.png' style='width: 30px' /></a>";
                          		"</td>";
                        $("<tr/>").html(html).appendTo(table);
                    });
                    return [ajax[0]];                        
        			
                }                
            },
            container: $(".pager"),
            cssGoto: $(".pagenum"),
            cssPageSize: $(".pagesize"),
            cssPageDisplay: $(".pagedisplay"),
            removeRows: false,
            output: '{startRow} - {endRow} | {totalRows}',
            savePages: false,
            fixedHeight: true
        });
 
}
var arrFecha,arrFechaProx;
function obtenMes(numMes){
    var MESES=  new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    return MESES[''+numMes];
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