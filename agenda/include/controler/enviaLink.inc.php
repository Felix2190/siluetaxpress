<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.encuesta.inc.php";
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


function guardarEncuesta($idPaciente){
    $r=new xajaxResponse();
    global $objSession;
    
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($idPaciente);
    
    $encuesta = new ModeloEncuesta();
    $encuesta->setIdSucursal($objSession->getIdSucursal());
    $encuesta->setIdTipoConsulta(1);
    $encuesta->setIdPaciente($idPaciente);
    $encuesta->setIdUsuarioRegistro($objSession->getidUsuario());
    $encuesta->setEvaluacion(0);
    $encuesta->unsetEstatus();
    $encuesta->setFechaRegistro(date("Y-m-d H:i:s"));
    $encuesta->Guardar();
    if ($encuesta->getError()){
        $r->call("mostrarMsjError","Ocurri&oacute; un error, int&eacute;ntelo m&aacute;s tarde! ",5);
        return $r;
    }
    
    $r->call('mostrarMsjExito','Se agreg&oacute; correctamente la encuesta!',4);
    //$r->call('enviaLink',$paciente->getTelefonoCel(),utf8_encode('Silueta Express le agradece su preferencia. Por favor podría realizar una encuesta de Satisfación en el sig. link? https://bit.ly/3GVXqnM ingresando el ID ').$encuesta->getIdEncuesta(),4);
    $r->call('enviaLink',$paciente->getTelefonoCel(),utf8_encode('Silueta Express agradece tu visita. Ayúdanos a mejorar el servicio contestando esta pequeña encuesta ANÓNIMA de 3 preguntas rápidas link https://bit.ly/3GVXqnM ingresando el ID ').$encuesta->getIdEncuesta(),4);
    $r->redirect("enviaLink.php",3);
        
        return $r;
    
}

$xajax->registerFunction("guardarEncuesta");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>