<?php

if (isset($_POST['conectar'])){
define("DEVELOPER", false);
//date_default_timezone_set('America/Mexico_City');
//require_once 'include/config/constantes.php';
ini_set('max_execution_time', 300);
ini_set('max_input_time', 300);

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "motdmx");
    define("BD_PASS", "G2Af$3T83$.95Xc");
    define("BD_DB", "motdmx_bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
}

$Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
if ($Conexion->connect_errno)
    echo "<li>Error [".date("m/d H:i:s")."]<li>";
else 
    echo "<li>Conexi&oacute;n exitosa [".date("m/d H:i:s")."]<li>";
//sleep(3);
//echo ini_get('max_execution_time');
/// 12:55:07
// 12:57:49
}

// 12:59:45
// 1:00:47 error
// 1:03:51 error
// 1:0: