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

$fechaActual = date("Y-m-d");
$horaActual= intval(date("H"));

if ($horaActual>=8&&$horaActual<=20){
  $auxFecha = strtotime('-1 day', strtotime($fechaActual));

$dia = date('N', $auxFecha);

if ($dia != 1) { // no es lunes
    $Conexion = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_DB);
    $fechaInicial = date("Y-m-d",$auxFecha);
    //($numPaciente, $consulta, $dia, $hora, $sucursal, $idConsulta)
    $query = "Select c.idCita, p.telefonoCel, p.nombre, co.tipoConsulta, s.numTelefono, s.sucursal, DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora from cita as c 
            inner join paciente as p on c.idPaciente=p.idPaciente
            inner join sucursal as s on c.idSucursal=s.idSucursal
            inner join consulta as co on c.idConsulta=co.idConsulta
            where c.estatus='nueva' and recordatorio1=0 and enviarRecordatorio1=1 and fechaRegistroCita>='$fechaInicial' and fechaRegistroCita<='$fechaActual'";
    $resultado = mysqli_query($Conexion, $query);
    $respuesta = array();
//    var_dump(mysqli_fetch_assoc($resultado));
//    echo $query;
     if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($row_inf = mysqli_fetch_assoc($resultado)){
             $sms= enviaSMS_CitaNueva("52".$row_inf['telefonoCel'], $row_inf['tipoConsulta'], $row_inf['fecha'],$row_inf['hora'], $row_inf['sucursal'], $row_inf['numTelefono']);
            sleep(2);
             if ($sms==1)
                 $respuesta[]=$row_inf['idCita'];
             }
           }
           
           foreach ($respuesta as $idCita){
               $query = "update cita set recordatorio1=1, fechaEnvioSMS='".date("Y-m-d H:i:s")."' where idCita=$idCita";
               mysqli_query($Conexion, $query);
           }
}
}

?>