$(document).ready(function(){
	iniciar();
});
	 var seccion,respuesta,combo,arrNombre,aux,txtCombo,arrPacientes;
function iniciar(){
	iniciarAutoacomplete();
	$("input[name=datos]").change(function(){
		if($(this).val()=="SMS"){
			seccion="SMS";
			 $('#divSMS').show();
			 $('#divCorreo').hide();
		}else{
			seccion="Correo";
			$('#divCorreo').show();
			$('#divSMS').hide();
		}
		$( "#txtPaciente"+seccion ).combobox();
		arrayListado(seccion,'');
		setTimeout(function() { 
			arrPacientes=combo=respuesta;
			llenarCombo();
			$( "#txtPaciente"+seccion ).html(txtCombo);

			console.log(combo);
		},700);
	});
	var arreglo=[];
	$(".checkSucursal").change(function(){
		aux=$(this).val();
		arreglo=[];
		arrayListado(seccion,aux);
		setTimeout(function() { 
//			console.log(respuesta);
			$.each(respuesta, function( index) {
			    arreglo.push(''+index);
			})
			agregar_quitar_sucursal(arreglo, $(this).is(':checked') );
			
		},700);
		});
		
}


function agregar_quitar_sucursal(arreglo,select){
	arrNombre=[],ay={};
	var pos;
	txtCombo="";
	 aux= new Array();
//	var arr = jQuery.makeArray( respuesta );
	 aux=combo;
	$.each(arrPacientes, function(index,n ) {
//		console.log('--------'+index);
			if(!select){ //quitar del combo
			pos=arreglo.indexOf(index);
			if(pos!==-1){  //existe
				aux.splice(pos,1);
				$( "#txt"+seccion ).append(arrPacientes[index]+' ');
				arrNombre.push(index);
			 }else{//
		//		 aux[index]=arrPacientes[index];
			    txtCombo+='<option value="'+index+'">'+arrPacientes[index]+'</option>';
		    }
		}else{
			pos=combo.indexOf(index);
			if(pos==-1){
		        aux.push(index);
			}else{
				if(arrNombre.indexOf(index)!==-1){
					arrNombre.push(nombre);
				}
			}
			
		}
	});

	 combo= {};
	 combo=aux;
	//}llenarCombo();
	$( "#txtPaciente"+seccion ).html(txtCombo);
console.log(combo);
}
function llenarCombo(){
	 txtCombo="";
	 aux= new Array();
	$.each(combo, function( index ) {
		console.log(index);
	    txtCombo+='<option value="'+index+'">'+arrPacientes[index]+'</option>';
	    aux.push(index);
	})
	combo={};
	combo=aux;
	console.log(combo.length)
}
function arrayListado(seccion,idSucursal){
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			nPaciente: ''+seccion,
			idSucursal:idSucursal
		},
		success : function(data) {
			respuesta= JSON.parse(data);
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
	          .attr( "style", "width: 150px; display: "+$("#visible").val()+";" )
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