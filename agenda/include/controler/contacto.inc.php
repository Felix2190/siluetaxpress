<?php
// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.persona_contacto.inc.php";
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
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

function guardar($txtNombre,$txtApellidos,$txtTelefono,$txtCorreo,$txtComentarios){
    $r=new xajaxResponse();
    
    
    $contacto=new ModeloPersona_contacto();
    $contacto->setFecha(date("Y-m-d H:i:s"));
    $contacto->setNombre($txtNombre);
    $contacto->setApellidos($txtApellidos);
    $contacto->setTelefono($txtTelefono);
    $contacto->setComentarios($txtComentarios);
    $contacto->setCorreo($txtCorreo);
    
    $contacto->Guardar();
    if ($contacto->getError()){
        $r->call('mostrarMsjError',$contacto->getStrSystemError(),5);
        return $r;
    }
    
    
    $mensaje="Hola Lezlie!  <br />Una persona ha escrito un comentario en la p&aacute;gina. [".$contacto->getFecha()."]<br /> <br />
    <b>Nombre: </b> $txtNombre $txtApellidos<br />
    <b>Telefono: </b> $txtTelefono <br />
    <b>Correo: </b> $txtCorreo <br />
    <b>Comentarios: </b> $txtComentarios";
    
    if (enviar_mail("lic.lezliedelariva@gmail.com", "Notificación de comentario", $mensaje)){
        $r->call('mostrarMsjExito','Se ha enviado sus datos al administrador!',8);
    }else {
        $r->call('mostrarMsjError','Ocurri&oacute; un error... int&eacute;ntelo m&aacute;s tarde.',4);
    }
    $r->call("limpiarDatos",$txtCorreo);
    return $r;
    
}
$xajax->registerFunction("guardar");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>