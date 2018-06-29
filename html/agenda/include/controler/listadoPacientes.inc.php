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

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();


function verTabla($informacion){
    $r=new xajaxResponse();
    global $objSession;
    
    $arrEncabezado=array("Nombre","Tel&eacute;fono","Completitud [hoja cl&iacute;nica]","Registro","Consultas realizadas","Consultas pr&oacute;ximas","Cita pr&oacute;xima","Opciones");
    if ($objSession->getidRol()==1)
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
                $sucursal="";
                if ($objSession->getidRol()==1)
                    $sucursal="<td>".$paciente['sucursal']."</td>";
                    
                $citaProxima="-";
                if ($paciente['fechaProxima']!=NULL)
                    $citaProxima="<a onClick='verCita(".$paciente['cita'].")'>".$paciente['fechaProxima']." </a>";
                    
                    
                    $tabla.="<tr><td colspan='2'>".$paciente['nombreP']."</td>$sucursal<td>".$paciente['telefonoCel']."</td><td>".$paciente['completitud']."%</td><td>".$paciente['fecha']."</td>
                    <td>".$paciente['consultasHechas']."</td><td>".$paciente['consultasProximas']."</td><td>".$citaProxima."</td>
                    <td><a onClick='verPaciente(".$paciente['idPaciente'].")'>Ver detalles</a></td></tr>";
            }
            $tabla.="</tbody></table></div></div><br />";
        
        $r->assign('divTabla', 'innerHTML', $tabla);
        return $r;
        
}

$xajax->registerFunction("verTabla");

function verPaciente($idPaciente){
    $r=new xajaxResponse();
    
    $_SESSION['editaPaciente']=array('titulo'=>'Detalles del paciente','idPaciente'=>$idPaciente);
    $r->call('mostrarMsjEspera','Consultando detalles del paciente...',2);
    $r->redirect("editaPaciente.php",3);
    return $r;
}
$xajax->registerFunction("verPaciente");

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