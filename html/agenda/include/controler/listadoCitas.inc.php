<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
function obtenMes($numMes){
    $MESES=  array (
        "1"=>"Enero",
        "2"=>"Febrero",
        "3"=>"Marzo",
        "4"=>"Abril",
        "5"=>"Mayo",
        "6"=>"Junio",
        "7"=>"Julio",
        "8"=>"Agosto",
        "9"=>"Septiembre",
        "10"=>"Octubre",
        "11"=>"Noviembre",
        "12"=>"Diciembre"
    );
    if ($numMes=='')
        return $MESES;
        return $MESES[''.$numMes];
}

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();

function consultarCitas($informacion){
    $r=new xajaxResponse();
    global $objSession;
    $arrEncabezado=array('ID Consulta', 'Fecha','Hora','Paciente','Consulta','Duraci&oacute;n','Opciones');
    if ($objSession->getidRol()==1) 
        $arrEncabezado=array('ID Consulta', 'Fecha','Hora','Paciente','Consulta','Duraci&oacute;n','Sucursal','Opciones');
    
    $tabla="<table><thead><tr>";
    foreach ($arrEncabezado as $idem){
        $colspan="";
        if ($idem=='Paciente')
           $colspan=" colspan='2'";
        $tabla.="<th $colspan>$idem</th>";
    }
    
    $tabla.="</tr></thead><tbody>";
    foreach ($informacion as $cita){
        $sucursal="";
        if ($objSession->getidRol()==1)
            $sucursal="<td>".$cita['sucursal']."</td>";
        $fecha=explode("-", $cita['fecha']);
        
        $hr=intval($cita['duracion']/60);
        $min=$cita['duracion']%60;
        $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
        
        $tabla.="<tr><td>".$cita['idCita']."</td><td>$fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0]</td><td>".$cita['hora']."</td><td colspan='2'>".$cita['nombre_paciente']."</td>
                <td>".$cita['tipoConsulta']."</td><td>".$duracion."</td>$sucursal<td></td></tr>";
    }
    $tabla.="</tbody></table>";
    
    $r->assign('divTabla', 'innerHTML', $tabla);
    return $r;
    
}
$xajax->registerFunction("consultarCitas");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
//$citas = new ModeloCita();
$paciente=$usuario=$consulta=$sucursal='';
if (isset($_SESSION['altaCita'])){
    $paciente=$_SESSION['altaCita'];
    
    $pacient= new ModeloPaciente();
    $pacient->setIdPaciente($paciente);
    $Nombre=$pacient->getNombre();
    $Apellidos=$pacient->getApellidos();
}
if ($objSession->getidRol()!=1){
    $usuario=$objSession->getidUsuario();
    $sucursal=$objSession->getIdSucursal();
    
}

?>