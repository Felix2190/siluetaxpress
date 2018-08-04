<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
//require_once FOLDER_MODEL_EXTEND. "model..inc.php";
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


function verTabla($informacion,$sucursal){
    $r=new xajaxResponse();
    global $objSession;
    
    $arrEncabezado=array("Nombre","Tel&eacute;fono","Completitud [hoja cl&iacute;nica]","Registro","Consultas realizadas","Consultas pr&oacute;ximas","Cita pr&oacute;xima","Opciones");
    if ($objSession->getidRol()==1&&$sucursal=='')
        $arrEncabezado=array("Nombre","Tel&eacute;fono","Sucursal","Completitud [hoja cl&iacute;nica]","Registro","Consultas realizadas","Consultas pr&oacute;ximas","Cita pr&oacute;xima","Opciones");
        
            $tabla="<div class='row'><div class='12u'><table><thead><tr>";
            foreach ($arrEncabezado as $idem){
                $colspan="";
                if ($idem=='Nombre')
                    $colspan=" colspan='2'";
                        $tabla.="<th $colspan>$idem</th>";
            }
            
            $tabla.="</tr></thead><tbody>";
            foreach ($informacion as $paciente){
                
                if ($objSession->getidRol()==1&&$sucursal=='')
                    $txtSucursal="<td>".$paciente['sucursal']."</td>";
                else
                    $txtSucursal="";
                $citaProxima="-";
                if ($paciente['fechaProxima']!=NULL){
                    $fechaCita=explode("-", $paciente['fechaProxima']);
                    $citaProxima="<a onClick='verCita(".$paciente['cita'].")'> <img src='images/editaCita.png' title='$fechaCita[2] de ".obtenMes(''.intval($fechaCita[1]))." del $fechaCita[0]' style='width: 30px' /></a></a>";
                    }
                    $fecha=explode("-", $paciente['fecha']);
                    
                    $tabla.="<tr><td colspan='2'>".$paciente['nombreP']."</td><td>".$paciente['telefonoCel']."</td>$txtSucursal<td>".$paciente['completitud']."%</td>
                    <td>$fecha[2]/".obtenMes(''.intval($fecha[1]))."/$fecha[0]</td>
                    <td>".$paciente['consultasHechas']."</td><td>".$paciente['consultasProximas']."</td><td>".$citaProxima."</td>
                    <td><a onClick='verPaciente(".$paciente['idPaciente'].")'><img src='images/ver.png' title='Ver' style='width: 30px' /></a>
                    <a onClick='editarPaciente(".$paciente['idPaciente'].")'><img src='images/editPaciente.png' title='editar' style='width: 30px' /></a></td></tr>";
            }
            $tabla.="</tbody></table></div></div><br />";
        
        $r->assign('divTabla', 'innerHTML', $tabla);
        return $r;
        
}

$xajax->registerFunction("verTabla");

function verPaciente($idPaciente){
    $r=new xajaxResponse();
    
    $_SESSION['verPaciente']=array('titulo'=>'Detalles del paciente','idPaciente'=>$idPaciente);
    $r->call('mostrarMsjEspera','Consultando detalles del paciente...',2);
    $r->redirect("verPaciente.php",3);
    return $r;
}
$xajax->registerFunction("verPaciente");

function editarPaciente($idPaciente){
    $r=new xajaxResponse();
    
    $_SESSION['editarPaciente']=array('titulo'=>'','idPaciente'=>$idPaciente);
    $r->call('mostrarMsjEspera','Consultando detalles del paciente...',2);
    $r->redirect("editarPaciente.php",3);
    return $r;
}
$xajax->registerFunction("editarPaciente");


function verCita($idCita){
    $r=new xajaxResponse();
    
    $_SESSION['verCita']=array('idCita'=>$idCita);
    $r->call('mostrarMsjEspera','Consultando informaci&oacute;n de cita...',2);
    $r->redirect("verCita.php",3);
    return $r;
}
$xajax->registerFunction("verCita");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$sucursal='';
if ($objSession->getidRol()!=1){
    $sucursal=$objSession->getIdSucursal();
    
}

?>