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

if (isset($_POST['idConsulta'])&&isset($_POST['idSucursal'])&&isset($_POST['fecha'])&&isset($_POST['duracion'])&&isset($_POST['idConsultorio'])){
    echo obtenerHorarioDisponibles($_POST['idConsulta'],$_POST['idSucursal'],$_POST['fecha'],$_POST['duracion'],$_POST['idConsultorio']);
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

if (isset($_POST['sucursal'])&&isset($_POST['paciente'])&&isset($_POST['usuario'])&&isset($_POST['cabina'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    if ($_POST['sucursal']!='')
        $cita->setIdSucursal($_POST['sucursal']);
        if ($_POST['paciente']!='')
            $cita->setIdPaciente($_POST['paciente']);
            if ($_POST['usuario']!='')
                $cita->setIdUsuario($_POST['usuario']);
                if ($_POST['cabina']!='')
                    $cita->setIdCabina($_POST['cabina']);
                    
            
    echo json_encode($cita->obtenerCitas());
}

if (isset($_POST['Consulta'])&&isset($_POST['Sucursal'])){
    echo obtenCombo(obtenerConsultorios($_POST['Consulta'],$_POST['Sucursal']),'Selecciona una opci&oacute;n');
}

function obtenCombo($array,$default){
    $combo='<option value="">'.$default.'</option>';
    foreach ($array as $key => $opcion)
        $combo.='<option value="'.$key.'">'.$opcion.'</option>';
    return $combo;
}

function obtenerHorarioDisponibles($idConsulta,$idSucursal,$fecha,$duracion,$idConsultorio){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $cita = new ModeloCita();
    $cita->setIdSucursal($idSucursal);
    $cita->setIdConsulta($idConsulta);
    $cita->setFechaInicio($fecha);
    $cita->setFechaFin($fecha);
    $cita->setIdCabina($idConsultorio);
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


function obtenerConsultorios($idConsulta,$idSucursal){
    require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
    
    $consulta =  new ModeloConsulta();
    $consulta->setIdConsulta($idConsulta);
    $cabina = new ModeloCabina();
    $cabina->setTipo($consulta->getConsultorio());
    $cabina->setIdSucursal($idSucursal);
    if ($consulta->getIdConsulta()==0)
        $cabina->setTipo('');
        
    return $cabina->obtenerConsultorios();
    
}

function enviaSMS_CitaNueva($numPaciente, $consulta, $dia, $hora, $sucursal, $idConsulta){
    $sMessage="Haz agendado una cita en Silueta Express el dia $dia a la(s) $hora hr(s) en la sucursal $sucursal.
            \nPara cancelar tu cita, responde: CANCELAR C$idConsulta";
    return enviaSMS($numPaciente, $sMessage);
}

function enviaSMS($numPaciente, $sMessage){
    $sData ='cmd=sendsms&';
    $sData .='domainId=siluetaexpress&';
    $sData .='login=lic.lezliedelariva@gmail.com&';
    $sData .='passwd=L7fr9P3sPMw6&';
    
    $sData .='dest='.str_replace(',','&dest=',$numPaciente).'&';
    $sData .='msg='.urlencode(utf8_encode(substr($sMessage,0,160)));
    
    $timeOut =5;
    
    $fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
    if (!$fp) {
        //Error de conexion o tiempo maximo de conexion rebasado
        $output = "ERROR de conexion: $errno - $errstr\n";
        $output .= "Compruebe que ha configurado correctamente la direccion/url ";
        $output .= "suministrada por altiria";
        return $output;
    } else {
         $buf = "POST http://www.altiria.net/api/http HTTP/1.0\r\n";
        $buf .= "Host: www.altiria.net\r\n";
        $buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
        $buf .= "Content-length: ".strlen($sData)."\r\n";
        $buf .= "\r\n";
        $buf .= $sData;
        fputs($fp, $buf);
        $buf = "";
        
        //Tiempo máximo de espera de respuesta del servidor = 60 seg
        $responseTimeOut = 60;
        stream_set_timeout($fp,$responseTimeOut);
        stream_set_blocking ($fp, true);
        if (!feof($fp)){
            if (($buf=fgets($fp,128))===false){
                // TimeOut?
                $info = stream_get_meta_data($fp);
                if ($info['timed_out']){
                    $output = 'ERROR Tiempo de respuesta agotado';
                    return false;
                    return $output;
                } else {
                    $output = 'ERROR de respuesta';
                    return false;
                    return $output;
                }
            } else{
                while(!feof($fp)){
                    $buf.=fgets($fp,128);
                }
            }
        } else {
            $output = 'ERROR de respuesta';
            return false;
            return $output;
        }
        
        fclose($fp);
        
        
        //Se comprueba que se ha conectado realmente con el servidor
        //y que se obtenga un codigo HTTP OK 200
        if (strpos($buf,"HTTP/1.1 200 OK") === false){
            $output = "ERROR. Codigo error HTTP: ".substr($buf,9,3)."\n";
            $output .= "Compruebe que ha configurado correctamente la direccion/url ";
            $output .= "suministrada por Altiria";
            return false;
            return $output;
        }
        //Se comprueba la respuesta de Altiria
        if (strstr($buf,"ERROR")){
            $output = $buf."<br />\n";
            $output .= " Ha ocurrido algun error. Compruebe la especificacion";
            return false;
            return $output;
        } else {
            $output = $buf."\n";
            $output .= " Exito";
            return true;
            return $output;
        }
    }
    
    return true;
}

?>