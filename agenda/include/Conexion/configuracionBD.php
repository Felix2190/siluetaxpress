<?php
/*
 * Variables conexion a BD
 */

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "admin_l3zli3");
    define("BD_PASS", "vw7Z2s*5");
    define("BD_DB", "bd_siluetaexpress");
    define("BD_CHARSET", "utf8");
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "bd_siluetaxpress2");
    define("BD_CHARSET", "utf8");
}


?>