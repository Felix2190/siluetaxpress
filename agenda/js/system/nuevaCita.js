$(document).ready(function(){
	iniciar();
});
var bandera=true;

function consultaDatos(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			pacientes:''
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			$( "#slcPaciente" ).html(respuesta);
		}
	});
	

	if($( "#hdnPredefinida" ).val()=='true')
		mostrarMsjEspera('Espere un momento... recuperando informaci&oacute;n.', 3);
	 
	 if($("#hdnRol").val()==1)
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				sucursalCitaNueva:''
			},
			success : function(data) {
//				respuesta=JSON.parse(data);
				$( "#slcSucursal" ).html(data);
				if($( "#hdnPredefinida" ).val()=='true'){
					$( "#slcSucursal" ).val($( "#hdnSucursal" ).val());
					setTimeout(function() {
						mostrarCabinas();
					},1500);
				}
				
			}
		});
		
	
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				tiposConsulta:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				$( "#slcConsulta" ).html(respuesta);
				setTimeout(function() {
					mostrarCabinas();
				},1500);
				if($( "#hdnPredefinida" ).val()=='true'){
					$( "#slcConsulta" ).val($( "#hdnConsulta" ).val());
					cargarServicios();
				}
			}
		});
		 
	 $( "#slcDuracion" ).change(verHorarios);
	 $( "#slcConsulta" ).change(function(){
		 verHorarios();
		 cargarServicios();
	 });
}
function iniciar(){
	iniciarAutoacomplete();
	
	$( "#slcPaciente" ).combobox();
	consultaDatos();
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		minDate : '0D',
			beforeShowDay: function(date) {
			    var day = date.getDay();
			    return [(day != 0), ''];
			}
	});
	
	
     $( "#slcSucursal" ).change(function(){
    	 mostrarCabinas();
    	 seleccionaDiaChecaSabado();
     });
     
	 $( "#txtFecha" ).change(function(){
		 verHorarios();
		 seleccionaDiaChecaSabado();
	 });
	 $( "#slcConsulta" ).change(mostrarCabinas);
	 $( "#slcConsultorio" ).change(verHorarios);
	
	 
	 $( "#slcHr" ).change(function(){
		 cambioMin();
		 seleccionaDiaChecaSabado();
	 });
	
	 $( "#slcMin" ).change(function(){
		 seleccionaDiaChecaSabado();
	 });
	
	 
	 $( "#checkRepetir" ).click(function(){
		 if( $('#checkRepetir').is(':checked') ) {
			 $('#divRepiteCita').show();
			 $('#divRepiteCitaDias').show();
			 $.ajax({
					method : "post",
					url : "adminFunciones.php",
					data : {
						fechaConvertir:$("#txtFecha").val(),
						horaInicial: $("#slcHr").val()+':'+$("#slcMin").val(),
						duracion:$("#slcDuracion").val(),
						sucursal:$("#slcSucursal").val()
					},
					success : function(data) {
						respuesta=JSON.parse(data);
						if(respuesta[1]=='false')
							$( "#chksabado").attr('disabled','disabled');
						else{
							$( "#chksabado").removeAttr('disabled');
							$( "#chksabado").removeAttr('checked');
						}
						$( "#chk"+respuesta[0]).attr('checked',true);
					}
				});
		 }else{
			 $('#divRepiteCita').hide();
			 $('#divRepiteCitaDias').hide();
		 }
	 });
	 
	 $( "#slcPeriodo" ).change(function(){
		 if($( "#slcPeriodo" ).val()=='0')
			 $( "#txtRepite" ).html('Semana');
		 else
			 $( "#txtRepite" ).html('Mes');
	 });
		
	$("#btnGuardar").click(function(){
		$("#btnGuardar").hide();
		bandera=true;
		 altaCita(obtenerDias());
	});
	
	$("#btnAceptar").click(function(){
		$('html,body').animate({
		    scrollTop: $("#divInicio").offset().top
		}, 2000);
		bandera=false;
		$('#divFechasNoDisponibles').hide();
		 altaCita(obtenerDias());
	});
	
	$("#btnCancelar").click(function(){
		$('html,body').animate({
		    scrollTop: $("#divInicio").offset().top
		}, 2000);
		$("#btnGuardar").show();
		$('#divFechasNoDisponibles').hide();
	});
	
	if($( "#hdnPredefinida" ).val()=='true'){
		$( "#txtFecha" ).val($( "#hdnFecha" ).val());
		$( "#slcDuracion" ).val('10');
	}
	if($( "#hdnPredefinida" ).val()=='true'){
	setTimeout(function() {
		console.log('cabina '+$( "#hdnCabina" ).val());
		$( "#slcConsultorio" ).val($( "#hdnCabina" ).val());
		},1700);
	setTimeout(function() {
//		console.log($("#hdnHr").val());
		$( "#slcConsultorio" ).val($( "#hdnCabina" ).val());
		$( "#slcHr" ).val($( "#hdnHr" ).val());
		},2600);
	setTimeout(function() {
		verHorarios();
	},2900);
	setTimeout(function() {
		$( "#slcHr" ).val($( "#hdnHr" ).val());
		},3100);

	}

	$("#btnPaciente").click(function(){
		 xajax_paciente();
	});
	
	setTimeout(function() {
		window.location="nuevaCita.php";
		},600000);

}
var arrFechas=[];

