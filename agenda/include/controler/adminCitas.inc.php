<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.cita_control_whatsapp.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.franquicia.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
require_once FOLDER_INCLUDE_AGENDA.'controler/adminMeta.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.encuesta.inc.php";

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


function mostrarCitas($citas){
    $r=new xajaxResponse();
    
    $listado="";
    foreach ($citas as $cita=>$info){
        $listado.="<div class='12u 12u$(xsmall)'> <input id='check".$info['idCita']."' value='".$info['idCita']."' name='checkCitas' type='checkbox' > 
                  <label for='check".$info['idCita']."'> ".$info['nombre_paciente']." | ".$info['tipoConsulta']."</label></div>";
    }

    $r->assign('divListadoCitas', 'innerHTML', $listado);

    return $r;
}

$xajax->registerFunction("mostrarCitas");

function enviarLinkEncuesta($idCitas, $citasPaciente){
    $r=new xajaxResponse();
    $errores= array();
    $exito=false;
    global $objSession;
    foreach ($citasPaciente as $id=>$paciente){
        $estatus="no_realizada";
        if (in_array($id, $idCitas)) {
            $estatus="realizada";
        }
        $cita = new ModeloCita();
        $cita->setIdCita($id);
        $cita->setEstatus($estatus);
        $cita->unsetVerificaAsistencia();
        $cita->Guardar();

        if ($estatus=='realizada'&&strlen($paciente['telefonoCel'])==10){
            $controlMeta = new ModeloCita_control_whatsapp();
            $pr= $controlMeta->validacion("521".$paciente['telefonoCel'],"numeroCelular");
            $fechaEnvio=date( 'Y-m-d H:i:s');
            $resWh=false;
            
            if ($pr[0]==true){
                if ($pr[1]=="template"){
                    $parametros = array("nombre"=>$paciente['nombre_paciente'],"id"=>$id);
                    $objeto=obtenerJSONMeta("52".$paciente['telefonoCel'], $parametros, "encuesta");
                }else {
                    $parametros['texto']="_Silueta Express agradece tu visita_. Ayúdanos a mejorar el servicio contestando esta pequeña encuesta *ANÓNIMA* de 3 preguntas rápidas en el siguiente enlace https://bit.ly/3GVXqnM con el ID *$id*";
                    $objeto=obtenerJSONMeta("52".$paciente['telefonoCel'], $parametros);
                }
                $sucursal = new ModeloSucursal();
                $sucursal->setIdSucursal($objSession->getIdSucursal());
                $franquicia = new ModeloFranquicia();
                $franquicia->setIdFranquicia($sucursal->getIdFranquicia());

                $resWh = enviaWhatsapp($objeto, $franquicia->getIdentificadorMeta());
                sleep(2);
                
                if ($resWh[0]==true){
                    $exito=true;
                    $encuesta = new ModeloEncuesta();
                    $idE = $encuesta->existeEncuestaByIdCita($id);
                    if ($idE == 0){
                        $encuesta->setIdSucursal($cita->getIdSucursal());
                        $encuesta->setIdTipoConsulta($cita->getIdConsulta());
                        $encuesta->setIdPaciente($cita->getIdPaciente());
                        $encuesta->setIdUsuarioRegistro($objSession->getidUsuario());
                        $encuesta->setEvaluacion(0);
                        $encuesta->unsetEstatus();
                        $encuesta->setIdCita($id);
                        $encuesta->setFechaRegistro(date("Y-m-d H:i:s"));
                        $encuesta->Guardar();
                    }
                    if ($pr[1]=="template"){
                        $controlMeta = new ModeloCita_control_whatsapp();
                        $controlMeta->setIdCita($id);
                        $controlMeta->setIdPlantilla(5);
                        $controlMeta->setIdUsuario(1);
                        $controlMeta->setFechaEnvio($fechaEnvio);
                        $controlMeta->setFechaRespuesta("");
                        $controlMeta->setNumeroCelular("521".$paciente['telefonoCel']);
                        
                        if ($resWh[0]==true){
                            $controlMeta->setEstatusNoAplica();
                            
                        }else{
                            $controlMeta->setEstatusError();
                            $controlMeta->setErrorMeta($resWh[1]);
                        }
                        
                        $controlMeta->Guardar();
                    }
                }else{
                    array_push($errores, $paciente['nombre_paciente']);
                }
                
            }
        }
    }
    if ($exito==true)
        $r->call('mostrarMsjExito','Se enviaron correctamente las encuestas!',5);
        
        if (count($errores)>0)
            $r->call('mostrarMsjError','Excepto a estos pacientes: '.join(", ", $errores),8);
        
    $r->call('consultaCitas');
    
    
    return $r;
}

$xajax->registerFunction("enviarLinkEncuesta");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>