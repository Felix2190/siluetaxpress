<?php
/*
 * Variables conexion a BD
 */

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "silu3ta_user");
    define("BD_PASS", "Qo4v7j7Xnda#983");
    define("BD_DB", "bd_siluetaexpress");
    define("BD_CHARSET", "utf8");
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "bd_siluetaexpress");
    define("BD_CHARSET", "utf8");
}


?>