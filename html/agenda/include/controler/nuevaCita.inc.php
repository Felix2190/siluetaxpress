<?php
// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.comentarioscita.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.servicio.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';

// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
function obtenMes($numMes){
    $MESES=  array (
        "1"=>"Enero",
        "2"=>"Febrero",
        "3"=>"Marzo",
        "4"=>"Abril",
        "5"=>"Mayo",
        "6"=>"Junio",
        "7"=>"Julio",
        "8"=>"Agosto",
        "9"=>"Septiembre",
        "10"=>"Octubre",
        "11"=>"Noviembre",
        "12"=>"Diciembre"
    );
    if ($numMes=='')
        return $MESES;
        return $MESES[''.$numMes];
}
// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();

function guardarCita($paciente,$sucursal,$idCabina,$consulta,$duracion,$fecha,$hora,$minutos,$servicio,$comen,$repetir,$arrDias,$periodo,$veces,$bandera,$Recordatorio){
    global $objSession;
    
    $r=new xajaxResponse();
    $arrFechas=$arrFechasNO=array();
    if ($repetir){
        $dias = array('','lunes','martes','miercoles','jueves','viernes','sabado','domingo');
        $cita = new ModeloCita();
        $cita->setIdConsulta($consulta);
        $cita->setIdSucursal($sucursal);
        $cita->setFechaInicio($fecha.' '.$hora.':'.$minutos.':00');
        $cita->setIdCabina($idCabina);
        for ($inicio=1;$inicio<=$veces;$inicio++){
            do {
                $cita->setFechaInicio($fecha.' '.$hora.':'.$minutos.':00');
                $nomDia=$dias[date('N',strtotime ($fecha))];
                
                $auxFecha = strtotime ( '+'.$duracion.' minute' , strtotime ( $fecha.' '.$hora.':'.$minutos.':00') ) ;
                $cita->setFechaFin(date( 'Y-m-d H:i:s' , $auxFecha));
                
                if (in_array($nomDia, $arrDias)){
                    if ($cita->disponibliadDia())
                        $arrFechas[]=$fecha;
                    else 
                        $arrFechasNO[]=$fecha;
                }
                $auxFecha = strtotime ( '+1 day' , strtotime ( $fecha.' '.$hora.':'.$minutos.':00') ) ;
                $fecha = date ( 'Y-m-d' , $auxFecha);
                 $dia=$dias[date('N', $auxFecha)];
                 
            }while ($dia!='domingo');
            $fecha = date ( 'Y-m-d',strtotime ( '+'.$periodo.' day' , strtotime ( $fecha) ) );
        }
        
    }else {
        $arrFechas[]=$fecha;
    }
    if (count($arrFechasNO)>0&&$bandera){
        $plural='';
        if (count($arrFechasNO)>1)
            $plural='s';
        $respuesta='<h4>Fecha'.$plural.' no disponible'.$plural.'</h4>
						<hr><p>No se puede agendar cita'.$plural.' en esta'.$plural.' fecha'.$plural.'.</p><ul>';
        foreach ($arrFechasNO as $fechaNO){
            $nomDia=ucfirst($dias[date('N',strtotime ($fechaNO))]);
            $fechaNO=explode('-', $fechaNO);
            $respuesta.="<li>$nomDia $fechaNO[2] de ".obtenMes(''.intval($fechaNO[1]))." del $fechaNO[0]</li>";
        }
        $respuesta.='</ul><p>&iquest;Deseas continuar sin agendar en esas fechas?</p></div>';
        
        $r->assign('divFechasNoDisponibles2', 'innerHTML', $respuesta);
        $r->call('mostrarConfirmacion');
        
        return $r;
    }
    $primero=true;
    foreach ($arrFechas as $fecha){
        $servicio_ = new ModeloServicio();
        $paciente_ = new ModeloPaciente();
        $cita = new ModeloCita();
        
    $servicio_->setNombre($servicio);
    $servicio_->setIdConsulta($consulta);
        
    $servicio_->guardarServicioNuevo();
    
    $paciente_->setIdPaciente($paciente);
    
    $cita->setIdUsuario($objSession->getidUsuario());
    $cita->setIdConsulta($consulta);
    $cita->setIdPaciente($paciente);
    $cita->setIdServicio($servicio_->getIdServicio());
    $cita->setIdSucursal($sucursal);
    $cita->setFechaInicio($fecha.' '.$hora.':'.$minutos.':00');
    $cita->setIdCabina($idCabina);
    $auxFecha = strtotime ( '+'.$duracion.' minute' , strtotime ( $fecha.' '.$hora.':'.$minutos.':00') ) ;
    $cita->setFechaFin(date( 'Y-m-d H:i:s' , $auxFecha));
    $cita->setDuracion($duracion);
    $cita->setEstatus("nueva");
    $cita->setTelefonoPaciente("52".$paciente_->getTelefonoCel());
    $cita->setFechaRegistroCita(date( 'Y-m-d'));
    //decidir si se envía el segundo recordatorio
    $datetime2 = new DateTime($cita->getFechaInicio());
    $datetime1 = new DateTime(date( 'Y-m-d H:i:s'));
    $interval = $datetime1->diff($datetime2);
    if (intval($interval->format('%R%a'))>=2&&$Recordatorio=='1')
        $cita->setEnviarRecordatorio2();
    else
        $cita->unsetEnviarRecordatorio2();
    
    $cita->Guardar();
    if ($cita->getError()){
        $r->call('mostrarMsjError',$cita->getStrError(),5);
        return $r;
    }
    
    if ($primero){
        $idCita=$cita->getIdCita();
        $primero=false;
    }
    
    if ($comen!=""){
        
        $comentarios= new ModeloComentarioscita();
        $comentarios->setIdCita($cita->getIdCita());
        $comentarios->setFechaComentario($cita->getFechaInicio());
        $comentarios->setComentario($comen);
        $comentarios->Guardar();
    }
        
    }
    
    $nSucursal= new ModeloSucursal();
    $nSucursal->setIdSucursal($sucursal);
    $nConsulta= new ModeloConsulta();
    $nConsulta->setIdConsulta($consulta);
    $paciente_ = new ModeloPaciente();
    $paciente_->setIdPaciente($paciente);
    /**/
    $resSMS=false; 
    if ($Recordatorio=='1')
        $resSMS = enviaSMS_CitaNueva("52".$paciente_->getTelefonoCel(), $nConsulta->getTipoConsulta(), date("d/m/Y",strtotime($fecha)), "$hora:$minutos", $nSucursal->getSucursal(), $idCita);
    
    if ($resSMS){
        $r->call('mostrarMsjExito',"Se envi&oacute; el SMS al ".$paciente_->getTelefonoCel(),3);
        $cita = new ModeloCita();
        $cita->setIdCita($idCita);
        $cita->setRecordatorio1();
        $cita->Guardar();
    }
    //*/
    
    $r->call('mostrarMsjExito','Se agreg&oacute; correctamente las citas!',3);
    $r->call('limpiarDatos');
    
    
    $_SESSION['altaCita']=$paciente;
    
    $r->redirect("listadoCitas.php",4);
    return $r;
    
}

