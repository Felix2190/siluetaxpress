<?php
if (isset($_POST['pacientes'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $pacientes = new ModeloPaciente();
    echo json_encode(obtenCombo($pacientes->obtenerPacientes(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['sucursales'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursales = new ModeloSucursal();
    echo json_encode(obtenCombo($sucursales->obtenerSucurales(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['tiposConsulta'])){
    require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
    $consultas = new ModeloConsulta();
    echo json_encode(obtenCombo($consultas->obtenerConsulta(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['idConsulta'])&&isset($_POST['idSucursal'])&&isset($_POST['fecha'])&&isset($_POST['duracion'])){
    echo obtenerHorarioDisponibles($_POST['idConsulta'],$_POST['idSucursal'],$_POST['fecha'],$_POST['duracion']);
}

if (isset($_POST['idConsulta_'])){
    require_once FOLDER_MODEL_EXTEND. "model.servicio.inc.php";
    $servicio = new ModeloServicio();
    $servicio->setIdConsulta($_POST['idConsulta_']);
    echo json_encode($servicio->obtenerConsulta());
}

if (isset($_POST['fechaConvertir'])){
    $dias = array('','lunes','martes','miercoles','jueves','viernes','sabado','domingo');
    echo strtolower($dias[date('N', strtotime($_POST['fechaConvertir']))]);
    
}


function obtenCombo($array,$default){
    $combo='<option value="">'.$default.'</option>';
    foreach ($array as $key => $opcion)
        $combo.='<option value="'.$key.'">'.$opcion.'</option>';
    return $combo;
}

function obtenerHorarioDisponibles($idConsulta,$idSucursal,$fecha,$duracion){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $cita = new ModeloCita();
    $cita->setIdSucursal($idSucursal);
    $cita->setIdConsulta($idConsulta);
    $cita->setFechaInicio($fecha);
    $cita->setFechaFin($fecha);
    $arrCitas=$cita->obtenerCitasFechaDuracion();
    
    $horarioAgendado=array();
    // obtener hora inicio y duracion
    foreach ($arrCitas as $info){
        $horarioAgendado[$info['fechaInicio']]=$info['fechaFin'];
    }
    
    $sucursal=new ModeloSucursal();
    $sucursal->setIdSucursal($idSucursal);
    
    $hrInicio=$sucursal->getEntreSemanaEntrada();
    $hrFin=$sucursal->getEntreSemanaSalida();
    $horarioDisponible=array();
    
    for ($hr=$hrInicio;$hr<$hrFin;$hr++){
        for ($min=0;$min<=50;$min+=10){
            $hora=($hr<10?'0':'').$hr;
            $minuto=($min<10?'0':'').$min;
            $auxFecha2=$fecha.' '.$hora.':'.$minuto.':00';
            $finicio=strtotime($auxFecha2);
            if (key_exists($auxFecha2,$horarioAgendado)){
                $auxFecha=$horarioAgendado[$auxFecha2];
                $auxFecha=explode(' ', $auxFecha);
                $auxFecha=explode(':', $auxFecha[1]);
                $hr=intval($auxFecha[0]);;
                $min=intval($auxFecha[1]);
     //           unset($horarioAgendado[$auxFecha2]);
            }else {
                $b=false;
                $auxFecha = strtotime ( '+'.$duracion.' minute' , strtotime ( $auxFecha2 ) ) ;
                $nuevafecha = date ( 'Y-m-d H:i:s' , $auxFecha);
                $f3=strtotime($nuevafecha);
                $ffin=strtotime(($fecha.' '.$hrFin.':00:00'));
                
                foreach ($horarioAgendado as $fecha_inicio=>$fecha_fin){
                    $f1=strtotime($fecha_inicio);
                    $f2=strtotime($fecha_fin);
                        
                    if (($finicio>=$f1&&$finicio<=$f2)||($f3>=$f1&&$f3<=$f2)||($finicio<$f1&&$f3>$f2)){ // dentro
       //                     unset($horarioAgendado[$fecha_inicio]);
                            
                        $auxFecha=explode(' ', $fecha_fin);
                        $auxFecha=explode(':', $auxFecha[1]);
                        $hr=intval($auxFecha[0]);;
                        $min=intval($auxFecha[1]);
                        $b=true;
                    }
                }
                if ($f3>$ffin)
                    $b=true;
                
                if (!$b){
                    if (!key_exists($hr, $horarioDisponible))
                        $horarioDisponible[$hr]=array();
                    array_push($horarioDisponible[$hr], $min);
                }
            }
            
        }
    }
    
   return json_encode($horarioDisponible);
}
?>