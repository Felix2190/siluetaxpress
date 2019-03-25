<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.bloqueos.inc.php";
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


function bloquearPaciente($paciente,$motivo){
    $r=new xajaxResponse();
    global $objSession;
    
    $bloqueos = new ModeloBloqueos();
    
    $bloqueos->setIdPaciente($paciente);
    $bloqueos->setMotivo($motivo);
    $bloqueos->setIdUsuario($objSession->getidUsuario());
    $bloqueos->setFecha(date("Y-m-d H:i:s"));
    $bloqueos->setIdSucursal($objSession->getIdSucursal());
    
    $bloqueos->Guardar();
    if ($bloqueos->getError()){
        $r->call('mostrarMsjError',$bloqueos->getStrError(),5);
        return $r;
    }
    
    $r->call('mostrarMsjExito','Se bloque&oacute; correctamente al paciente!',3);
    $r->call('actualizar');
    
    
    
    return $r;
    
}

$xajax->registerFunction("bloquearPaciente");



function tablaBloqueos($informacion){
    $r=new xajaxResponse();
    global $objSession;
    
    if (count($informacion)<1){
        $tabla="<i>No hay registros. <br /></i>";
    }else{
    $arrEncabezado=array('Paciente','Responsable','Fecha','Motivo','Opciones');
    
    $tabla="<div class='3u 12u$(xsmall)'><h4>Lista</h4></div><table><thead><tr>";
    
    foreach ($arrEncabezado as $idem){
        $colspan="";
        if ($idem=='Motivo')
            $colspan=" colspan='2'";
            
       $tabla.="<th $colspan>$idem</th>";
    }
    
    $tabla.="</tr></thead><tbody>";
    
    foreach ($informacion as $idBloqueo=>$registro){
        $fecha=explode("-", $registro['fecha']);       
        
            $tabla.="<tr><td>".$registro['nombreP']." </td><td >".$registro['nombreUsuario']."</td><td> $fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0] </td>
                   <td colspan='2'>".$registro['motivo']."</td>";
            $tabla.="<td><a onclick='verOpciones(\"".$registro['idBloqueo']."\")' class='button special small'>Activar</a></td></tr>";
    }
        $tabla.="</tbody></table></div></div><br />";
    }
    $r->assign('divTabla', 'innerHTML', $tabla);
    return $r;
    
}
$xajax->registerFunction("tablaBloqueos");


$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>