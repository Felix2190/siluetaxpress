<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.usuario.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.usuariosucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
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


function guardarUsuario($idUsuario, $arrSucursal){
    $r=new xajaxResponse();
    
    $usSu = new ModeloUsuariosucursal();
    $usSu->setIdUsuario($idUsuario);
    if (!$usSu->eliminarByUsuario()){
        $r->call('mostrarMsjError','No se pudo eliminar las sucursales',5);
        return $r;
    }
    $idSucursal='';
    foreach ($arrSucursal as $sucursal){
        $usuarioSucursal = new ModeloUsuariosucursal();
        $usuarioSucursal->setIdSucursal($sucursal);
        $usuarioSucursal->setIdUsuario($idUsuario);
        $usuarioSucursal->setFechaAlta(date("Y-m-d"));
        $usuarioSucursal->setEstatusActivo();
        $usuarioSucursal->Guardar();
        if ($usuarioSucursal->getError()){
            $r->call('mostrarMsjError',$usuarioSucursal->getStrError(),5);
            return $r;
        }
        if ($idSucursal=='')
            $idSucursal=$sucursal;
    }
    
    
    $usuario = new ModeloUsuario();
    $usuario->setIdUsuario($idUsuario);
    $usuario->setIdSucursal($idSucursal);
    
    $usuario->Guardar();
    if ($usuario->getError()){
        $r->call('mostrarMsjError',$usuario->getStrError(),5);
        return $r;
    }
    
    
    $r->call('mostrarMsjExito','Se actualiz&oacute; correctamente la sucursal del usuario!',2);
    $r->redirect('verUsuario.php',3);
    
    return $r;
    
}

$xajax->registerFunction("guardarUsuario");


function generaPassword($idUsuario,$idLogin){
    $r=new xajaxResponse();
    $passw=substr( md5(microtime()), 1, 10);
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $passw. $random_salt);
    
    $login = new ModeloLogin();
    $login->setIdLogin($idLogin);
    $login->setPassword($password);
    $login->setSalt($random_salt);
    
    $login->Guardar();
    if ($login->getError()){
        $r->call('mostrarMsjError',$login->getStrError(),5);
        return $r;
    }
    
    
    $usuario = new ModeloUsuario();
    $usuario->setIdUsuario($idUsuario);
    $userName=$login->getUserName();
    $mensaje="Hola ".$usuario->getNombre()."!  <br />Se ha actualizado tu contrase&ntilde;a. <br /> <br />UserName:  <b>$userName </b> <br />Password:  <b>$passw </b>";
    
    if (enviar_mail($usuario->getCorreo(), "Recuperación de contraseña", $mensaje))
        $r->call('mostrarMsjExito','Se ha generado correctamente la nueva contrase&ntilde;a y enviado al correo del usuario!',2);
        else
            $r->call('mostrarMsjExito','No se pudo enviar la contrase&ntilde;a, int&eacute;ntelo m&acute;s tarde.',4);
            
            $r->redirect('verUsuario.php',3);
            
            return $r;
            
}

$xajax->registerFunction("generaPassword");


$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

if (!isset($_SESSION['verUsuario'])){
    header("Location: listadoUsuarios.php");
}

$aux =$_SESSION['verUsuario'];
$idUsuario=$aux['idUsuario'];

$Usuario = new ModeloUsuario();
$Usuario->setIdUsuario($idUsuario);

if ($Usuario->getIdUsuario()>0){
    $login = new ModeloLogin();
    $login->setIdUsuario($idUsuario);
    $login->getDatosByIdUsuario();
    $estatus=$login->getEstatus();
    $userName=$login->getUserName();
    $idL=$login->getIdLogin();
    
}else {
    header("Location: listadoUsuarios.php");
}

$Susurcal = new ModeloSucursal();
$arrSucursal=$Susurcal->obtenerSucurales();

?>