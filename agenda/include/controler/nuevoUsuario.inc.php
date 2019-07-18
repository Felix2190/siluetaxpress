<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.usuario.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.usuariosucursal.inc.php";
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


function guardarUsuario($nombre, $apellidos, $Cargo, $correo, $telefono, $userName, $arrSucursal){
    $r=new xajaxResponse();
    global $objSession;
    $passw=substr( md5(microtime()), 1, 10);
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $passw. $random_salt);
    
    $usuario = new ModeloUsuario();
    $usuario->setNombre($nombre);
    $usuario->setApellidos($apellidos);
    $usuario->setCorreo($correo);
    $usuario->setTelefonoCel($telefono);
    $usuario->setIdSucursal($arrSucursal[0]);
    $usuario->setIdFranquicia($objSession->getIdFranquicia());
    $usuario->setIdTipoUsuario($Cargo);
    $usuario->setFoto("../tmp/fotosperfil/perfil.png");
    
    $usuario->Guardar();
    if ($usuario->getError()){
        $r->call('mostrarMsjError',$usuario->getStrError(),5);
        return $r;
    }
    
    foreach ($arrSucursal as $sucursal){
        $usuarioSucursal = new ModeloUsuariosucursal();
        $usuarioSucursal->setIdSucursal($sucursal);
        $usuarioSucursal->setIdUsuario($usuario->getIdUsuario());
        $usuarioSucursal->setFechaAlta(date("Y-m-d"));
        $usuarioSucursal->setEstatusActivo();
        $usuarioSucursal->Guardar();
        if ($usuarioSucursal->getError()){
            $r->call('mostrarMsjError',$usuarioSucursal->getStrError(),5);
            return $r;
        }
        
    }
    
    $login = new ModeloLogin();
    $login->setIdUsuario($usuario->getIdUsuario());
    $login->setEstatusActivo();
    $login->setUserName($userName);
    $login->setPassword($password);
    $login->setSalt($random_salt);
    $login->setIdRol($Cargo);
    
    $login->Guardar();
    if ($login->getError()){
        $r->call('mostrarMsjError',$login->getStrError(),5);
        return $r;
    }
    
    $mensaje="Hola $nombre!  <br />Estas son sus credenciales para ingresar al sistema www.siluetaexpress.com.mx/login.php <br /> <br />UserName:  <b>$userName </b> <br />Password:  <b>$passw </b>";
    
    if (enviar_mail($correo, "Datos de acceso", $mensaje))
        $r->call('mostrarMsjExito','Se ha enviado correctamente la contrase&ntilde;a al correo!',2);
    else
        $r->call('mostrarMsjExito','No se pudo enviar la contrase&ntilde;a, int&eacute;ntelo m&acute;s tarde.',4);
    
    $r->call('mostrarMsjExito','Se agreg&oacute; correctamente el usuario!',4);
    $r->redirect('listadoUsuarios.php',5);
    
    return $r;
    
}

$xajax->registerFunction("guardarUsuario");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$Susurcal = new ModeloSucursal();
$arrSucursal=$Susurcal->obtenerSucuralesFranquicia();

?>