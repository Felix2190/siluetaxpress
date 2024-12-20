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


function mostrarTabla($informacion)
{
    $r = new xajaxResponse();
    $arrTitulos=array("Nombre","Sucursal","Correo","Tel&eacute;fono","Cargo","Opciones");
    $tabla = "";
    if (count($informacion) > 0) {
        $tabla .= "<table><thead><tr>";
        
        foreach ($arrTitulos as $titulo)
            $tabla .= "<th>$titulo</th>";
        
        $tabla.="</tr></thead><tbody>";
        
        foreach ($informacion as $id => $arr)
            $tabla .= "<tr><td>" . $arr['nombreCompleto'] . "</td><td>" . $arr['sucursal'] . "</td><td>" . $arr['correo'] . "</td>
                        <td>" . $arr['telefonoCel'] . "</td><td>" . $arr['nombre'] . "</td>
                    <td><a onclick='verUsuario(\"".$arr['idUsuario']."\")'><img src='images/ver.png' title='Ver/editar' style='width: 30px' /></a></td></tr>";
            
            $tabla .= "</tbody></table>";
    }
    
    $r->assign('divTabla', 'innerHTML', $tabla);
    return $r;
}
$xajax->registerFunction("mostrarTabla");

function verUsuario($idUsuario){
    $r=new xajaxResponse();
    
    $_SESSION['verUsuario']=array('titulo'=>'','idUsuario'=>$idUsuario);
    $r->call('mostrarMsjEspera','Espere un momento, consultando informaci&oacute;n...',1);
    $r->redirect("verUsuario.php",2);
    return $r;
}
$xajax->registerFunction("verUsuario");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>