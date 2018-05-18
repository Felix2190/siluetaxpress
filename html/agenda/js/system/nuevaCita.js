$(document).ready(function(){
	iniciar();
});

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
	          .attr( "title", "" )
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
	 
function iniciar(){
	iniciarAutoacomplete();
	
	$( "#slcPaciente" ).combobox();
	
		 
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		minDate : '0D'
	});
	
    var availableTags = [
        "ActionScript",
        "AppleScript",
        "Asp",
        "BASIC",
        "C",
        "C++",
      ];
      $( "#tags" ).autocomplete({
        source: availableTags
      });
      

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
			}
		});
		 
	 $( "#slcDuracion" ).change(verHorarios);
	 $( "#slcConsulta" ).change(verHorarios);
	 $( "#slcSucursal" ).change(verHorarios);
	 $( "#txtFecha" ).change(verHorarios);
	 $( "#slcHr" ).change(function(){
		 var opcion2='';
		 $.each(arrFechas[$("#slcHr").val()], function( index2, min ) {
				opcion2+='<option value="'+min+'">'+min+'</option>';
			});
		 $("#slcMin").html(opcion2);
	 });
	 
	 $( "#checkRepetir" ).click(function(){
		 if( $('#checkRepetir').is(':checked') ) {
			 $('#divRepiteCita').show();
			 $('#divRepiteCitaDias').show();
		 }else{
			 alert('no');
			 $('#divRepiteCita').hide();
			 $('#divRepiteCitaDias').hide();
		 }
	 });
		
	
	$("#btnGuardar").click(function(){
		console.log('h');
		 $('.checkDias:checked').each(
				    function() {
				        alert("El checkbox con valor " + $(this).val() + " está seleccionado");
				    }
				);
	});
}
var arrFechas=[];
function verHorarios(){

	var sucursal= $("#slcSucursal").val().trim();
	var consulta = $("#slcConsulta").val().trim();
	var duracion = $("#slcDuracion").val().trim();
	var fecha = $("#txtFecha").val().trim();
	$("#slcHr").html('');
	$("#slcMin").html('');
	
	if (fecha != "" && duracion != "" && sucursal != "" && consulta!= "") {
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idSucursal:sucursal,
				fecha:fecha,
				idConsulta:consulta,
				duracion:duracion
			},
			success : function(data) {
				arrFechas=JSON.parse(data);
				var opcion='',opcion2='', b=true;
				$.each(arrFechas, function( index, arr ) {
					opcion+='<option value="'+index+'">'+index+'</option>';
					alert(opcion);
					if(b){
						b=false;
						$.each(arr, function( index2, min ) {
							opcion2+='<option value="'+min+'">'+min+'</option>';
						});
					}
					});
				$("#slcHr").html(opcion);
				$("#slcMin").html(opcion2);
			}
		});
	
	}
	
}

function altaCita(){
	var existeError = false;
	
	var txtNombre= $("#txtNombre").val().trim();
	if (txtNombre == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}

	var txtApellidos= $("#txtApellidos").val().trim();
	if (txtApellidos == "") {
		existeError = true;
		console.log("Error: txtApellido");
	}
	
	var txtTelCasa= $("#txtTelCasa").val().trim();
	if (txtTelCasa == "") {
		existeError = true;
		console.log("Error: txTelCasa");
	}
	var txtTelMovil= $("#txtTelMovil").val().trim();
	if (txtTelMovil == "") {
		existeError = true;
		console.log("Error: txTelMovil");
	}
	
	var txtEmail= $("#txtCorreo").val().trim();
	if (txtEmail == "") {
		existeError = true;
		console.log("Error: txtEmail");
	}
	
	var txtEdad= $("#txtEdad").val().trim();
	if (txtEdad == "") {
		existeError = true;
		console.log("Error: txtEdad");
	}
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita',5);
	}

	mostrarMsjEspera('Espere un momento... guardando informaaci&oacute;n.', 3);
	xajax_guardar(txtNombre, txtApellidos, txtTelCasa, txtTelMovil, txtEmail,txtEdad);
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