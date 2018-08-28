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


function buscarCitas($informacion){
    $r=new xajaxResponse();
    global $objSession;
    
    $arrEncabezado=array('Fecha','Hora','Paciente','Consulta','Cabina','Estatus','Opciones');
    if ($objSession->getidRol()==1)
        $arrEncabezado=array('Fecha','Hora','Paciente','Sucursal','Consulta','Cabina','Estatus','Opciones');
    $tabla="";
        
            $tabla.="<div class='row'><div class='12u'><table><thead><tr>";
            foreach ($arrEncabezado as $idem){
                 $tabla.="<th>$idem</th>";
            }
            
            $tabla.="</tr></thead><tbody>";
            foreach ($informacion as $cita){
                $opciones="<td></td>";
                    $sucursal="";
                if ($objSession->getidRol()==1)
                    $sucursal="<td>".$cita['sucursal']."</td>";
       //         if ($objSession->getidRol()==1||$objSession->getidUsuario()==$cita['idUsuario'])
                    $opciones="<td><a onclick='verCita(\"".$cita['idCita']."\")'><img src='images/editaCita.png' title='Ver/editar' style='width: 34px' /></a></td>";
                
                                        
                    $tabla.="<tr><td>".$cita['fecha']."</td><td>".$cita['hora']."</td><td>".$cita['nombre_paciente']."</td>$sucursal
                <td>".$cita['tipoConsulta']."</td><td>".$cita['cabina']."</td><td>".$cita['descripcion']."</td>$opciones</tr>";
            }
            $tabla.="</tbody></table></div></div><br />";
        
        
        $r->assign('divTabla', 'innerHTML', $tabla);
               return $r;
        
}



$xajax->registerFunction("buscarCitas");

function verCita($idCita){
    $r=new xajaxResponse();
    
    $_SESSION['verCita']=array('titulo'=>'Detalles de la cita','idCita'=>$idCita);
    $r->call('mostrarMsjEspera','Consultando informaci&oacute;n de la cita...',1);
    $r->redirect("verCita.php",2);
    return $r;
}
$xajax->registerFunction("verCita");


$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>