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
$fecha=date("m-d");

$query = "Select idPaciente, edad from paciente where DATE_FORMAT(fechaNacimiento,'%m-%d')='$fecha' ";
$respuesta = array();
$Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
$resultado = mysqli_query($Conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
        $respuesta[$row_inf['idPaciente']]=$row_inf['edad'];
    }
}

foreach ($respuesta as $idpaciente=>$ed){
    $edad=intval($ed)+1;
    $query = "update paciente set edad=$edad where idPaciente=$idpaciente";
   mysqli_query($Conexion, $query);
}

?>