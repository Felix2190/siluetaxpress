<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
// require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
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

require_once(CLASS_COMUN);
require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
$clave = new ModeloClaves();
$claveCorreo = $clave->obtenerClaveByReferencia("correo_agenda");

//define("CLASS_CONEXION", FOLDER_INCLUDE . 'Conexion/configuracionBD.php');

define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");


$fechaActual = date("Y-m-d H:i:s");
$horaActual= intval(date("H"));

$backup_file = "/var/www/vhosts/siluetaexpress.com.mx/resp/respaldo_" .date("YmdH"). ".sql";

// comandos a ejecutar
$commands = array(
    "mysqldump --opt -h ".BD_HOST." -u ".BD_USER." -p".BD_PASS." ".BD_DB." > $backup_file"
);

// ejecución y salida de éxito o errores
foreach ( $commands as $command ) {
   system($command,$output);
    //echo $output;
}
sleep(10);
    require_once(FOLDER_LIB.'PHPMailer/class.phpmailer.php');
    require_once(FOLDER_LIB."PHPMailer/class.smtp.php");
    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "smtp.ionos.mx";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "soporte@siluetaexpress.com.mx";
    $mailWeb->Password = $claveCorreo;
    $mailWeb->SetFrom("soporte@siluetaexpress.com.mx", "Soporte SiluetaExpress");
    //    $mailWeb->AddReplyTo("siluetaexpress@pruebassointec.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->Subject ="Respaldo ".date("d/m/Y");
    $mailWeb->AltBody = "Respaldo de @siluetaexpress.com.mx";
    $mailWeb->MsgHTML("Respaldo de @siluetaexpress.com.mx");
    $mailWeb->AddAddress("lic.lezliedelariva@gmail.com");
    $mailWeb->AddAddress("ortizfelix9021@gmail.com");
    $mailWeb->addAttachment("$backup_file");
    try
    {
        echo $mailWeb->Send();
    
    }catch(Exception $e){
        echo $e;
    }


?>