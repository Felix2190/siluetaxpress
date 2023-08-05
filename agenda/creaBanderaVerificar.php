<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');

if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
    
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
}
define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');

require_once CLASS_CONEXION;
$fecha=date("Y-m-d H:i:s");

// realizadas
$query = "update cita set verificaAsistencia=1 where ('$fecha' >=fechaVerificaAsistencia and '$fecha'<=fechaFin) and estatus='curso' and verificaAsistencia=0 ";
$Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
$resultado = mysqli_query($Conexion, $query);

?>