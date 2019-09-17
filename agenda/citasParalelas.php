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
define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");
define("FOLDER_MODEL_DATA", FOLDER_MODEL . "data/");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

require_once(CLASS_COMUN);

/*
1. listado de citas
2. checar por cada cita si hay otra con mismo horario
3.- si existe, verificar si ya se registró: (cita1=idcita1 y cita2=idcita2) o (cita1=idcita2 y cita2=idcita1) y idusuarioregistrocita1=idusuarioregistroocita2
4.- si no existe, guardar el registro para el que capturó, el idcita en cita1 y el idcita encontrado en cita2
sucursal, usuario, fechas,idcitas,user admin,
5.- si el usuario no es admin, guardar una copia para el admin de la ubicación,
6.- checar si son diferentes usuarios en las 2 citas
 */
$_SESSION['sinfechafin']=true;
require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.citasparalelas.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.usuario.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
$esAdmin=false;
$dosUsuarios=false;
$sucursal= new ModeloSucursal();
//obtener array admins
$admin = new ModeloUsuario();
$arrAdmin =  $admin->obtenerIdsAdmin();
$citas = new ModeloCita();
$fecha=date("Y-m-d H:i:s");
//array de citas próximas
$citas->setFechaInicio($fecha);
$arrCitas=$citas->obtenerCitas();
var_dump($arrAdmin);
foreach ($arrCitas as $diafecha=>$arrCita){
    foreach ($arrCita as $cita){
        $cita1 = new ModeloCita();
        $cita1->setIdCita($cita['idCita']);
        //buscar cita entre el mismo horario
        $arrCita2=$cita1->verificaCitaHora();
        if (count($arrCita2)>0){
            $cita2= new ModeloCita();
            $cita2->setIdCita($arrCita2['idCita']);
            
            $citasparalelas = new ModeloCitasparalelas();
            $citasparalelas->setIdUsuario($cita1->getIdUsuario());
            $citasparalelas->setIdCita1($cita1->getIdCita());
            $citasparalelas->setIdCita2($cita2->getIdCita());
            //si no existe registro
            if (!$citasparalelas->exiteProblemaCitas()){
                var_dump($cita['idCita']);
                $citasparalelas->setIdSucursal($cita1->getIdSucursal());
                $citasparalelas->setFechaRegistro($fecha);
                $citasparalelas->setFechaResolucion($fecha);
                $citasparalelas->setEstatusPendiente();
                $citasparalelas->setActualizable();
                //checar si son diferentes usuarios
                if ($cita1->getIdUsuario()!=$cita2->getIdUsuario()){
                    $citasparalelas2 = new ModeloCitasparalelas();
                    $citasparalelas2->setIdUsuario($cita2->getIdUsuario());
                    $citasparalelas2->setIdCita1($cita2->getIdCita());
                    $citasparalelas2->setIdCita2($cita1->getIdCita());
                    $citasparalelas2->setIdSucursal($cita2->getIdSucursal());
                    $citasparalelas2->setFechaRegistro($fecha);
                    $citasparalelas2->setFechaResolucion($fecha);
                    $citasparalelas2->setEstatusPendiente();
                    $citasparalelas2->setActualizable();
                    $dosUsuarios=true;
                }
               // checar si es un user admin, si no guarda un registro para admin
                if (!in_array($cita1->getIdUsuario(), $arrAdmin)||($dosUsuarios&&!in_array($cita2->getIdUsuario(), $arrAdmin))){
                    $citasparalelas3 = new ModeloCitasparalelas();
                    $sucursal->setIdSucursal($cita1->getIdSucursal());
                    var_dump($admin->obtenerAdminByFranquicia($sucursal->getIdFranquicia()));
                    $citasparalelas3->setIdUsuario(intval($admin->obtenerAdminByFranquicia($sucursal->getIdFranquicia())));
                    $citasparalelas3->setIdCita1($cita1->getIdCita());
                    $citasparalelas3->setIdCita2($cita2->getIdCita());
                    $citasparalelas3->setIdSucursal($cita1->getIdSucursal());
                    $citasparalelas3->setFechaRegistro($fecha);
                    $citasparalelas3->setFechaResolucion($fecha);
                    $citasparalelas3->setEstatusPendiente();
                    $citasparalelas3->unsetActualizable();
                    $citasparalelas3->setIdCitaParalelaAdmin(0);
                    $citasparalelas3->Guardar();
                    //poner el idadmin
                    $citasparalelas->setIdCitaParalelaAdmin($citasparalelas3->getIdCitaParalela());
                    if ($dosUsuarios)
                        $citasparalelas2->setIdCitaParalelaAdmin($citasparalelas3->getIdCitaParalela());
                    
                }else {
                    $esAdmin=true;
                }
                if (!$esAdmin&&$dosUsuarios)
                $citasparalelas2->Guardar();
                $citasparalelas->Guardar();
                var_dump($citasparalelas->getStrError());
                //ligar los idcitasparalelas
                if ($dosUsuarios){
                   $citasparalelas->setIdCitaParalelaOtroUsuario($citasparalelas2->getIdCitaParalela());
                    $citasparalelas2->setIdCitaParalelaOtroUsuario($citasparalelas->getIdCitaParalela());
                    $citasparalelas2->Guardar();
                    $citasparalelas->Guardar();
                }
            }
        }
    }
}

?>