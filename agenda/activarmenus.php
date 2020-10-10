<?php
$seccion="";
$subseccion="";
$arrSeccionesPagina=array(
    "nuevaCita"=>"citas",
    "listadoCitas"=>"citas",
    "horariosDisponibles"=>"citas",
    "verCita"=>"citas",
    "buscarCita"=>"citas",
    "registroApartado"=>"citas",
    "citasAnteriores"=>"citas",
    "verificaAsistencia"=>"citas",
    
    "listadoPacientes"=>"pacientes",
    "altaPaciente"=>"pacientes",
    "buscarPaciente"=>"pacientes",
    "verPaciente"=>"pacientes",
    "editarPaciente"=>"pacientes",
    "bloqueos"=>"pacientes",
    
    "index"=>"inicio",
    
    "cambioContrasena"=>"cuenta",
    "miPerfil"=>"cuenta",
    
    "creditoSMS"=>"credito",
    
    "listadoUsuarios"=>"administrar",
    "nuevoUsuario"=>"administrar",
    "verUsuario"=>"administrar",
    "listadoTipoUsuarios"=>"administrar",
    "nuevoTipo"=>"administrar",
    "verTipoUsuario"=>"administrar",
    "listadoSucursal"=>"administrar",
    "altaSucursal"=>"administrar",
    "verSucursal"=>"administrar",
    "notificacionPaciente"=>"administrar",
    
    ""=>""
);


$idOp='';

$seccion=isset($arrSeccionesPagina[$__FILE_NAME__])?$arrSeccionesPagina[$__FILE_NAME__]:"";
$subseccion=$__FILE_NAME__;



//echo "[" . $seccion . "][" . $subseccion . "]<br />";
