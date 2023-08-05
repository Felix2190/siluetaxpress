<?php
session_start();

date_default_timezone_set('America/Mexico_City');

if (!function_exists("get_magic_quotes_gpc")){
    function get_magic_quotes_gpc(){ return 0;}
}

if (! DEVELOPER) {
    /**
     * constantes de producci�n
     * 
     * string(66) "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx" 
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/include/"); //agenda
    
    define("FOLDER_HTDOCS", $_SERVER['DOCUMENT_ROOT'] . "/");//AGENDA
    
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/include/"); //agenda
    define("FOLDER_HTDOCS_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/");//AGENDA
    
    define("FOLDER_FOTOS", $_SERVER['DOCUMENT_ROOT'] . "/tmp/fotosperfil/"); // carpeta para fotos de perfil
    define("ERR_DEBUG", false);
    define("SESSION_TIME", 1800);
    define("SOPORTE_TIME", 600);
    
} else {
    /**
     * constantes de desarrollo
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/include/"); //agenda
    
    define("FOLDER_HTDOCS", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/");
    define("FOLDER_HTDOCS_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/");//AGENDA
    define("FOLDER_FOTOS", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/tmp/fotosperfil/"); // carpeta para fotos de perfil
//    define("DOMINIO", "http://planet/" . SUBDIR . "/");
    define("ERR_DEBUG", true);
    $case1=4;$case2=4;
}
/*
 * DEFINIR VARIABLES
 */
define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');


define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");
define("FOLDER_LIB_AGENDA", FOLDER_INCLUDE_AGENDA . "lib/"); //AGENDA

//define("FOLDER_COMMON", FOLDER_INCLUDE . "common/");
//define("FOLDER_CONF", FOLDER_INCLUDE . "conf/");
define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");

define("FOLDER_MODEL_DATA", FOLDER_INCLUDE . "model/data/");

define("FOLDER_LOG", FOLDER_INCLUDE . 'log/');

define("LIB_EXCEPTION", FOLDER_LIB . "Excepciones/Exception.php");

//define("LIB_UTILS", FOLDER_LIB . "Utilidades/Utils.php");
define("LIB_XAJAX", FOLDER_LIB . "xajax_core/xajax.inc.php");
//define("LIB_CSV", FOLDER_LIB . "csv/csv2mysql.inc.php");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

define("CLASS_SESSION", FOLDER_MODEL_DATA . "clsSession.inc.php");


define("URL_JAVASCRIPT", "js/system/");

define("FOLDER_CONTROLLER", FOLDER_INCLUDE . "controler/");

define("FOLDER_JS", FOLDER_HTDOCS . "js/system/");

define("LIB_FPDF", FOLDER_INCLUDE . "lib/pdf/fpdf.php");
// AGENDA

define("FOLDER_CONTROLLER_AGENDA", FOLDER_INCLUDE_AGENDA . "controler/");

define("FOLDER_JS_AGENDA", FOLDER_HTDOCS_AGENDA . "js/system/");
/*******************************************************/

define("URL_TMP", "datos/tmp/");


require_once(CLASS_COMUN);
require_once CLASS_SESSION;
///var_dump(CLASS_SESSION);
$objSession=new clsSession();
$sesion=false;
if(isset($_SESSION['objSession'])){
    $objSession=unserialize($_SESSION['objSession']);
    $sesion=true;
    if($objSession->isSessionActive()){
    $objSession->updateTime();
    $_SESSION['objSession']=serialize($objSession);
    }else {
        header("Location: logout.php");
    }
}else {
//   header("Location: login.php");
}


require_once(LIB_XAJAX);
//require_once(LIB_EXCEPTION);




$_JAVASCRIPT_ALERTAS = "<script type='text/javascript'>
        function mostrarMsjError(texto, tiempo){
            alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
            alertify.notify(texto,'error', tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
      }
         function mostrarMsjExito(texto, tiempo){
            alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
            alertify.notify(texto,'success', tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
      }
         function mostrarMsjEspera(texto, tiempo){
            alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
            alertify.notify(texto,'warning', tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
      }
         function mostrarMensaje(texto, tiempo){
            alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
            alertify.notify(texto, tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
      } 

         function mensajeConfirmacion(titulo, texto, canceladaPor, divAlerta){
            alertify.prompt( titulo, texto, ''
            , function(evt, password) { 
		cancelarCita(password,canceladaPor) 
		}
            , function() { 
            	$( '#'+divAlerta).hide();
            }).set('modal', true).set('closable',false);
	
      } 
</script>";



$pedazos=explode("/", $_SERVER['PHP_SELF']);
$__FILE_NAME__=str_replace(array("/",".php"),"",$pedazos[count($pedazos)-1]);

    include_once 'variables.php';
    include_once 'activarmenus.php';
if (is_file(FOLDER_INCLUDE_AGENDA . "controler/" . $__FILE_NAME__ . ".inc.php")) {
    require_once (FOLDER_INCLUDE_AGENDA . "controler/" . $__FILE_NAME__ . ".inc.php");
}

if (! isset($_JAVASCRIPT_CSS_AGENDA))
    $_JAVASCRIPT_CSS_AGENDA = $_JAVASCRIPT_ALERTAS;

if (isset($xajax))
    $_JAVASCRIPT_CSS_AGENDA .= $xajax->getJavascript("js/lib/");

    $_JAVASCRIPT_CSS_AGENDA .= '<script type="text/javascript" src="' . URL_JAVASCRIPT . '../lib/common.js"></script>';

    if (is_file(FOLDER_JS_AGENDA . $__FILE_NAME__ . ".js"))
        $_JAVASCRIPT_CSS_AGENDA .= '<script type="text/javascript" src="' . URL_JAVASCRIPT . $__FILE_NAME__ . '.js"></script>';

//ini_set('max_execution_time', 5000);
//ini_set('max_input_time', 5000);
//ini_set('memory_limit',500M);


?>