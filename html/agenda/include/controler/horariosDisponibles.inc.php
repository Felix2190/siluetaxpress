<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND . "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.cabina.inc.php";

// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
function obtenMes($numMes)
{
    $MESES = array(
        "1" => "Enero",
        "2" => "Febrero",
        "3" => "Marzo",
        "4" => "Abril",
        "5" => "Mayo",
        "6" => "Junio",
        "7" => "Julio",
        "8" => "Agosto",
        "9" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
    );
    if ($numMes == '')
        return $MESES;
    return $MESES['' . $numMes];
}
// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();

function mostrarHorarios($arrInfo, $arrFechas)
{
    $r = new xajaxResponse();
    $dias = array(
        '',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'S&aacute;bado',
        'domingo'
    );
    $sucursal = new ModeloSucursal();
    $cabina = new ModeloCabina();
    $txtHorarios = '';
    foreach ($arrInfo as $idSucursal => $arrInfoCabinas) {
        $sucursal->setIdSucursal($idSucursal);
        
        $txtHorarios .= '<div class="8u 12u$(small)"><h4>' . $sucursal->getSucursal() . '</h4></div>
				<div class="12u 12u$(small)"><div class="table-wrapper"><table class="alt"><thead><th>Consultorio</th>';
        
        foreach ($arrFechas as $fecha) {
            $auxFecha = explode("-", $fecha);
            $dia = date('N', strtotime($fecha));
            $txtHorarios .= "<th>$dias[$dia]<br />$auxFecha[2] de " . obtenMes(intval($auxFecha[1])) . " del $auxFecha[0]</th>";
        }
        $txtHorarios .= '</thead><tbody><tr>';
        
        foreach ($arrInfoCabinas as $idCabina => $arrFechaHorarios) { // consultorios
            $cabina->setIdCabina($idCabina);
            $txtHorarios .= '<td>' . $cabina->getNombre() . '</td>';
            
            foreach ($arrFechas as $fecha) {
                if (key_exists($fecha, $arrFechaHorarios)) {
                $arrHorarios = $arrFechaHorarios[$fecha];
                $txtHorarios .= '<td><ul class="alt">';
                foreach ($arrHorarios as $horario)
                    $txtHorarios .= "<li>$horario</li>";
                
                $txtHorarios .= '</ul></td>';
                }else {
                    $txtHorarios .= '<td></td>';
                }
            }
            $txtHorarios .= '</tr>';
        }
        $txtHorarios .= '</tbody></table></div></div>';
    }
    $r->assign('divHorarios', 'innerHTML', $txtHorarios);
    return $r;
}

$xajax->registerFunction("mostrarHorarios");

$xajax->processRequest();

// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$usuario=$sucursal='';
if ($objSession->getidRol()!=1){
    $usuario=$objSession->getidUsuario();
    $sucursal=$objSession->getIdSucursal();
    
}

?>