<?php
// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
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

function guardar($datos){
    global $objSession;
    
    $r=new xajaxResponse();
    $info=json_decode($datos,true);
    
    $infoPaciente=$info['paciente'];
    $infoHoja=$info['hojaclinica'];
    
    $hojaClinica = new ModeloHojaClinica();
    $hojaClinica->setPeso_habitual($infoHoja['pesoHabitual']);
    $hojaClinica->setPeso_ideal($infoHoja['pesoIdeal']);
    $hojaClinica->setFechaRegistro(date('Y-m-d H:i:s'));
    if ($infoHoja['cirugias'] != "")
        $hojaClinica->setCirugia($infoHoja['cirugias']);
    if ($hojaClinica->getCirugia() == "Si") {
        $hojaClinica->setCirugias($infoHoja['cirugia']);
    }
    $hojaClinica->setEnfermedades($infoHoja['enfermedades']);
    if ($infoHoja['estrenimiento'] != "")
        $hojaClinica->setEstrenimiento($infoHoja['estrenimiento']);
    if ($hojaClinica->getEstrenimiento() == "Si") {
        $hojaClinica->setEstrenimientoFrecuencia($infoHoja['estrenimientoF']);
    }
    if ($infoHoja['menstrual'] != "")
        $hojaClinica->setMenstruacion($infoHoja['menstrual']);
    if ($infoHoja['alergia'] != "")
        $hojaClinica->setAlergia($infoHoja['alergia']);
    if ($hojaClinica->getAlergia() == "Si") {
        $hojaClinica->setAlimento($infoHoja['alergias']);
    }
    if ($infoHoja['hrsDormir'] != "")
        $hojaClinica->setHrsDormir($infoHoja['hrsDormir']);
    if ($infoHoja['hrsComida'] != "")
        $hojaClinica->setHrsComer($infoHoja['hrsComida']);
    if ($infoHoja['cafe'] != "")
        $hojaClinica->setCafe($infoHoja['cafe']);
    if ($hojaClinica->getCafe() == "Si") {
        $hojaClinica->setCafeFrecuencia($infoHoja['cafeF']);
    }
    if ($infoHoja['bebidas'] != "")
        $hojaClinica->setBeber($infoHoja['bebidas']);
    if ($hojaClinica->getBeber() == "Si") {
        $hojaClinica->setBeberFrecuencia($infoHoja['bebidasF']);
    }
    if ($infoHoja['fuma'] != "")
        $hojaClinica->setFuma($infoHoja['fuma']);
    if ($hojaClinica->getFuma() == "Si") {
        $hojaClinica->setFumaFrecuencia($infoHoja['fumaF']);
    }
    $hojaClinica->setDesagradables($infoHoja['desagradable']);
    if ($infoHoja['ansiedad'] != "")
        $hojaClinica->setAnsiedad($infoHoja['ansiedad']);
    if ($infoHoja['actividadFisica'] != "")
        $hojaClinica->setActividadFisica($infoHoja['actividadFisica']);
    if ($hojaClinica->getActividadFisica() == "Si") {
        $hojaClinica->setActividad($infoHoja['actividad']);
        $hojaClinica->setTiempo($infoHoja['tiempo']);
        $hojaClinica->setTiempoSimbolo($infoHoja['tiempoSimbolo']);
        $hojaClinica->setActividadFisicaFrecuencia($infoHoja['tiempoActividad']);
    }
    $hojaClinica->setMotivacion($infoHoja['motivacion']);
    $hojaClinica->setHorarioLevantarse($infoHoja['hrLevantar']);
    $hojaClinica->setHorarioAcostarse($infoHoja['hrAcostar']);
    $hojaClinica->setHorarioActividad($infoHoja['hrEjercicio']);
    if ($infoHoja['desayunoF'] != "")
        $hojaClinica->setDesayuno($infoHoja['desayunoF']);
    if ($hojaClinica->getDesayuno()=="Si"){
        $hojaClinica->setHorarioDesayuno($infoHoja['hrDesayuno']);
        $hojaClinica->setActividadDesayuno($infoHoja['desayuno']);
    }
    if ($infoHoja['colacionF']!="")
        $hojaClinica->setColacion($infoHoja['colacionF']);
    if ($hojaClinica->getColacion()=="Si"){
        $hojaClinica->setHorarioColacion($infoHoja['hrColacion1']);
        $hojaClinica->setActividadColacion($infoHoja['colacion1']);
    }
    if ($infoHoja['comidaF']!="")
        $hojaClinica->setComida($infoHoja['comidaF']);
    if ($hojaClinica->getComida()=="Si"){
        $hojaClinica->setHorarioComida($infoHoja['hrComida']);
        $hojaClinica->setActividadComida($infoHoja['comida']);
    }
    if ($infoHoja['colacion2F']!="")
        $hojaClinica->setColacion2($infoHoja['colacion2F']);
    if ($hojaClinica->getColacion2()=="Si"){
        $hojaClinica->setHorarioColacion2($infoHoja['hrColacion2']);
        $hojaClinica->setActividadColacion2($infoHoja['colacion2']);
    }
    if ($infoHoja['cenaF']!="")
        $hojaClinica->setCena($infoHoja['cenaF']);
    if ($hojaClinica->getCena()=="Si"){
        $hojaClinica->setHorarioCena($infoHoja['hrCena']);
        $hojaClinica->setActividadCena($infoHoja['cena']);
    }
    $hojaClinica->setObservaciones($infoHoja['Observaciones']);
    $hojaClinica->setCompletitud($infoHoja['completitud']);
    $hojaClinica->Guardar();
    if ($hojaClinica->getError()){
        $r->call('mostrarMsjError',$hojaClinica->getStrError(),5);
        return $r;
    }
    $r->call('mostrarMsjExito','Se ha acompletado la hoja cl&iacute;nica en un '.$infoHoja['completitud'].'%!',3);
    
    $paciente = new ModeloPaciente();
    $paciente->setNombre($infoPaciente['Nombre']);
    $paciente->setApellidos($infoPaciente['Apellidos']);
    $paciente->setTelefonoCasa($infoPaciente['TelCasa']);
    $paciente->setTelefonoCel($infoPaciente['TelMovil']);
    $paciente->setCorreo($infoPaciente['Email']);
    $paciente->setEdad($infoPaciente['Edad']);
    $paciente->setSexo($infoPaciente['sexo']);
    $paciente->setFechaNacimiento($infoPaciente['fechaNac']);
    $paciente->setOcupacion($infoPaciente['ocupacion']);
    $paciente->setIdHojaClinica($hojaClinica->getIdHojaClinica());
    $paciente->setIdUsuarioRegistro($objSession->getidUsuario());
    $paciente->setFechaRegistro(date('Y-m-d H:i:s'));
    $paciente->setIdSucursal($infoPaciente['sucursal']);
    $paciente->setLlenadoCompleto();
    
    $paciente->Guardar();
    if ($paciente->getError()){
        $r->call('mostrarMsjError',$paciente->getStrSystemError(),5);
        return $r;
    }
    
    $r->call('mostrarMsjExito','Se agreg&oacute; correctamente al paciente!',4);
    
    if (isset($_SESSION['paciente'])){
        $_SESSION['pacientePredefinido']=array("idPaciente"=>$paciente->getIdPaciente(),"nombre"=>$paciente->getNombre()." ".$paciente->getApellidos());
        $r->redirect('nuevaCita.php',5);
    }else{
        $_SESSION['verPaciente']=array("titulo"=>"Ver paciente","idPaciente"=>$paciente->getIdPaciente());
        ///$r->call('limpiarDatos');
        $r->redirect('verPaciente.php',5);
        }
    return $r;
    
}