$xajax->registerFunction("guardarCita");

function paciente(){
    global $objSession;
    
    $r=new xajaxResponse();
    $_SESSION['paciente']=true;
    
    $r->redirect("altaPaciente.php",4);
    return $r;
    
}

$xajax->registerFunction("paciente");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$arrTiempo=array();
for ($tiempoI=10;$tiempoI<=240;$tiempoI+=10){
    $hr=intval($tiempoI/60);
    $min=$tiempoI%60;
    $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
    $arrTiempo[$tiempoI]=$duracion;
}

$operadores=obtenCombo($arrTiempo,'Seleccione una opci&oacute;n');

// cita predefinia
$predefinida='';
if (isset($_SESSION['citaPredefinida'])){
    $citaP=$_SESSION['citaPredefinida'];
    $predefinida='true';
    $idSucursal=$citaP['sucursal'];
    $idCabina=$citaP['cabina'];
    $hr=intval($citaP['hora']);
   // $hr=($hr<10?'0':'').$hr;
    $fecha=$citaP['fecha'];
    $idConsulta=1;
    
    $cabina = new ModeloCabina();
    $cabina->setIdCabina($idCabina);
    if ($cabina->getTipo()=='cabina')
        $idConsulta=2;
    
}

if (isset($_SESSION['pacientePredefinido'])){
    $pacienteP=$_SESSION['pacientePredefinido'];
    $idPaciente=$pacienteP['idPaciente'];
    $nombreP=$pacienteP['nombre'];
}
?>