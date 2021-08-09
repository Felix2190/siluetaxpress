$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				sucursalCitaNueva:''
			},
			success : function(data) {
				$( "#slcSucursal" ).html(data);
			}
		});
	
	 $.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				consultaArea:''
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				$( "#slcConsulta" ).html(respuesta);
			}
		});
	
	$( "#btnGuardar" ).click(guardar);
	estiloTabla();
	
}

function actualizar(idPersonal, estatus){
	xajax_actualizar(idPersonal, estatus);
	estiloTabla();
}

function cargarPersonal(idPersonal, nombre, consulta, sucursal){
	$("#slcConsulta").val(consulta);
	$("#slcSucursal").val(sucursal);
	$("#hdIdPersonal").val(idPersonal);
	$("#txtNombre").val(nombre);
				$('html,body').animate({
				    scrollTop: $("#divInicio").offset().top
				}, 2000);
}

function guardar(){
	var consulta = $("#slcConsulta").val();
	if ( consulta == "") {
		mostrarMsjError('Datos incompletos!!',5);
		return ;
	}
	
	var sucursal = $("#slcSucursal").val();
	if ( sucursal == "") {
		mostrarMsjError('Datos incompletos!!',5);
		return ;
	}
	
	var id = $("#hdIdPersonal").val();
	
	
	var nombre = $("#txtNombre").val().trim();
	if (nombre == "") {
		mostrarMsjError('Datos incompletos!! ',5);
		return ;
	}
		
	xajax_guardar(id,nombre,sucursal,consulta);
	estiloTabla()
}

function limpiar(){
	$("#slcConsulta").val("");
	$("#slcSucursal").val("");
	$("#hdIdPersonal").val(0);
	$("#txtNombre").val("");
	
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
            ajaxUrl:   'getPersonal.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
           //   $("#tablesorting-1").trigger("update");
              $(table).find('tbody').empty();

                if (ajax) {
                    $.each(ajax[1], function (i, item) {
                          var html = "<td>" + item.nombreCompleto + "</td>" +
                            "<td>" + item.tipoConsulta + "</td>" +
                            "<td>" + item.sucursal + "</td>  <td>" ;
						if(item.activo==true)
                            html+="<a onClick='actualizar("+item.idPersonal+",0)'> <img src='images/eliminaProducto.png' style='width: 30px' title='Suspender'/></a>";
                          else
							  html+="<a onClick='actualizar("+item.idPersonal+",1)'> <img src='images/guardar.png' style='width: 30px' title='Activar' /></a>";
                          
                              html+="<a onClick='cargarPersonal("+item.idPersonal+",\""+item.nombreCompleto+"\","+item.idConsulta+","+item.idSucursal+")'> <img src='images/editar.png' style='width: 30px' title='Editar'/></a></td>";
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