<?php
/*
 * Variables conexion a BD
 */

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "");
    define("BD_USER", "");
    define("BD_PASS", "");
    define("BD_CHARSET", "");
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
}


?>