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

function mostrarHorarios($arrInfo, $arrFechas, $fechaI)
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
    
    $fechaFin = date ("Y-m-d",strtotime ( '+7 day' , strtotime ( $fechaI) ) );
    $fechaInicio = date ("Y-m-d",strtotime ( '-7 day' , strtotime ( $fechaI) ) );
    
    $fecha1=explode("-", $fechaI);
    $fecha2=explode("-", $fechaFin);
    $rango="$fecha1[2]/".obtenMes(''.intval($fecha1[1]))."/$fecha1[0] al $fecha2[2]/".obtenMes(''.intval($fecha2[1]))."/$fecha2[0]";
    
    $fI=strtotime($fechaI);
    $fh=strtotime(date ( 'Y-m-d'));
    $fA=strtotime($fechaInicio);
    
    $disable="";
    if ($fI<=$fh){
        $disable="disabled";
        $fechaI=date('Y-m-d');
    }
    if ($fA<$fh){
        $fechaInicio=date ( 'Y-m-d');
    }
    
    $btn='<a id="btnAnt" class="button small '.$disable.'">Anterior semana</a>';
    
    
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
                foreach ($arrHorarios as $horario){
                    $auxH=explode("-", $horario);
                    $auxH=explode("-", $auxH[0]);
                    $txtHorarios .= "<li> <a onclick='predefineFecha(\"$idSucursal\",\"$idCabina\",\"$fecha\",\"$auxH[0]\")'>$horario</a></li>";
                }
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
    $r->assign('fechasEntre', 'innerHTML', $rango);
    $r->assign('divBtnAnt', 'innerHTML', $btn);
    $r->call('colocaFechas', $fechaFin,$fechaI,$fechaInicio);
    
    return $r;
}

function agendarCita($sucursal, $cabina, $fecha,$hr)
{
    $r = new xajaxResponse();
    
    $_SESSION['citaPredefinida']=array('sucursal'=>$sucursal,'cabina'=>$cabina,'hora'=>$hr,'fecha'=>$fecha);
    
    $r->call('mostrarMsjEspera','Espere un momento...',1);
    $r->redirect('nuevaCita.php',2);
    return $r;
}

$xajax->registerFunction("mostrarHorarios");
$xajax->registerFunction("agendarCita");

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