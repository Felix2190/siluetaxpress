<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.hojaClinica.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();

function guardar($txtNombre, $txtApellidos, $txtTelCasa, $txtTelMovil, $txtEmail,$txtEdad){
    global $objSession;
    
    $r=new xajaxResponse();
    
    $hojaClinica = new ModeloHojaClinica();
    $hojaClinica->setEdad($txtEdad);
    $hojaClinica->setFechaRegistro(date('Y-m-d H:i:s'));
    $hojaClinica->Guardar();
    if ($hojaClinica->getError()){
        $r->call('mostrarMsjError',$hojaClinica->getStrError(),5);
        return $r;
    }
    
    $paciente = new ModeloPaciente();
    $paciente->setNombre($txtNombre);
    $paciente->setApellidos($txtApellidos);
    $paciente->setTelefonoCasa($txtTelCasa);
    $paciente->setTelefonoCel($txtTelMovil);
    $paciente->setCorreo($txtEmail);
    $paciente->setIdHojaClinica($hojaClinica->getIdHojaClinica());
    $paciente->setIdUsuarioRegistro($objSession->getidUsuario());
    
    $paciente->Guardar();
    if ($paciente->getError()){
        $r->call('mostrarMsjError',$paciente->getStrError(),5);
        return $r;
    }
    
    $r->call('mostrarMsjExito','Se agreg&oacute; correctamente al paciente!',3);
    $r->call('limpiarDatos');
    return $r;
    
}

$xajax->registerFunction("guardar");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>