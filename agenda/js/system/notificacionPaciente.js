$(document).ready(function(){
	iniciar();
});
	 var seccion,respuesta,combo={},arrNombre=[],aux,txtCombo,arrPacientes,idINDEXlong,valor,obj,editor;

function iniciar(){
	    editor = CKEDITOR.replace('txtTextoCorreo');
	
	$("input[name=datos]").change(function(){
	
	iniciarAutoacomplete();
		$( "#btnGuardar").show();
	arrNombre=[];
		if($(this).val()=="SMS"){
			seccion="SMS";
			 $('#divSMS').show();
			 $('#divCorreo').hide();
		}else{
			seccion="Correo";
			$('#divCorreo').show();
			$('#divSMS').hide();
		}
		//deseleccionar checks
		$("input[type=checkbox]:checked").each(function(){
			$("#"+$(this).attr("id")). prop("checked", false);
	     });
		$( "#txt"+seccion ).html('');
	    //llenar combo
		$( "#txtPaciente"+seccion ).combobox();
		arrayListado(seccion,'');
		setTimeout(function() { 
			arrPacientes=combo=respuesta;
			idINDEX="index";
			llenarCombo();
			$( "#txtPaciente"+seccion ).html(txtCombo);

		},700);
			$( "#spnTotal"+seccion ).html(' '+arrNombre.length);
	});
	var arreglo=[],x=1;
	$(".checkSucursal").click(function(){
		arreglo=[];
		arrayListado(seccion,$(this).val());
	 var select=$("#"+$(this).attr("id")).prop('checked') ;//obtener status del check seleccionado 
		setTimeout(function() { 
//			console.log(index);
			$.each(respuesta, function( index) {
			    arreglo.push(index);
				x++;
				})
			agregar_quitar_sucursal(arreglo, select);
			
		},700);
		});
		
	$("#txtTextoSMS").on('paste', function(e){
    	e.preventDefault();
    });
  
	$("#btnAgregarSMS").click(function(){
		agregarElemento();
	});	
	$("#btnEliminarSMS").click(function(){
		quitarElemento();
	});	
	
	
	$("#btnAgregarCorreo").click(function(){
		agregarElemento();
	});	
	$("#btnEliminarCorreo").click(function(){
		quitarElemento();
	});	
	
	$("#btnGuardar").click(function(){
		guardar();
	});	
	
	$("#btnAgregarIma").click(function(){
		if($('.row_tabla').length<=4){
			agregar_archivo();
		}else{
			mostrarMsjError('Solo se pueden adjuntar 5 im&aacute;genes');
		}
	});	
}

function guardar(){
	var nombre= $("#txtNombre"+seccion).val(),error,existeError=false;
	var ruta =[];
	 var num=0;
	                    
	if (nombre == "") {
		existeError = true;
		console.log("Error: txtnombre");
		error="Debe ingresar el nombre";
	}
	if(seccion=="Correo"){
		var editorData = editor.getData();
    	texto= editorData.replace(/&nbsp;/gi, ' ');

		var trs = $("#tb1 tr").length;
	                    for (num = 0; num <= trs; num++) {
	                		if ($("#tb1 tr[id^=fila" + num + "]").attr('id')) {
	                			ruta.push('/tmp/notificaciones/'+$("#ruta_archivo" + num).val().trim());
	                		}
	                    }    
	}else{
	 texto= $("#txtTexto"+seccion).val();
	}
	
	if (texto == "") {
		existeError = true;
		console.log("Error: txttexto");
		error="Debe ingresar el texto";
	}
	
	
	if (arrNombre.length == 0) {
		existeError = true;
		console.log("Error: txt");
		error="Debe seleccionar por lo menos un paciente";
	}
	
	console.log(ruta);
	if(existeError){
	mostrarMsjError(error,5);
	}else{
	$("#btnGuardar").hide();
	mostrarMsjEspera('Espere un momento... ',50);
	xajax_guardar(nombre,texto,arrNombre,seccion,ruta);
	}
}

function agregarElemento(){
	txtCombo="";
	 aux= {};
	 aux=combo;
		console.log('pac '+$( "#txtPaciente"+seccion ).val());
	pos=$.inArray($( "#txtPaciente"+seccion ).val(), combo);
	if(pos>=0){  //existe
		aux.splice(pos,1);
		arrNombre.push($( "#txtPaciente"+seccion ).val());
	}	
	actualizarComboTextarea();
}

function quitarElemento(){
	long=arrNombre.length;
	if(long>0){
		long--;
		$.ajax({
			method : "post",
			url : "adminFunciones.php",
			data : {
				idPacienteSucursal:arrNombre[long]
			},
			success : function(idP) {
				console.log(arrNombre[long])
				txtCombo="";
				 aux= {};
				 aux=combo;
				 aux.push(arrNombre[long]);
				arrNombre.splice(long,1);
				actualizarComboTextarea();				
				$("#"+seccion+"chk"+idP). prop("checked", false);
			  	}
		});

	}
}

