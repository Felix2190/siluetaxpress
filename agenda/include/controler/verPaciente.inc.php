<?php
error_reporting(E_ALL ^ E_NOTICE);
// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
function obtenMes($numMes){
    $MESES=  array (
        "1"=>"Enero",
        "2"=>"Febrero",
        "3"=>"Marzo",
        "4"=>"Abril",
        "5"=>"Mayo",
        "6"=>"Junio",
        "7"=>"Julio",
        "8"=>"Agosto",
        "9"=>"Septiembre",
        "10"=>"Octubre",
        "11"=>"Noviembre",
        "12"=>"Diciembre"
    );
    if ($numMes=='')
        return $MESES;
        return $MESES[''.$numMes];
}


// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();


function verPDF($b){
    $r=new xajaxResponse();
    $aux =$_SESSION['verPaciente'];
    $idPaciente=$aux['idPaciente'];
   $r->redirect("getHojaClinicaPDF.php?idPaciente=$idPaciente&firma=$b",3);
    return $r;
}

$xajax->registerFunction("verPDF");

function seguimiento($idPaciente){
    $r=new xajaxResponse();
    
    $_SESSION['verSeg']=$idPaciente;
    $r->call('mostrarMsjEspera','Consultando informaci&oacute;n ...',2);
    $r->redirect("seguimiento.php",3);
    return $r;
}
$xajax->registerFunction("seguimiento");


$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

if (!isset($_SESSION['verPaciente'])){
    header("Location: listadoPacientes.php");
}

$aux =$_SESSION['verPaciente'];
$titulo=$aux['titulo'];
$idPaciente=$aux['idPaciente'];

$paciente = new ModeloPaciente();
$paciente->setIdPaciente($idPaciente);

if ($paciente->getIdPaciente()>0){
    $hojaClinica=new ModeloHojaclinica();
    
    $hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
    
}else {
    header("Location: listadoPacientes.php");
}

?>