<?php
session_start();

date_default_timezone_set('America/Mexico_City');

define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/include/");

if (! DEVELOPER) {
    /**
     * constantes de producción
     */
    define("FOLDER_HTDOCS", "/var/www/html/admin/");
    define("DOMINIO", "http://216.58.174.71/admin/");
    
    define("ERR_DEBUG", false);
    define("SESSION_TIME", 1800);
    define("SOPORTE_TIME", 600);
    
} else {
    /**
     * constantes de desarrollo
     */
    
    define("FOLDER_HTDOCS", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/html");
//    define("DOMINIO", "http://planet/" . SUBDIR . "/");
    define("ERR_DEBUG", true);
    
}

/*
 * DEFINIR VARIABLES
 */
define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');


define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");
//define("FOLDER_COMMON", FOLDER_INCLUDE . "common/");
//define("FOLDER_CONF", FOLDER_INCLUDE . "conf/");
define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");

define("FOLDER_MODEL_DATA", FOLDER_INCLUDE . "model/data/");
define("FOLDER_CONTROLLER", FOLDER_INCLUDE . "controler/");

define("FOLDER_JS", FOLDER_HTDOCS . "js/system/");

define("FOLDER_LOG", FOLDER_INCLUDE . 'log/');

define("LIB_EXCEPTION", FOLDER_LIB . "Excepciones/Exception.php");

//define("LIB_UTILS", FOLDER_LIB . "Utilidades/Utils.php");
//define("LIB_XAJAX", FOLDER_LIB . "xajax_core/xajax.inc.php");
//define("LIB_CSV", FOLDER_LIB . "csv/csv2mysql.inc.php");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

define("CLASS_SESSION", FOLDER_MODEL_DATA . "clsSession.inc.php");


define("URL_JAVASCRIPT", "js/system/");
define("URL_TMP", "datos/tmp/");


require_once(CLASS_COMUN);
require_once CLASS_SESSION;

$objSession=new clsSession();

if(isset($_SESSION['objSession'])){
    $objSession=unserialize($_SESSION['objSession']);
    
    if($objSession->isSessionActive()){
    $objSession->updateTime();
    $_SESSION['objSession']=serialize($objSession);
    }
}


//require_once(LIB_XAJAX);
//require_once(LIB_EXCEPTION);






$pedazos=explode("/", $_SERVER['PHP_SELF']);
$__FILE_NAME__=str_replace(array("/",".php"),"",$pedazos[count($pedazos)-1]);
if(is_file(FOLDER_INCLUDE . "controler/" . $__FILE_NAME__ . ".inc.php"))
{
    require_once(FOLDER_INCLUDE . "controler/" . $__FILE_NAME__ . ".inc.php");
    
}

if (! isset($_JAVASCRIPT_CSS))
    $_JAVASCRIPT_CSS = "";

if (isset($xajax))
    $_JAVASCRIPT_CSS .= $xajax->getJavascript("js/lib/");

$_JAVASCRIPT_CSS .= '<script type="text/javascript" src="' . URL_JAVASCRIPT . '../lib/common.js"></script>';

if (isset($_JAVASCRIPT_OUT))
    $_JAVASCRIPT_CSS .= '<script type="text/javascript">' . $_JAVASCRIPT_OUT . '</script>';

if (is_file(FOLDER_JS . $__FILE_NAME__ . ".js"))
    $_JAVASCRIPT_CSS .= '<script type="text/javascript" src="' . URL_JAVASCRIPT . $__FILE_NAME__ . '.js"></script>';
                        
                        
                        
                        
?>