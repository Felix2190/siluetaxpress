<?php

define("DEVELOPER", true);

if (! DEVELOPER) {
    /**
     * constantes de producción
     */
    
    define("FOLDER_INCLUDE", "/home/zs5xw0qfuut5/public_html/include/");
    define("FOLDER_INCLUDE_AGENDA", "/home/zs5xw0qfuut5/public_html/agenda/include/");
        
} else {
    /**
     * constantes de desarrollo
     */
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/agenda/include/");
    
}

define("FOLDER_LIB_AGENDA", FOLDER_INCLUDE_AGENDA . "lib/"); //AGENDA

require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
       echo enviaSMS("527331478905", "SMS EJEMPLO");
        ?>