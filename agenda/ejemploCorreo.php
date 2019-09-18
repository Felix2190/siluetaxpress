<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
// require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/include/");
}

define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");

define("CLASS_CONEXION", FOLDER_INCLUDE . 'Conexion/Conexion.php');
define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");
define("FOLDER_MODEL_DATA", FOLDER_MODEL . "data/");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

require_once(CLASS_COMUN);
require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
$clave = new ModeloClaves();
$claveCorreo = $clave->obtenerClaveByReferencia("correo_agenda");

    require_once(FOLDER_LIB.'PHPMailer/class.phpmailer.php');
    require_once(FOLDER_LIB."PHPMailer/class.smtp.php");
    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "smtp.ionos.mx";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "agendasilueta@pruebassointec.com.mx";
    $mailWeb->Password = $claveCorreo;
    $mailWeb->SetFrom("agenda@siluetaexpress.com.mx", "SiluetaExpress @NoReply");
    //    $mailWeb->AddReplyTo("siluetaexpress@pruebassointec.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->Subject ="Respaldo ".date("d/m/Y");
    $mailWeb->AltBody = "Respaldo de @siluetaexpress.com.mx";
    $mailWeb->MsgHTML("Respaldo de @siluetaexpress.com.mx");
    $mailWeb->AddAddress("ortizfelix9021@gmail.com");
    try
    {
        echo $mailWeb->Send();
    
    }catch(Exception $e){
        echo $e;
    }
/*

    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "smtp.ionos.mx";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "agenda@pruebassointec.com.mx";
    $mailWeb->Password = "5!lu37A_xpR3Z_";
    $mailWeb->SetFrom("agenda@siluetaexpress.com.mx", "SiluetaExpress @NoReply");
//    $mailWeb->AddReplyTo("siluetaexpress@pruebassointec.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->Subject ="Respaldo ".date("d/m/Y");
    $mailWeb->AltBody = "Respaldo de @siluetaexpress.com.mx";
    $mailWeb->MsgHTML("Respaldo de @siluetaexpress.com.mx");
    $mailWeb->AddAddress("lic.lezliedelariva@gmail.com");
    $mailWeb->AddAddress("ortizfelix9021@gmail.com");


**/
?>