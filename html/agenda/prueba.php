<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
//require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/home/zs5xw0qfuut5/public_html/include/");
    
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
}

define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');

require_once CLASS_CONEXION;

// realizadas
$query = "Select idActualizacion,DATE_FORMAT(c.fechaInicio,'%Y-%m-%d') as fecha from cita as c 
inner join citaactualizacion as ca on c.idCita = ca.idCita where fechaCita='0000-00-00'";
$respuesta = array();
$Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
$resultado = mysqli_query($Conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
        $respuesta[$row_inf['idActualizacion']]=$row_inf['fecha'];
    }
}

var_dump($respuesta);

foreach ($respuesta as $idCita=>$fecha){
    $query = "update citaactualizacion set fechaCita='$fecha' where idActualizacion=$idCita";
    mysqli_query($Conexion, $query);
}

?>