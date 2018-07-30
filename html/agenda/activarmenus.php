<?php
$seccion="";
$subseccion="";
$arrSeccionesPagina=array(
    "nuevaCita"=>"citas",
    "listadoCitas"=>"citas",
    "horariosDisponibles"=>"citas",
    "verCita"=>"citas",
    "buscarCita"=>"citas",
    
    "listadoPacientes"=>"pacientes",
    "altaPaciente"=>"pacientes",
    "buscarPaciente"=>"pacientes",
    "editaPaciente"=>"pacientes",
    
    "index"=>"inicio",
    
    "cambioContrasena"=>"cuenta",
    "miPerfil"=>"cuenta",
    
    "creditoSMS"=>"credito",
    
    "listadoUsuarios"=>"administrar",
    "listadoTipoUsuarios"=>"administrar",
    "listadoSucursal"=>"administrar",
    
    ""=>""
);


$idOp='';

$seccion=isset($arrSeccionesPagina[$__FILE_NAME__])?$arrSeccionesPagina[$__FILE_NAME__]:"";
$subseccion=$__FILE_NAME__;



//echo "[" . $seccion . "][" . $subseccion . "]<br />";
