<?php
if ($__FILE_NAME__ != "adminFunciones") {
    
    if ($__FILE_NAME__ != "listadoCitas") {
        if (isset($_SESSION['altaCita'])) {
           unset($_SESSION['altaCita']);
        }
    }
}
?>