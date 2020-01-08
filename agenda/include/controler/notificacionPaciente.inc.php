<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.notificacion.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.notificacion_paciente.inc.php";
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


function guardar($nombre,$texto,$arrNombre,$seccion){
    $r=new xajaxResponse();
    global $objSession;
    $notif= new ModeloNotificacion();
    $notif->setFechaRegistro(date("Y-m-d H:i:s"));
    $notif->setIdSucursal($objSession->getIdSucursal());
    $notif->setIdUsuario($objSession->getidUsuario());
    $notif->setNombre($nombre);
    $notif->setTexto($texto);
    $notif->setTipo($seccion);
    $notif->Guardar();
    if ($notif->getError()){
        $r->call("mostrarMsjError",$notif->getStrError());
        return $r;
    }
    $errores=0;
    foreach ($arrNombre as $idPaciente){
        $notifPaciente = new ModeloNotificacion_paciente();
        $notifPaciente->setIdNotificacion($notif->getIdNotificacion());
        $notifPaciente->setEstatusEspera();
        $notifPaciente->setFechaEnvio($notif->getFechaRegistro());
        $notifPaciente->setIdPaciente($idPaciente);
        $notifPaciente->Guardar();
        if ($notif->getError()){
            $errores++;
        }
    }
    $r->call("mostrarMsjExito","Se ha regristrado la notificaci&oacute;n. ".($errores>0?("$errores $seccion no se enviar&aacute;n"):""),5);
    $r->redirect("notificacionPaciente.php",3);
    return $r;
    
}

$xajax->registerFunction("guardar");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$Susurcal = new ModeloSucursal();
$arrSucursal=$Susurcal->obtenerSucuralesFranquiciaSesion();

?>