function obtenerDias() {
	var arrDias = [];
	var i = 0;
	$('.checkDias:checked').each(function() {
		arrDias[i] = $(this).val();
		i++;
	});
	return arrDias;
}

function verHorarios(){
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	var consultorio = $("#slcConsultorio").val().trim();
	var duracion = $("#slcDuracion").val().trim();
	var fecha = $("#txtFecha").val().trim();
	$("#slcHr").html('<option value=""></option>');
	$("#slcMin").html('<option value=""></option>');
	
	
	
	if (fecha != "" && duracion != "" && sucursal != "" && consulta!= "" && consultorio!= "") {
		$( "#checkRepetir" ).removeAttr('disabled');
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSucursal:sucursal,
				fecha:fecha,
				idConsulta:consulta,
				duracion:duracion,
				idConsultorio:consultorio
			},
			success : function(data) {
				arrFechas=JSON.parse(data);
				var opcion='',opcion2='', b=true;
				$.each(arrFechas, function( index, arr ) {
					opcion+='<option value="'+index+'">'+index+'</option>';
					if(b){
						b=false;
						$.each(arr, function( index2, min ) {
							opcion2+='<option value="'+min+'">'+min+'</option>';
						});
					}
					});
				$("#slcHr").html(opcion);
				$("#slcMin").html(opcion2);
				
				if($( "#hdnPredefinida" ).val()=='true'){
					$( "#slcHr" ).val($( "#hdnHr" ).val());
					cambioMin();
				}
			}
		});
	
	}else{
		$( "#checkRepetir" ).attr('disabled');
	}
	
}

function cambioMin(){
	 var opcion2='';
	 $.each(arrFechas[$("#slcHr").val()], function( index2, min ) {
			opcion2+='<option value="'+min+'">'+min+'</option>';
		});
	 $("#slcMin").html(opcion2);
}

