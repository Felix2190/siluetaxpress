<?php
/*
 * Variables conexion a BD
 */

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


?>