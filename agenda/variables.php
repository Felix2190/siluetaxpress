<?php
if ($__FILE_NAME__ != "adminFunciones") {
    
    if ($__FILE_NAME__ != "listadoCitas") {
        if (isset($_SESSION['altaCita'])) {
           unset($_SESSION['altaCita']);
        }
    }
    if ($__FILE_NAME__ != "verPaciente") {
        if (isset($_SESSION['verPaciente'])) {
            unset($_SESSION['verPaciente']);
        }
    }
    if ($__FILE_NAME__ != "editarPaciente"&&$__FILE_NAME__ != "seguimiento") {
        if (isset($_SESSION['editarPaciente'])) {
            unset($_SESSION['editarPaciente']);
        }
        if (isset($_SESSION['verSeg'])) {
            unset($_SESSION['verSeg']);
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
        if (isset($_SESSION['notifCita'])) {
            unset($_SESSION['notifCita']);
        }
    }
    if ($__FILE_NAME__ != "verSucursal") {
        if (isset($_SESSION['verSucursal'])) {
            unset($_SESSION['verSucursal']);
        }
    }
    if ($__FILE_NAME__ != "verUsuario") {
        if (isset($_SESSION['verUsuario'])) {
            unset($_SESSION['verUsuario']);
        }
    }
    if ($__FILE_NAME__ != "verTipoUsuario") {
        if (isset($_SESSION['verTipoUsuario'])) {
            unset($_SESSION['verTipoUsuario']);
        }
    }
}
?>