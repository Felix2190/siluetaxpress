$(document).ready(function(){
	iniciar();
});

function actualizar(){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			bloqueos:''
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
			listaBloqueos:''
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			xajax_tablaBloqueos(respuesta);
		}
	});
}
	 
function iniciar(){
	iniciarAutoacomplete();
	$( "#slcPaciente" ).combobox();
	actualizar();
	
	$("#btnBloquear").click(function(){
		$("#btnBloquear").hide();
		bloquear();
	});
	
	$( "#btnNo" ).click(function(){
		 $( "#msjConfirm" ).hide();
		 });
		 
		 $( "#btnSi" ).click(function(){
			 $( "#msjConfirm" ).hide();
				$.ajax({
					method : "post",
					url : "adminFunciones.php",
					data : {
						idBloqueo:idBloqueo
					},
					success : function(data) {
						respuesta=JSON.parse(data);
						if(respuesta[0]=='true'){
							mostrarMsjExito('Se ha desbloqueado al paciente',3)
							setTimeout(function() {
								actualizar();
							},3200);
						}else{
							mostrarMsjError(respuesta[1],5);
						}
					}
				});
		 });
		 
		 $( "#btnCerrar" ).click(function(){
			 $( "#msjConfirm" ).hide();
			 });

	
		
}

function verOpciones(id){
	idBloqueo=parseInt(id);
	 $( "#msjConfirm" ).show();
}

var idBloqueo;


function bloquear(){
	var existeError = false;
		
	var paciente = $("#slcPaciente").val();
	var motivo = $("#txtMotivo").val().trim();
	if (paciente == "") {
		existeError = true;
		console.log("Error: paciente");
	}
	if (motivo == "") {
		existeError = true;
		console.log("Error: comen");
	}
	
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		$("#btnBloquear").show();
	}else{
		mostrarMsjEspera('Espere un momento...', 3);
		xajax_bloquearPaciente(paciente,motivo);
		actualizar();
		$("#txtMotivo").val('');
		$("#btnBloquear").show();
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
	          .attr( "style", "width: 300px;" )
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