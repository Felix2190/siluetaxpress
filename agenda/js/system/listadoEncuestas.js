$(document).ready(function(){
	iniciar();
});
	 
function iniciar(){
	$('.datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		maxDate : '0D'
	});
		
	estiloTabla($("#txtFecha").val());
	
}
var texto=encode_utf8('Silueta Express agradece tu visita. Ay�danos a mejorar el servicio contestando esta peque�a encuesta AN�NIMA de 3 preguntas r�pidas link https://fi.uy/pk2i ingresando el ID ');
function enviaLink(id,num){
	window.open("https://web..com/send?phone=521"+num+"&text="+texto+id, "_blank");

}

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

function estiloTabla(fecha){
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
            ajaxUrl:   'getEncuestas.php?page={page}&size={size}&{sortList:col}&{filterList:filter}&fecha='+fecha,
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
           //   $("#tablesorting-1").trigger("update");
              $(table).find('tbody').empty();

                if (ajax) {
                    $.each(ajax[1], function (i, item) {
                          var html = "<td>" + item.sucursal + "</td>" +
                            "<td>" + item.tipoConsulta + "</td>" +
                            "<td> <a onClick='enviaLink("+item.idEncuesta+","+item.telefonoCel+")'> <img src='images/whats.webp' style='width: 30px' /></a></td>";
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
