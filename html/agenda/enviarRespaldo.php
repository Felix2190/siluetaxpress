<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
// require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/home/zs5xw0qfuut5/public_html/include/");
    define("FOLDER_INCLUDE_AGENDA", "/home/zs5xw0qfuut5/public_html/agenda/include/");
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/agenda/include/");
}

define("CLASS_CONEXION", FOLDER_INCLUDE . 'Conexion/configuracionBD.php');

require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");


$fechaActual = date("Y-m-d H:i:s");
$horaActual= intval(date("H"));

$backup_file = "respaldo_" .date("Ymd"). ".sql";

// comandos a ejecutar
$commands = array(
    "mysqldump --opt -h ".BD_HOST." -u ".BD_USER." -p".BD_PASS." ".BD_DB." > ../../tmp/resp/$backup_file"
);

// ejecución y salida de éxito o errores
foreach ( $commands as $command ) {
   system($command,$output);
    //echo $output;
}

    require_once(FOLDER_LIB.'PHPMailer/class.phpmailer.php');
    require_once(FOLDER_LIB."PHPMailer/class.smtp.php");
    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "a2plcpnl0309.prod.iad2.secureserver.net ";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 25;
    $mailWeb->Username = "admin@siluetaexpress.com.mx";
    $mailWeb->Password = "admin2018.";
    $mailWeb->SetFrom("admin@siluetaexpress.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->AddReplyTo("admin@siluetaexpress.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->Subject ="Respaldo ".date("d/m/Y");
    $mailWeb->AltBody = "Respaldo de @siluetaexpress.com.mx";
    $mailWeb->MsgHTML("Respaldo de @siluetaexpress.com.mx");
    $mailWeb->AddAddress("lic.lezliedelariva@gmail.com");
    $mailWeb->addAttachment("../../tmp/resp/$backup_file");
    try
    {
        echo $mailWeb->Send();
    
    }catch(Exception $e){
        echo $e;
    }


?>