function seleccionaDiaChecaSabado(){
	if( $('#checkRepetir').is(':checked') ) {
	var sucursal= $("#slcSucursal").val().trim();
	var duracion = $("#slcDuracion").val().trim();
	var fecha = $("#txtFecha").val().trim();
	
	if (fecha != "" && duracion != "" && sucursal != "" ) {
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				fechaConvertir:fecha,
				horaInicial: $("#slcHr").val()+':'+$("#slcMin").val(),
				duracion:duracion,
				sucursal:sucursal
			},
			success : function(data) {
				respuesta=JSON.parse(data);

				if(respuesta[1]=='false')
					$( "#chksabado").attr('disabled','disabled');
				else{
					$( "#chksabado").removeAttr('disabled');
					$( "#chksabado").removeAttr('checked');
				}
				$( "#chk"+respuesta[0]).attr('checked',true);
			}
		});
	}
	
	}
}
function altaCita(arrDias){
	var existeError = false;
		
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	var duracion = $("#slcDuracion").val().trim();
	var fecha = $("#txtFecha").val().trim();
	var hora= $("#slcHr").val().trim();
	var minutos= $("#slcMin").val().trim();
	var paciente = $("#slcPaciente").val().trim();
	var servicio = $("#txtServicio").val().trim();
	var comen = $("#txtComentarios").val().trim();
	var consultorio = $("#slcConsultorio").val().trim();

	if ( sucursal == "") {
		existeError = true;
		console.log("Error: sucursal");
	}
	if (consulta == "") {
		existeError = true;
		console.log("Error: consulta");
	}
	if (consultorio == "") {
		existeError = true;
		console.log("Error: consultorio");
	}
	if (duracion == "") {
		existeError = true;
		console.log("Error: duracion");
	}
	if (fecha == "") {
		existeError = true;
		console.log("Error: fecha");
	}
	if (hora == "") {
		existeError = true;
		console.log("Error: hora");
	}
	if (minutos == "") {
		existeError = true;
		console.log("Error: minutos");
	}
	if (paciente == "") {
		existeError = true;
		console.log("Error: paciente");
	}
	if (servicio == "") {
		existeError = true;
		console.log("Error: servicio");
	}
	if (comen == "") {
	//	existeError = true;
		console.log("Error: comen");
	}
	var repetir=$('#checkRepetir').is(':checked');
	var Recordatorio=$('#checkRecordatorio').is(':checked');
	var periodo=$("#slcPeriodo").val().trim();
	var veces = $("#slcVeces").val().trim();
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		$("#btnGuardar").show();
	}else{
		mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 8);
		xajax_guardarCita(paciente,sucursal,consultorio,consulta,duracion,fecha,hora,minutos,servicio,comen,repetir,arrDias,periodo,veces,bandera,Recordatorio);
	}
}

function mostrarCabinas(){
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	if ( sucursal != "" && consulta!= "") {
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				Sucursal:sucursal,
				Consulta:consulta,
			},
			success : function(data) {
				$("#slcConsultorio").html(data);
				verHorarios();
			}
		});
	
	}else{
		$("#slcConsultorio").html('<option value=""></option>');
	}
}
function mostrarConfirmacion(){
	$('#divFechasNoDisponibles').show();
	$('html,body').animate({
	    scrollTop: $("#divFechasNoDisponibles").offset().top
	}, 2000);
}

function cargarServicios(){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idConsulta_:$("#slcConsulta").val().trim()
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				 $( "#txtServicio" ).autocomplete({
				        source: respuesta
				      });
				      
			}
		});
}

function limpiarDatos(){
	var dias = new Array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');
	$.each(dias, function( index, ch ) {
		$( "#chk"+ch).removeAttr('checked');
	});

	consultaDatos();
	$("#txtFecha").val('');
	$("#txtServicio").val('');
	$("#txtComentarios").val('');
	$("#slcPaciente").val('');
	$("#slcDuracion").val('');
	$( "#checkRepetir").removeAttr('checked');
	$( "#checkRepetir" ).attr('disabled');

	 $('#divRepiteCita').hide();
	 $('#divRepiteCitaDias').hide();

	$("#btnGuardar").show();
}

function consultarBloqueo(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			consultaBloqueo:$("#slcPaciente").val()
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			if(respuesta[0]==true){
				 mostrarMsjError('Este paciente ha sido bloqueado por '+respuesta[1],5);
				 $("#btnGuardar").hide();
			}else{
				$("#btnGuardar").show();
			}
		}
	});
	
	
}