$xajax->registerFunction("guardar");


function guardar2($datos){
    global $objSession;
    
    $r=new xajaxResponse();
    $info=json_decode($datos,true);
    
    $infoPaciente=$info['paciente'];
    $infoHoja=$info['hojaclinica'];
    
    $hojaClinica = new ModeloHojaClinica();
    $hojaClinica->setFechaRegistro(date('Y-m-d H:i:s'));
                                                        $hojaClinica->setCompletitud($infoHoja['completitud']);
                                                        $hojaClinica->Guardar();
                                                        if ($hojaClinica->getError()){
                                                            $r->call('mostrarMsjError',$hojaClinica->getStrError(),5);
                                                            return $r;
                                                        }
                                                        $r->call('mostrarMsjExito','Se ha acompletado la hoja cl&iacute;nica en un '.$infoHoja['completitud'].'%!',3);
                                                        
                                                        $paciente = new ModeloPaciente();
                                                        $paciente->setNombre($infoPaciente['Nombre']);
                                                        $paciente->setApellidos($infoPaciente['Apellidos']);
                                                        $paciente->setTelefonoCel($infoPaciente['TelMovil']);
                                                        $paciente->setCorreo($infoPaciente['Email']);
                                                        $paciente->setSexo($infoPaciente['sexo']);
                                                        
                                                        $paciente->setIdHojaClinica($hojaClinica->getIdHojaClinica());
                                                        $paciente->setIdUsuarioRegistro($objSession->getidUsuario());
                                                        $paciente->setFechaRegistro(date('Y-m-d H:i:s'));
                                                        $paciente->setIdSucursal($infoPaciente['sucursal']);
                                                        $paciente->setLlenadoMinimo();
                                                        
                                                        $paciente->Guardar();
                                                        if ($paciente->getError()){
                                                            $r->call('mostrarMsjError',$paciente->getStrSystemError(),5);
                                                            return $r;
                                                        }
                                                        
                                                        $r->call('mostrarMsjExito','Se agreg&oacute; correctamente al paciente!',4);
                                                        
                                                        if (isset($_SESSION['paciente'])){
                                                            $_SESSION['pacientePredefinido']=array("idPaciente"=>$paciente->getIdPaciente(),"nombre"=>$paciente->getNombre()." ".$paciente->getApellidos());
                                                            $r->redirect('nuevaCita.php',5);
                                                        }else{
                                                            $_SESSION['verPaciente']=array("titulo"=>"Ver paciente","idPaciente"=>$paciente->getIdPaciente());
                                                            ///$r->call('limpiarDatos');
                                                            $r->redirect('verPaciente.php',5);
                                                        }
                                                        return $r;
                                                        
}

$xajax->registerFunction("guardar2");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$comboHr=$comboMin=$comboHora="";
for ($hr=0;$hr<=23;$hr++)
    for ($min=0;$min<=45;$min+=15){
        $aux=" AM";
        $auxMin=$min==0?"0".$min:$min;
        if ($hr<13){
            if ($hr==12)
                $aux=" PM";
            $auxHr=$hr==0?"0".$hr:$hr;
            $comboHr.="<option value='$auxHr:$auxMin$aux'>$auxHr:$auxMin$aux</option>";
        }else {
            $aux=" PM";
            $auxHr=$hr-12;
            $comboHr.="<option value='$auxHr:$auxMin$aux'>$auxHr:$auxMin$aux</option>";
        }
    }

for ($hr=0;$hr<=12;$hr++){
    $auxHr=$hr==0?"0".$hr:$hr;
    $comboHora.="<option value='$auxHr'>$auxHr</option>";
}
for ($min=0;$min<=45;$min+=15){
    $auxMin=$min==0?"0".$min:$min;
    $comboMin.="<option value='$auxMin'>$auxMin</option>";
    }
?>