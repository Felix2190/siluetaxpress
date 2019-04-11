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

require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';

$fechaActual = date("Y-m-d H:i:s");
$horaActual= intval(date("H"));

if ($horaActual>=8&&$horaActual<=20){
    if ($horaActual>=19)
        $auxFecha = strtotime('+1 day', strtotime($fechaActual));
    else 
        $auxFecha = strtotime('+22 hours', strtotime($fechaActual));

$dia = date('N', $auxFecha);

if ($dia != 6) { // no es sabado
    $Conexion = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_DB);
    
    $query = "Select MIN(entreSemanaEntrada) as entre, MIN(sabadoEntrada) as sabado,numTelefono FROM sucursal";
    $resultado = mysqli_query($Conexion, $query);

    $row_inf = mysqli_fetch_assoc($resultado);
    
    switch ($dia) {
        case 6:
            $hora = $row_inf['sabado'];
            break;
        
        default:
            $hora = $row_inf['entre'];
            break;
    }
    $fechaInicial = date("Y-m-d $hora:00:00", $auxFecha);
    
    $min = intval(date("i"));
    if ($min < 10)
        $minInicio = 0;
    else if ($min < 20)
        $minInicio = 10;
    else if ($min < 30)
        $minInicio = 20;
    else if ($min < 40)
        $minInicio = 30;
    else if ($min < 50)
        $minInicio = 40;
    else if ($min < 59)
        $minInicio = 50;
    
    $fechaFinal = date("Y-m-d H:$minInicio:00",$auxFecha);
    //($numPaciente, $consulta, $dia, $hora, $sucursal, $idConsulta)
    $query = "Select c.idCita, p.telefonoCel, p.nombre, co.tipoConsulta, s.numTelefono, s.sucursal, DATE_FORMAT(fechaInicio,'%Y-%m-%d') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora from cita as c 
            inner join paciente as p on c.idPaciente=p.idPaciente
            inner join sucursal as s on c.idSucursal=s.idSucursal
            inner join consulta as co on c.idConsulta=co.idConsulta
            where c.estatus='nueva' and recordatorio2=0 and enviarRecordatorio2=1 and fechaInicio>='$fechaInicial' and fechaInicio<='$fechaFinal'";
    $resultado = mysqli_query($Conexion, $query);
    $respuesta = array();
//    var_dump(mysqli_fetch_assoc($resultado));
    //echo $query;
     if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($row_inf = mysqli_fetch_assoc($resultado)){
             $sms=enviaSMS_recordatorio("52".$row_inf['telefonoCel'], $row_inf['nombre'], $row_inf['tipoConsulta'], date("d/m/Y",strtotime($row_inf['fecha'])), $row_inf['hora'], $row_inf['sucursal'], $row_inf['numTelefono']);
             sleep(2);
             if ($sms)
                 $respuesta[]=$row_inf['idCita'];
             }
           }
           
           foreach ($respuesta as $idCita){
               $query = "update cita set recordatorio2=1 where idCita=$idCita";
               mysqli_query($Conexion, $query);
           }
}
}
/*
 * // realizadas
 * $query = "Select idCita from cita where (estatus='nueva' or estatus='curso') and fechaInicio <'$fecha' and fechaFin<'$fecha' ";
 * $respuesta = array();
 *
 * if ($resultado && mysqli_num_rows($resultado) > 0) {
 * while ($row_inf = mysqli_fetch_assoc($resultado)){
 * $respuesta[]=$row_inf['idCita'];
 * }
 * }
 *
 * foreach ($respuesta as $idCita){
 * $query = "update cita set estatus='realizada' where idCita=$idCita";
 * mysqli_query($Conexion, $query);
 * }
 *
 * // en curso
 * $query = "Select idCita from cita where estatus='nueva' and fechaInicio <='$fecha' and fechaFin>='$fecha' ";
 * $respuesta = array();
 *
 * $Conexion = new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
 * $resultado = mysqli_query($Conexion, $query);
 * if ($resultado && mysqli_num_rows($resultado) > 0) {
 * while ($row_inf = mysqli_fetch_assoc($resultado)){
 * $respuesta[]=$row_inf['idCita'];
 * }
 * }
 *
 * foreach ($respuesta as $idCita){
 * $query = "update cita set estatus='curso' where idCita=$idCita";
 * mysqli_query($Conexion, $query);
 * }
 */
?>