function agregar_quitar_sucursal(arreglo,select){
	var pos,total=0;
	txtCombo="";
	 aux= {};
//	var arr = jQuery.makeArray( respuesta );
//	$( "#txt"+seccion ).append('');
	 aux=combo;
	 console.log('consulta: '+arreglo.length);
	 console.log('aux: '+aux.length);
		$.each(arreglo, function(index,n ) {
			if(select){ //quitar del combo
			pos=$.inArray(n, combo);
			if(pos>=0){  //existe
				aux.splice(pos,1);
				total++;
	///			 console.log(index+' >>>>>>> aux : '+aux.length);
				arrNombre.push(n);
			 }else{//
//				 aux.push(n);
//				 aux[index]=arrPacientes[index];
//			    txtCombo+='<option value="'+index+'">'+arrPacientes[index]+'</option>';
		    }
		}else{
			 aux.push(n);
				pos=$.inArray(n, arrNombre);
				if(pos>=0){  //existe
					arrNombre.splice(pos,1);
				}			
		}
	});
		console.log('encontrados: '+total);
		actualizarComboTextarea();
console.log(arrNombre);
}

function actualizarComboTextarea(){
	$.each(arrNombre, function(i,elem) {
	    txtCombo+=arrPacientes[elem]+' ';
	})
	$( "#txt"+seccion ).html(txtCombo);

	combo= {};
 combo=aux;
 console.log('aux final: '+aux.length);
 idINDEX="elemento";
	llenarCombo();
$( "#txtPaciente"+seccion ).html(txtCombo);
$( "#spnTotal"+seccion ).html(' '+arrNombre.length);
//ponerElCursorAlFinal("txt"+seccion )
}

function llenarCombo(){
	 txtCombo="";
	 aux= new Array();
	 var value;
	$.each(combo, function( index,elem) {
		//elemento a seleccionar
		if(idINDEX=="index")
			value=index;
		else
			value=elem;
		//		console.log(value);
	    txtCombo+='<option value="'+value+'">'+arrPacientes[value]+'</option>';
	    aux.push(value);
	})
	combo={};
	combo=aux;
	console.log('combo: '+combo.length)
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

function ponerElCursorAlFinal(id){
	obj = $("#"+id),
    valor = obj.val();
    obj.focus().val("").val(valor);
   obj.scrollTop(obj[0].scrollHeight);
}

 function limitar(e, contenido, caracteres){
                // obtenemos la tecla pulsada
        var unicode=e.keyCode? e.keyCode : e.charCode;
        if(unicode==8 || unicode==46 || unicode==13 || unicode==37 || unicode==39 || unicode==38 || unicode==40)
            return true;

        if(contenido.length>=caracteres)
            return false;
var out = '';
    //Se añaden las letras validas
    var filtro = ' abcdefghijklmn!?opqrstuvwxyzABCDEFGHIJKLMN.,;OPQRSTUVWXYZ1234567890';//Caracteres validos
	
    for (var i=0; i<contenido.length; i++)
       if (filtro.indexOf(contenido.charAt(i)) != -1) 
	     out += contenido.charAt(i);
    $("#txtTextoSMS").val(out);
        return true;
}

function agregar_archivo(){
  
  var tamano = $('.row_tabla').length;

  var rand = Math.floor((Math.random()*10000)+999);
  var formData = new FormData();
  var inputFileImage = document.getElementById('archivoImagen');
  var file = inputFileImage.files[0];
  console.log( file );
if(file!=undefined){
	$('#tablaArchivos').show();
  formData.append('imagenCorreo',file);
  formData.append('id',rand);
$.ajax({
      url: 'adminFunciones.php',  
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,	
      processData: false,
      success: function(data){
    	  if(data){
          var fila='<tr class="row_tabla" id="fila'+tamano+'">'+
			'<td colspan="4" >'+
			'<input type="hidden" id="ruta_archivo'+tamano+'" value="'+rand+'_'+file.name+'" />'+file.name+'</td>'+
			'<td >'+
			'<a href="javascript:quitar_archivo('+tamano+');" ><img src="images/cancelarCita2.png" style="width: 30px" /> </a></td>'+
		'</tr>';
 $('#contenedor_tabla').append(fila);
    	  }else{
    		  mostrarMsjError('Ocurri&oacute; un problema al subir la imagen');
    	  }
 $('#archivoImagen').val('');
    	  
      }
  });
}else{
	  if(file==undefined){
        var msjError=' Debe seleccionar un archivo';
    }
	  mostrarMsjError(msjError);
	  }
                        
};

function quitar_archivo(id){
	  
  $('#fila'+id).remove();
  if($('.row_tabla').length==0){
  	$('#tablaArchivos').hide();
  	
  }
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
	//        	consultarBloqueo();
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