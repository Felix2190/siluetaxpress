$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	iniciarAutoacomplete();
	
	$( "#slcPaciente" ).combobox();
	
	$( "#btnConsulta" ).click(buscar);
	$( "#btnActivar" ).click(activar);
	estiloTabla();
	
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
	
}

function activar(){
	xajax_activarCodigo(idGanador);
	$("#divCodigo").hide();
	$("#txtCodigo").val('');
	estiloTabla();
}
var codigo,idGanador;

function buscar(){
	var paciente = $("#slcPaciente").val().trim();
	if (paciente == "") {
		mostrarMsjError('Datos incompletos!!',5);
		return ;
	}
	codigo = $("#txtCodigo").val().trim();
	if (codigo == "") {
		mostrarMsjError('Datos incompletos!! ',5);
		return ;
	}
		
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			idPacienteGanador:paciente,
			codigoPromo:codigo
		},
		success : function(data) {
			respuesta=JSON.parse(data);
			if(respuesta[0]!=true){
				mostrarMsjError(respuesta[1],5);
				$("#divCodigo").hide();
			}else{
				idGanador=respuesta[1];
				$( "#hdIdGanador" ).html(respuesta[1]);
				$( "#spPromocion" ).html(respuesta[2]);
				$("#divCodigo").show();
			}
		}
	});
}

function estiloTabla(){
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
            ajaxUrl:   'getCodigos.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
           //   $("#tablesorting-1").trigger("update");
              $(table).find('tbody').empty();

                if (ajax) {
                    $.each(ajax[1], function (i, item) {
                          var html = "<td>" + item.codigo + "</td>" +
                            "<td>" + item.promocion + "</td>" +
                            "<td>" + item.telefonoCel + "</td>" +
                            "<td>" + item.estatus + "</td>";
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
	          .attr( "style", "width: 300px; display: "+$("#visible").val()+";" )
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
//				verificaInasistencias();	 
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