<?php

define("DEVELOPER", false);

if (! DEVELOPER) {
    /**
     * constantes de producción
     */
    
    define("FOLDER_INCLUDE", "/home/zs5xw0qfuut5/public_html/include/");
    define("FOLDER_INCLUDE_AGENDA", "/home/zs5xw0qfuut5/public_html/agenda/include/");
        
} else {
    /**
     * constantes de desarrollo
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/agenda/include/"); //agenda
    
    define("FOLDER_HTDOCS", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/");
    define("FOLDER_HTDOCS_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/agenda/");//AGENDA
}

/*
 * DEFINIR VARIABLES
 */
define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');


define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");
define("FOLDER_LIB_AGENDA", FOLDER_INCLUDE_AGENDA . "lib/"); //AGENDA

define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");

define("FOLDER_MODEL_DATA", FOLDER_INCLUDE . "model/data/");
define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

require_once(CLASS_COMUN);


require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
include FOLDER_MODEL_EXTEND."model.cita.inc.php";
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';

//$alias = $_POST['alias'];
$mensaje = $_POST['text'];
$telefono = $_POST['telnum'];
$keyword = $_POST['keyword'];
///$shortnum = $_POST['shortnum'];

$mensaje=str_replace($keyword, "", $mensaje);
$mensaje=str_replace(" ","" , $mensaje);
$mensaje=str_replace("C","" , $mensaje);

$cita = new ModeloCita();
$cita->setIdCita($mensaje);
if ($cita->getIdCita()>0&&$cita->getTelefonoPaciente()==$telefono&&$cita->getEstatus()=='nueva'){
    $nSucursal= new ModeloSucursal();
    $nSucursal->setIdSucursal($cita->getIdSucursal());
    $nConsulta= new ModeloConsulta();
    $nConsulta->setIdConsulta($cita->getIdConsulta());
    
    
    $cita->setEstatus("cancelada_paciente");
    $cita->Guardar();
    if (!$cita->getError()){
        enviaSMS($telefono, "Ha cancelado su cita para ".$nConsulta->getTipoConsulta()." en ".$nSucursal->getSucursal());
    }
}


$respuesta="OK";
header("Content-Type: text/plain; charset=UTF-8");
echo $respuesta;
?>