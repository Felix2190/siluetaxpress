<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.franquicia.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$xajax = new xajax();

function mostrarTabla($informacion)
{
    $SMSSucursales=$informacion[0];
//    $SMSFranquicias=$informacion[1];
    $r = new xajaxResponse();
    
    // POR SUCURSAL
    
    $titulos = array("Confirmaci&oacute;n de cita","Recordatorio","Respuesta de cancelaci&oacute;n (paciente)","Respuesta de cancelaci&oacute;n (encargado)","Actualizaci&oacute;n de cita","Notificaciones masivas");
    $sucursal= new ModeloSucursal();
    $arrSucursal=$sucursal->obtenerSucuralesFranquiciaSesion();
    $tabla = "";
    if (count($SMSSucursales) > 0) {
        $tabla .= "<table><thead><tr><th>Sucursal</th>";
        
        foreach ($titulos as $titulo)
            $tabla.="<th>$titulo</th>";
        
        $tabla.="<th>Subtotal</th></tr></thead><tbody>";
        $t=0;$total=0;
        foreach ($SMSSucursales as $idSucursal => $info){
            $tabla .= "<tr><td>" . $arrSucursal[$idSucursal]. "</td>";
            $total=0;
            foreach ($titulos as $item ){
                if (isset($info[$item])){
                    $total+=$info[$item];
                    $tabla.="<td>" . $info[$item] . "</td>";
                }else
                    $tabla.="<td>0</td>";
            }
            $t+=$total;
            
            $tabla.="<td>" . $total . "</td></tr>";
        }
        $tabla .= "<tr><td colspan='".(count($titulos)+1)."'><strong>TOTAL</strong></td><td><h3>" . $t. "</h3></td></tr></tbody></table>";
    }
    
    $r->assign('divTablaSucursal', 'innerHTML', $tabla);
    
    //POR FRANQUICIA
/*    $franquicia = new ModeloFranquicia();
    $arrFranquicia = $franquicia->obtenerFranquicias();
    $tabla = "";
    if (count($SMSFranquicias) > 0) {
        $tabla .= "<table><thead><tr><th>Franquicia</th><th>Total</th></tr></thead><tbody>";
        foreach ($SMSFranquicias as $idFranq => $total)
            $tabla.="<tr><td>" . $arrFranquicia[$idFranq] . "</td><td>" . $total . "</td></tr>";
            
        $tabla .= "</tbody></table>";
    }
    
    $r->assign('divTablaFranquicia', 'innerHTML', $tabla);
  */  return $r;
}
$xajax->registerFunction("mostrarTabla");


$xajax->processRequest();

// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>