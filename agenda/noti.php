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
require_once CLASS_COMUN;
require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.notificacion_paciente.inc.php";

$inner=" inner join sucursal as s on p.idSucursal=s.idSucursal ";
$where = " p.telefonoCel<>'' ";

$query = "Select  distinct p.telefonoCel as id, p.idPaciente from paciente as p $inner where $where and p.estatus='activo' and s.idSucursal in (3,4)";

$Conexion = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_DB);

$resultado = mysqli_query($Conexion, $query);
$respuesta = array();
//    var_dump(mysqli_fetch_assoc($resultado));
echo $query;
$fechaActual = date("Y-m-d H:i:s");

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row_inf = mysqli_fetch_assoc($resultado)){
        $envioNotif= new ModeloNotificacion_paciente();
        $envioNotif->setIdNotificacion(2);
        $envioNotif->setIdPaciente($row_inf['idPaciente']);
        $envioNotif->setEstatusEspera();
        $envioNotif->setFechaEnvio($fechaActual);
//        $envioNotif->Guardar();
    }
}
?>