<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
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

function ingresar($user,$pass,$sucursal){
    $login=new ModeloLogin();
    $arrSesion=$login->validarUsuarioPassword(array('username'=>$user,'password'=>$pass,'sucursal'=>$sucursal));
    
    $r=new xajaxResponse();
    
    if (!$arrSesion[0]){
        $r->call('mostrarMsjError',$arrSesion[1],5);
        return $r;
    }
    
    $objSession=new clsSession();
    $objSession->updateTime();
    $objSession->setObjetoGetInfo($arrSesion[1]);
    $_SESSION['objSession']=serialize($objSession);
    $r->call('mostrarMsjExito','Datos correctos!',3);
    $r->redirect("index.php",3);
    return $r;
    
    
}
$xajax->registerFunction("ingresar");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$sucursal=new ModeloSucursal();
$arrSucursal=$sucursal->obtenerSucurales();

$txtSucursal='<option value="">Selecciona una opci&oacute;n</option>';
foreach ($arrSucursal as $key => $opcion)
    $txtSucursal.='<option value="'.$key.'">'.$opcion.'</option>';
 
$URL="";
if (isset($_SESSION['url']))    
    $URL.=$_SESSION['url'];
else 
    $URL.="index.php";
//echo $_SESSION['url'];
?>