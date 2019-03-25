<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
//require_once 'include/config/constantes.php';
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
$query = "Select idCita from cita where (estatus='nueva' or estatus='curso') and fechaInicio <'$fecha' and fechaFin<'$fecha' ";
$respuesta = array();
$Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
$resultado = mysqli_query($Conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
        $respuesta[]=$row_inf['idCita'];
    }
}

foreach ($respuesta as $idCita){
    $query = "update cita set estatus='realizada' where idCita=$idCita";
   mysqli_query($Conexion, $query);
}

// en curso
$query = "Select idCita from cita where estatus='nueva' and fechaInicio <='$fecha' and fechaFin>='$fecha' ";
$respuesta = array();

$Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
$resultado = mysqli_query($Conexion, $query);
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
        $respuesta[]=$row_inf['idCita'];
    }
}

foreach ($respuesta as $idCita){
    $query = "update cita set estatus='curso' where idCita=$idCita";
   mysqli_query($Conexion, $query);
}

?>