function iniciarAutoacomplete(){
	$.widget( "custom.combobox", {
	      _create: function() {
	        this.wrapper = $( "<span>" )
	          .addClass( "custom-combobox" )
	          .attr( "style", "display: "+$("#visible").val()+";" )
	          .insertAfter( this.element );
	 
	        this.element.hide();
	        this._createAutocomplete();
	        this._createShowAllButton();
	      },
	 
	      _createAutocomplete: function() {
	        var selected = this.element.children( ":selected" ),
	          value = selected.val() ? selected.text() : "";
	 
	        this.input = $( "<input>" )
	          .appendTo( this.wrapper )
	          .val( value )
	          .attr( "style", "width: 400px; display: "+$("#visible").val()+";" )
	          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
	          .autocomplete({
	            delay: 0,
	            minLength: 0,
	            source: $.proxy( this, "_source" )
	          })
	          .tooltip({
	            classes: {
	              "ui-tooltip": "ui-state-highlight"
	            }
	          })
	          .on( "change", function() {
				verificaInasistencias();	 
	          });
;
	 
	        this._on( this.input, {
	          autocompleteselect: function( event, ui ) {
	            ui.item.option.selected = true;
	            this._trigger( "select", event, {
	              item: ui.item.option
	            });
	          },
	 
	          autocompletechange: "_removeIfInvalid"
	        });
	      },
	 
	      _createShowAllButton: function() {
	        var input = this.input,
	          wasOpen = false;
	 
	        $( "<a>" )
	          .attr( "tabIndex", -1 )
	          .attr( "title", "Show All Items" )
	          .attr( "style", "display: "+$("#visible").val()+";" )
	          .tooltip()
	          .appendTo( this.wrapper )
	          .button({
	            icons: {
	              primary: "ui-icon-triangle-1-s"
	            },
	            text: false
	          })
	          .removeClass( "ui-corner-all" )
	          .addClass( "custom-combobox-toggle ui-corner-right" )
	          .on( "mousedown", function() {
	            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
	          })
	          .on( "click", function() {
	            input.trigger( "focus" );
		         // Close if already visible
	            if ( wasOpen ) {
	              return;
	            }
	 
	            // Pass empty string as value to search for, displaying all results
	            input.autocomplete( "search", "" );
	          });
	      },
	 
	      _source: function( request, response ) {
	        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
	        response( this.element.children( "option" ).map(function() {
	          var text = $( this ).text();
	          if ( this.value && ( !request.term || matcher.test(text) ) )
	            return {
	              label: text,
	              value: text,
	              option: this
	            };
	        }) );
	      },
	 
	      _removeIfInvalid: function( event, ui ) {
	 
	        // Selected an item, nothing to do
	        if ( ui.item ) {
	        	consultarBloqueo();
	          return;
	        }
	 
	        // Search for a match (case-insensitive)
	        var value = this.input.val(),
	          valueLowerCase = value.toLowerCase(),
	          valid = false;
	        this.element.children( "option" ).each(function() {
	          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
	            this.selected = valid = true;
	            return false;
	          }
	        });
	 
	        // Found a match, nothing to do
	        if ( valid ) {
	          return;
	        }
	 
	        // Remove invalid value
	        this.input
	          .val( "" )
	          .attr( "title", value + " didn't match any item" )
	          .tooltip( "open" );
	        this.element.val( "" );
	        this._delay(function() {
	          this.input.tooltip( "close" ).attr( "title", "" );
	        }, 2500 );
	        this.input.autocomplete( "instance" ).term = "";
	      },
	 
	      _destroy: function() {
	        this.wrapper.remove();
	        this.element.show();
	      }
	    });
	 
}

function verificaInasistencias(){
$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			idPacienteInasistencias:$("#slcPaciente").val()
		},
		success : function(data) {
			if(data>2){
				 mostrarMsjError('Este paciente no ha asistido a sus consultas en '+data+' ocasiones');
				 $("#btnGuardar").hide();
			}	
	}
  });
} 

//var alert = alertify.alert('Titulo','TextoAlerta').set('label', 'Aceptar');     	 
//alert.set({transition:'zoom'}); //slide, zoom, flipx, flipy, fade, pulse (default)
//alert.set('modal', false);  //al pulsar fuera del dialog se cierra o no	
//alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right

//alertify.message('Mensaje Normal',10, null);

//alertify.notify('texto','success',100, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  	

//alertify.notify('error','error',100, null); 

//alertify.notify('warning','warning',100, null);