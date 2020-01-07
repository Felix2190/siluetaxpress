<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
// require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
    define("FOLDER_TMP", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/tmp/");
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/agenda/include/");
}

define("CLASS_CONEXION", FOLDER_INCLUDE . 'Conexion/Conexion.php');
define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");
define("FOLDER_MODEL_DATA", FOLDER_MODEL . "data/");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");
require_once CLASS_COMUN;
require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.notificacion.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.notificacion_paciente.inc.php";
define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");

$fechaActual = date("Y-m-d H:i:s");
$horaActual= intval(date("H"));

$envioNotif= new ModeloNotificacion_paciente();
$paciente= new ModeloPaciente();
$notificacion = new ModeloNotificacion();

$arrNotif = $envioNotif->obtenerNotificacionesPendientes("Correo");
foreach ($arrNotif as $idN){
    $envioNotif->setIdNotificacionPaciente($idN);
    $paciente->setIdPaciente($envioNotif->getIdPaciente());
    $notificacion->setIdNotificacion($envioNotif->getIdNotificacion());
    if ($paciente->getIdPaciente()>0&&$notificacion->getIdNotificacion()>0){
        if ($paciente->getCorreo()!=""){
            $arrImg=array();
            if ($notificacion->getImagen1() != "")
                array_push($arrImg, $notificacion->getImagen1());
            if ($notificacion->getImagen2() != "")
                array_push($arrImg, $notificacion->getImagen2());
            if ($notificacion->getImagen3() != "")
                array_push($arrImg, $notificacion->getImagen3());
            if ($notificacion->getImagen4() != "")
                array_push($arrImg, $notificacion->getImagen4());
            if ($notificacion->getImagen5() != "")
                array_push($arrImg, $notificacion->getImagen5());
            array_push($arrImg, "notificaciones/SiluetaExpress(6).jpeg");
            if (enviar_mail_archivos($paciente->getCorreo(), $notificacion->getNombre(), $notificacion->getTexto(),$arrImg)){
                $envioNotif->setEstatusEnviado();
                $envioNotif->setFechaEnvio(date("Y-m-d H:i:s"));
            }else{
                $envioNotif->setEstatusError();
                $envioNotif->setMsjError("Error al enviar el correo");
            }
        }else {
            $envioNotif->setEstatusError();
            $envioNotif->setMsjError("Error al enviar el correo, no válido");
        }
        
    }else {
        $envioNotif->setEstatusError();
        $envioNotif->setMsjError("Error al enviar el correo, paciente no encontrado");
    }
    $envioNotif->Guardar();
}

if ($horaActual>=8&&$horaActual<=20){
    
    $arrNotif = $envioNotif->obtenerNotificacionesPendientes("SMS");
    
    foreach ($arrNotif as $idN){
        $envioNotif->setIdNotificacionPaciente($idN);
        $paciente->setIdPaciente($envioNotif->getIdPaciente());
        $notificacion->setIdNotificacion($envioNotif->getIdNotificacion());
        if ($paciente->getIdPaciente()>0&&$notificacion->getIdNotificacion()>0){
           if (strlen($paciente->getTelefonoCel())==10){
               $sms = enviaSMS("52".$paciente->getTelefonoCel(), $notificacion->getTexto());
                sleep(3);
                if ($sms){
                    $envioNotif->setEstatusEnviado();
                    $envioNotif->setFechaEnvio(date("Y-m-d H:i:s"));
                }else{
                    $envioNotif->setEstatusError();
                    $envioNotif->setMsjError("Error al enviar el SMS");
                }
           }else {
               $envioNotif->setEstatusError();
               $envioNotif->setMsjError("La longitud del teléfono es incorrecta [".strlen($paciente->getTelefonoCel())."]");
           }
        }
        $envioNotif->Guardar();
    }
}

?>