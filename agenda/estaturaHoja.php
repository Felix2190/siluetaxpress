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

define("CLASS_CONEXION", FOLDER_INCLUDE . 'Conexion/Conexion.php');

require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
$Conexion = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_DB);

/*
$query = "Select idHojaClinica, estatura FROM hojaseguimiento as hs 
            inner join paciente as p on hs.idPaciente=p.idPaciente";
$resultado = mysqli_query($Conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
$query = "update hojaclinica set estatura=".$row_inf['estatura']." where idHojaClinica=".$row_inf['idHojaClinica'];
        mysqli_query($Conexion, $query);
    }
 }
*/
$query = "Select idHojaSeguimiento, fechaRegistro FROM hojaseguimiento ";
$resultado = mysqli_query($Conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
        $query = "update hojaseguimiento set fechaSeguimiento='".$row_inf['fechaRegistro']."' where idHojaSeguimiento=".$row_inf['idHojaSeguimiento'];
        mysqli_query($Conexion, $query);
    }
}

?>