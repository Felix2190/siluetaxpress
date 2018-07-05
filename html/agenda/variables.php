<?php
if ($__FILE_NAME__ != "adminFunciones") {
    
    if ($__FILE_NAME__ != "listadoCitas") {
        if (isset($_SESSION['altaCita'])) {
           unset($_SESSION['altaCita']);
        }
    }
    if ($__FILE_NAME__ != "editaPaciente") {
        if (isset($_SESSION['editaPaciente'])) {
            unset($_SESSION['editaPaciente']);
        }
    }
    if ($__FILE_NAME__ != "altaPaciente") {
        if (isset($_SESSION['paciente'])) {
            unset($_SESSION['paciente']);
        }
    }
    if ($__FILE_NAME__ != "nuevaCita") {
        if (isset($_SESSION['citaPredefinida'])) {
            unset($_SESSION['citaPredefinida']);
        }
        if (isset($_SESSION['pacientePredefinido'])) {
            unset($_SESSION['pacientePredefinido']);
        }
    }
    if ($__FILE_NAME__ != "verCita") {
        if (isset($_SESSION['verCita'])) {
            unset($_SESSION['verCita']);
        }
    }
}
?>