<?php
/*
 * Variables conexion a BD
 */

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "zs5xw0qfuut5");
    define("BD_PASS", "myCh1v45.");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
}


?>