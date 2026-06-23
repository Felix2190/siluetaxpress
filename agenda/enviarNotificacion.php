<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
// require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
    define("FOLDER_TMP", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/");
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
require_once FOLDER_INCLUDE_AGENDA.'controler/adminMeta.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.cita_control_whatsapp.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.franquicia.inc.php";

define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");

$fechaActual = date("Y-m-d H:i:s");
$horaActual= intval(date("H"));

$envioNotif= new ModeloNotificacion_paciente();
$paciente= new ModeloPaciente();
$notificacion = new ModeloNotificacion();

if (!function_exists("get_magic_quotes_runtime")){
    function get_magic_quotes_runtime(){
        return false;
    }
}

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
//            array_push($arrImg, "notificaciones/SiluetaExpress(6).jpeg");
            if (enviar_mail_archivos($paciente->getCorreo(), $notificacion->getNombre(), $notificacion->getTexto(),$arrImg)){
                $envioNotif->setEstatusEnviado();
                $envioNotif->setFechaEnvio(date("Y-m-d H:i:s"));
            }else{
                $envioNotif->setEstatusError();
                $envioNotif->setMsjError("Error al enviar el correo");
            }
        }else {
            $envioNotif->setEstatusError();
            $envioNotif->setMsjError("Error al enviar el correo, no v�lido");
        }
        
    }else {
        $envioNotif->setEstatusError();
        $envioNotif->setMsjError("Error al enviar el correo, paciente no encontrado");
    }
    $envioNotif->Guardar();
}

if ($horaActual>=8&&$horaActual<=20||1==1){
//    $MsgE = new errorSMS();
    $arrNotif = $envioNotif->obtenerNotificacionesPendientes("SMS");
    
    foreach ($arrNotif as $idN){
        $envioNotif->setIdNotificacionPaciente($idN);
        $paciente->setIdPaciente($envioNotif->getIdPaciente());
        $notificacion->setIdNotificacion($envioNotif->getIdNotificacion());
        if ($paciente->getIdPaciente()>0&&$notificacion->getIdNotificacion()>0){
           if (strlen($paciente->getTelefonoCel())==10){
               /*
                $sms = enviaSMS("52".$paciente->getTelefonoCel(), $notificacion->getTexto(),$paciente->getIdSucursal());
                sleep(3);
                */
                
                $controlMeta = new ModeloCita_control_whatsapp();
                $pr= $controlMeta->validacion("521".$paciente->getTelefonoCel(),"numeroCelular");
                $fechaEnvio=date( 'Y-m-d H:i:s');
                $resWh=false;
                
                if ($pr[0]==true){
                    if ($pr[1]=="template"){
                        $parametros = array("nombre"=>$paciente->getNombre(),"noti"=>$notificacion->getTexto());
                        $objeto=obtenerJSONMeta("52".$paciente->getTelefonoCel(), $parametros, "promocion");
                    }else {
                        $parametros['texto']="Silueta Express te recomienda: ".$notificacion->getTexto();
                        $objeto=obtenerJSONMeta("52".$paciente->getTelefonoCel(), $parametros);
                    }
                    $sucursal = new ModeloSucursal();
                    $sucursal->setIdSucursal($paciente->getIdSucursal());
                    $franquicia = new ModeloFranquicia();
                    $franquicia->setIdFranquicia($sucursal->getIdFranquicia());
                    
                    $resWh = enviaWhatsapp($objeto, $franquicia->getIdentificadorMeta());
                    sleep(2);
                    
                if ($resWh[0]==true){
                    $envioNotif->setEstatusEnviado();
                    $envioNotif->setFechaEnvio(date("Y-m-d H:i:s"));
                    $envioNotif->setMsjError("");
                }else{
                    $envioNotif->setEstatusError();
                    $envioNotif->setMsjError("No se pudo enviar el whatsapp ".$resWh[1]);
                }
                
                if ($pr[1]=="template"){
                    $controlMeta = new ModeloCita_control_whatsapp();
                    $controlMeta->setIdCita(0);
                    $controlMeta->setIdPlantilla(4);
                    $controlMeta->setIdUsuario(1);
                    $controlMeta->setFechaEnvio($fechaEnvio);
                    $controlMeta->setFechaRespuesta("");
                    $controlMeta->setNumeroCelular("521".$paciente->getTelefonoCel());
                    
                    if ($resWh[0]==true){
                        $controlMeta->setEstatusNoAplica();
                        
                    }else{
                        $controlMeta->setEstatusError();
                        $controlMeta->setErrorMeta($resWh[1]);
                    }
                    
                    $controlMeta->Guardar();
                }
                
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