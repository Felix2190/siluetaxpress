<?php
/*
 * Variables conexion a BD
 */

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "zs5xw0qfuut5");
    define("BD_PASS", "mYch1v45.");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
    
    /*
    define("BD_HOST", "localhost");
    define("BD_USER", "zs5xw0qfuut5");
    define("BD_PASS", "mYch1v45.");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");

    
    define("BD_HOST", "localhost");
    define("BD_USER", "motdmx");
    define("BD_PASS", "G2Af$3T83$.95Xc");
    define("BD_DB", "motdmx_bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
    
    
    define("BD_HOST", "localhost");
    define("BD_USER", "ocf686wykppo");
    define("BD_PASS", "j0Venes.");
    define("BD_DB", "siluetaxpress");
    define("BD_CHARSET", "utf8");
    */
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "bd_siluetaxpress");
    define("BD_CHARSET", "utf8");
}


?>