$(document).ready(function(){
	iniciar();
});
var arrFechas;	
function consultaDatos(){
	
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				tiposConsulta:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				$( "#slcConsulta" ).html(respuesta);
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
				listarPacientes();
			}
		});}


function iniciar(){
	
	consultaDatos();
		 
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
			beforeShowDay: function(date) {
			    var day = date.getDay();
			    return [(day != 0), ''];
			}
	});
	

    $( "#slcSucursal" ).change(function(){
   	 mostrarCabinas();
		verHorarios();
		listarPacientes();
    });
    
    $( "#txtFecha" ).change(function(){
		 verHorarios();
	 });
	
    $( "#slcConsulta" ).change(function(){
      	 mostrarCabinas();
   	   });
       
    $( "#slcHr" ).change(function(){
		 cambioMin();
	 });
	
    $("#btnBuscar").click(function(){
    	buscarCita();
	});
	
}

function cambioMin(){
	 var opcion2='';
	 $.each(arrFechas[$("#slcHr").val()], function( index2, min ) {
			opcion2+='<option value="'+min+'">'+min+'</option>';
		});
	 $("#slcMin").html(opcion2);
}


function verHorarios(){
	var sucursal= $("#slcSucursal").val().trim();
	var fecha = $("#txtFecha").val().trim();
	$("#slcHr").html('<option value=""></option>');
	$("#slcMin").html('<option value=""></option>');
	
	
	
	if (fecha != "" && sucursal != "" ) {
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSucursalB:sucursal,
				fechaB:fecha
			},
			success : function(data) {
				arrFechas=JSON.parse(data);
				var opcion='',opcion2='', b=true;
				$.each(arrFechas, function( index, arr ) {
					opcion+='<option value="'+index+'">'+index+'</option>';
					if(b){
						b=false;$.each(arr, function( index2, min ) {
							opcion2+='<option value="'+min+'">'+min+'</option>';
						});
					}
					});
				$("#slcHr").html(opcion);
				$("#slcMin").html(opcion2);
			}
		});
	
	}else{
		$( "#checkRepetir" ).attr('disabled');
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
			}
		});
	
	}else{
		$("#slcConsultorio").html('<option value=""></option>');
	}
}

function listarPacientes(){
	var sucursal= $("#slcSucursal").val().trim();
	$("#divPaciente").html('<select id="slcPaciente" style="width: 450px;"></select>');
	iniciarAutoacomplete();
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			pacientes:sucursal
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			$( "#slcPaciente" ).html(respuesta);
			$( "#slcPaciente" ).combobox(); 
		}
	});
	
}

function buscarCita(){
	var existeError = false;
	
	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	var fecha = $("#txtFecha").val().trim();
	var hora= $("#slcHr").val().trim();
	var minutos= $("#slcMin").val().trim();
	var paciente = $("#slcPaciente").val().trim();
	var consultorio = $("#slcConsultorio").val().trim();
	var estatus= $("#slcEstatus").val().trim();
	
	if (paciente == "" && fecha=="") {
		existeError = true;
		console.log("Error: paciente, fecha");
	}else{
		if($("#hdnRol").val()==1)
			if (sucursal == "" ) {
				existeError = true;
				console.log("Error: sucursal");
				mostrarMsjError('Datos incompletos!! <br />Por favor, seleccione una sucursal.',5);
				return false;
			}
	}
	
	if(hora=="")
		hora="0:0"
		else
			hora+=":"+minutos;
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, seleccione la fecha o el paciente a buscar.',5);
	}else{
		mostrarMsjEspera('Espere un momento... consultando informaci&oacute;n.', 3);
		
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				sucursalB:sucursal,
				pacienteB:paciente,
				consultaB:consulta,
				cabinaB:consultorio,
				fechaInicioB:fecha,
				horaB:hora,
				estatusB:estatus
			},
			success : function(data) {
				respuesta=JSON.parse(data);
//			alert(data);
				xajax_buscarCitas(respuesta);
			}
		});
	
	}
}


function iniciarAutoacomplete(){
	$.widget( "custom.combobox", {
	      _create: function() {
	        this.wrapper = $( "<span>" )
	          .addClass( "custom-combobox" )
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
	          .attr( "style", "width: 350px;" )
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
	          });
	 
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