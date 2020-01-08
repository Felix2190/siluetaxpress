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


function guardar($nombre,$texto,$arrNombre,$seccion,$rutas){
    $r=new xajaxResponse();
    global $objSession;
    $notif= new ModeloNotificacion();
    $notif->setFechaRegistro(date("Y-m-d H:i:s"));
    $notif->setIdSucursal($objSession->getIdSucursal());
    $notif->setIdUsuario($objSession->getidUsuario());
    $notif->setNombre($nombre);
    $notif->setTexto($texto);
    $notif->setTipo($seccion);
    if ($seccion=="Correo"){
        foreach ($rutas as $id=>$ruta){
            switch ($id){
                case 0:
                    $notif->setImagen1($ruta);
                    break;
                case 1:
                    $notif->setImagen2($ruta);
                    break;
                case 2:
                    $notif->setImagen3($ruta);
                    break;
                case 3:
                    $notif->setImagen4($ruta);
                    break;
                case 4:
                    $notif->setImagen5($ruta);
                    break;
                    
            }
        }
    }
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