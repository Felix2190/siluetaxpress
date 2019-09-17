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


function mostrarInformacion($informacion)
{
    $r = new xajaxResponse();
    $arrTitulos=array("Fecha","Horario","Lugar","Paciente","Usuario","Modificar");
    $tabla = "";$c1=$c2=$user=$odcita=0;
    global $objSession;
    if (count($informacion) > 0) {
        $t=0; 
        foreach ($informacion as $id => $arr){
            if ($t==0)
                $tabla .= "</tbody></table><br />";
            $t++;
             if ($c1!=intval($arr['idCita'])&&$c2!=intval($arr['idCita'])){  
                 $tabla .= "<table><thead><tr>";
                 foreach ($arrTitulos as $titulo)
                    $tabla .= "<th>$titulo</th>";
                 $tabla.="</tr></thead><tbody>";
             }            
            
             if ($user!=intval($arr['idUsuario'])||$odcita!=intval($arr['idCita'])){
                 $tabla .= "<tr><td>" . $arr['fecha'] . "</td><td>".$arr['hora']." a " . $arr['horaFin'] . "</td>
                     <td>".$arr['sucursal']."<br />".$arr['cabina']."</td><td>" . $arr['nombre_paciente'] . "</td><td>" . $arr['nombre_usuario'] . "</td>";
            if (intval($arr['actualizable'])==1&&$objSession->getidUsuario()==$arr['idUsuario'])
                $tabla .= "<td><a onclick='verCita(\"".$arr['idCita']."\")'><img src='images/editaCita.png' title='Ver/editar' style='width: 34px' /></a></td></tr>";
             }else {
                 $tabla .= "<td></td></tr>";
             }
                $c1=intval($arr['idCita1']);
                $odcita=intval($arr['idCita']);
                $c2=intval($arr['idCita2']);
                $user=intval($arr['idUsuario']);
        }
        $tabla .= "</tbody></table><br />";
        
    }
    
    $r->assign('divCitas', 'innerHTML', $tabla);
    return $r;
}
$xajax->registerFunction("mostrarInformacion");


function verCita($idCita){
    $r=new xajaxResponse();
    $_SESSION['notifCita']=$idCita;
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