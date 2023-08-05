<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.ganadores_promocion.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.franquicia.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();


function agregaCodigo($idPaciente, $promocion, $codigo){
    $r=new xajaxResponse();
    $codigo2=substr( md5(microtime()), 1, 7);
    $persona = new ModeloPaciente();
    $persona->setIdPaciente($idPaciente);
    $sucursal= new ModeloSucursal();
    $sucursal->setIdSucursal($persona->getIdSucursal());
    
    $ganador = new ModeloGanadores_promocion();
    $ganador->setCodigo($codigo);
    $ganador->setIdPaciente($idPaciente);
    $ganador->setPromocion($promocion);
    $ganador->setFecha(date("Y-m-d"));
    $ganador->setIdFranquicia($sucursal->getIdFranquicia());
    $ganador->Guardar();
    $r->call("asignaCodigoNuevo",$codigo2);
    $r->call("consultaCodigos");
    return $r;
    
}

$xajax->registerFunction("agregaCodigo");

function guardar($datos){
    
    $r=new xajaxResponse();
    $info=json_decode($datos,true);
    
    $infoPaciente=$info['paciente'];
    $infoHoja=$info['hojaclinica'];
    
    $hojaClinica = new ModeloHojaClinica();
    $hojaClinica->setFechaRegistro(date('Y-m-d H:i:s'));
    $hojaClinica->setCompletitud($infoHoja['completitud']);
    $hojaClinica->setPeso_habitual(0);
    $hojaClinica->setPeso_ideal(0);
    $hojaClinica->setEstatura(0);
    $hojaClinica->Guardar();
    if ($hojaClinica->getError()){
        $r->call('mostrarMsjError',$hojaClinica->getStrError(),5);
        return $r;
    }

    switch (intval($infoPaciente['franquicia'])){
        case 1: $usuario=1; break;
        case 2: $usuario=8; break;
    }
    
    $paciente = new ModeloPaciente();
    $paciente->setNombre($infoPaciente['Nombre']);
    $paciente->setApellidos($infoPaciente['Apellidos']);
    $paciente->setTelefonoCel($infoPaciente['txtNumero']);
    $paciente->setCorreo($infoPaciente['Email']);
    $paciente->setSexo($infoPaciente['sexo']);
    $paciente->setFechaNacimiento($infoPaciente['fechaNac']);
    
    $paciente->setIdHojaClinica($hojaClinica->getIdHojaClinica());
    $paciente->setIdUsuarioRegistro($usuario);
    $paciente->setFechaRegistro(date('Y-m-d H:i:s'));
    $paciente->setIdSucursal($infoPaciente['sucursal']);
    $paciente->setLlenadoMinimo();
    $paciente->setIdMedio($infoPaciente['medio']);
    
    $paciente->Guardar();
    if ($paciente->getError()){
        $r->call('mostrarMsjError',$paciente->getStrSystemError(),5);
        return $r;
    }
    
    $r->call('buscarNum');
    
    return $r;
    
}

$xajax->registerFunction("guardar");


$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$mes=date("m");
$anio=date("Y");
$anioI=2021;

$meses =  array (
    "01"=>"Enero",
    "02"=>"Febrero",
    "03"=>"Marzo",
    "04"=>"Abril",
    "05"=>"Mayo",
    "06"=>"Junio",
    "07"=>"Julio",
    "08"=>"Agosto",
    "09"=>"Septiembre",
    "10"=>"Octubre",
    "11"=>"Noviembre",
    "12"=>"Diciembre"
);

$fechaV=$meses[$mes]." ".$anio;

$franquicia=new ModeloFranquicia();
$arrFranquicia=$franquicia->obtenerFranquicias();

$txtFranquicia=$txtSucursal='<option value="">Selecciona una opci&oacute;n</option>';
foreach ($arrFranquicia as $key => $opcion)
    $txtFranquicia.='<option value="'.$key.'">'.$opcion.'</option>';

    
    $codigo=substr( md5(microtime()), 1, 7);

    $oportunidades=new ModeloClaves();
    $top=$oportunidades->obtenerClaveByReferencia("oportunidades");
    
?>