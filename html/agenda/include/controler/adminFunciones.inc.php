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

if (isset($_POST['sucursal'])&&isset($_POST['paciente'])&&isset($_POST['usuario'])&&isset($_POST['cabina'])&&isset($_POST['fechaInicio'])){
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
                    
   $cita->setFechaInicio($_POST['fechaInicio']);
    echo json_encode($cita->obtenerCitas());
}

if (isset($_POST['Consulta'])&&isset($_POST['Sucursal'])){
    echo obtenCombo(obtenerConsultorios($_POST['Consulta'],$_POST['Sucursal']),'Selecciona una opci&oacute;n');
}

if (isset($_POST['Sucursal'])&&isset($_POST['Consultorio'])&&isset($_POST['fechaInicio'])){
    echo obtenerIntervalosDisponibles($_POST['Sucursal'], $_POST['Consultorio'], $_POST['fechaInicio']);
}

if (isset($_POST['listadoPacientes'])){
    echo obtenerListadoPacientes($_POST['listadoPacientes']);
}


function obtenCombo($array,$default){
    $combo='<option value="">'.$default.'</option>';
    foreach ($array as $key => $opcion)
        $combo.='<option value="'.$key.'">'.$opcion.'</option>';
    return $combo;
}

function obtenerIntervalosDisponibles($idSucursal,$idCabina,$fechaInicio){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
    
    $cita = new ModeloCita();
    $sucursal=new ModeloSucursal();
    $arrSucursales=array();
    $horarioDisponible=array();
    $arrFechas = array();
    
    if ($idSucursal==''){
    $arr=$sucursal->obtenerSucurales();
    foreach ($arr as $idS=>$nombre)
        array_push($arrSucursales, $idS);
    }else {
        array_push($arrSucursales, $idSucursal);
    }
    
    $horarioDisponible = array();
    
    foreach ($arrSucursales as $idSucursal) {
        $segundo=false;
        $fechaInicial=$fechaInicio;
        $dia=date('N',strtotime ($fechaInicial));
        
        $hrInicio = date("H");
        if ($dia==7){ //es domingo
            $segundo=true;
            $auxFecha = strtotime ( '+1 day' , strtotime ( $fechaInicial ) ) ;
            $fechaInicial = date ( 'Y-m-d' , $auxFecha);
            $dia=date('N',strtotime ($fechaInicial));
        }
        
        $sucursal->setIdSucursal($idSucursal);
        
        // sacar hr
        if ($dia==6){
            $hrInicio = $sucursal->getSabadoEntrada();
            $hrFin=$sucursal->getSabadoSalida();
        }else {
            $hrInicio = $sucursal->getEntreSemanaEntrada();
            $hrFin = $sucursal->getEntreSemanaSalida();
        }
        
        $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fechaInicio)). " $hrInicio:00:00"));
        $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fechaInicio)). " $hrFin:00:00"));
        $auxFechaActual=strtotime(date("Y-m-d H:i:s"));
        
        if ($auxFechaActual<$auxFechaEntrada)
            $segundo=true;
        
        $fechaFin = date(date("Y-m-d", strtotime($fechaInicial)). " $hrFin:00:00");
        if ($segundo) {
        //    $hrInicio = $sucursal->getEntreSemanaEntrada();
            $fechaInicial = date($fechaInicial . " $hrInicio:00:00");
        }
        
        $cita->setFechaInicio($fechaInicial);
        $cita->setFechaFin($fechaFin);
        $cita->setIdSucursal($idSucursal);
        
        $cabina = new ModeloCabina();
        $cabina->setIdSucursal($idSucursal);
        $cabina->setTipo('');
        if ($idCabina=='')
            $arrCabinas = $cabina->obtenerConsultorios();
 /**/       else {
            $cabina->setIdCabina($idCabina);
            $arrCabinas=array($idCabina=>$cabina->getNombre());
            }
/**/    //return json_encode($arrCabinas);
        foreach ($arrCabinas as $idConsultorio=>$nomConsultorio) {
            $fecha=$fechaInicial;
            $cita->setIdCabina($idConsultorio);
            
            do{
                
                $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
                $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00"));
                //$auxFechaActual=strtotime($fecha.date(" H:i:s"));
                
                if ($auxFechaActual<$auxFechaEntrada)
                    $segundo=true;
                    
                    
                $fechaFin = date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00");
                $cita->setFechaInicio($fecha);
                $cita->setFechaFin($fechaFin);
                
                $arrCitas = $cita->obtenerCitasSucursalConsultorioFechaDuracion();
            
            $horasDisponibles=array();
            $horarioAgendado=array();
            // obtener hora inicio y duracion
            foreach ($arrCitas as $info) {
                $horarioAgendado[$info['fechaInicio']] = $info['fechaFin'];
            }
            
//            return json_encode($horarioAgendado);
            if ($auxFechaActual>$auxFechaFin){
                array_push($horasDisponibles, "Horario fuera de servcio");
            }else{
                $horaInicio=$hrInicio.":00";
                for ($hr=$hrInicio;$hr<$hrFin;$hr++){
                    for ($min=0;$min<=50;$min+=10){
                        $hora=($hr<10?'0':'').$hr;
                        $minuto=($min<10?'0':'').$min;
                        $auxFecha2=$fecha;
                        if ($segundo)
                            $auxFecha2=date("Y-m-d", strtotime($fecha)).' '.$hora.':'.$minuto.':00';
                            else{  // definir hora apartir de la actual
                                $auxFecha=$auxFecha2;
                                $auxFecha=explode(' ', $auxFecha);
                                
                                $auxFecha=explode(':', $auxFecha[1]);
                                $hr=intval($auxFecha[0]);;
                                $min=intval($auxFecha[1]);
                            }
                        $segundo=true;
                        
                        if (key_exists($auxFecha2,$horarioAgendado)){ // EXISTE CITA
                            $auxFecha=$horarioAgendado[$auxFecha2];
                            $auxFecha=explode(' ', $auxFecha);
                            if ($horaInicio!=$hr.':'.($min<10?'0':'').$min) //hora igual
                                array_push($horasDisponibles, $horaInicio.' - '.$hr.':'.$min); // intervalo disponible
                            
                            $auxFecha=explode(':', $auxFecha[1]);
                            $hr=intval($auxFecha[0]);;
                            $min=intval($auxFecha[1]);
                            $horaInicio=$hr.":".$min;
                        }
                    }
                }
                if ($horaInicio!=$hr.':00') //hora igual
                    array_push($horasDisponibles, $horaInicio.' - '.$hr.':00'); // intervalo disponible
            }
            //array_push($horasDisponibles, "<<<".date ( 'Y-m-d',strtotime ( '+1 day' , strtotime ( $fecha) ) ).">>> ");
            $auxFecha=date("Y-m-d", strtotime($fecha));
            $horarioDisponible[$idSucursal][$idConsultorio][$auxFecha]=$horasDisponibles;
            if (!in_array($auxFecha, $arrFechas)) /// fechas de los días a mostrar
                array_push($arrFechas, $auxFecha);
            
            $hrInicio = $sucursal->getEntreSemanaEntrada();
            $fecha = date ("Y-m-d $hrInicio:00:00",strtotime ( '+1 day' , strtotime ( $fecha) ) );
            $segundo=true;
            $auxDia=date('N',strtotime ($fecha));
            if (intval($auxDia)==7){
                $fecha = date ("Y-m-d $hrInicio:00:00",strtotime ( '+1 day' , strtotime ( $fecha) ) );
                $auxDia=date('N',strtotime ($fecha));
            }else {
            }
//            $hrInicio = $sucursal->getEntreSemanaEntrada();
            //$fecha = date($fecha . " $hrInicio:00:00");
            
            // sacar hr
            if ($auxDia==6){
                $hrInicio = $sucursal->getSabadoEntrada();
                $hrFin=$sucursal->getSabadoSalida();
            }else {
                $hrInicio = $sucursal->getEntreSemanaEntrada();
                $hrFin = $sucursal->getEntreSemanaSalida();
            }
            
            }while ($dia!=$auxDia);
        }
    }
 //   return json_encode($auxx);
    return json_encode(array($horarioDisponible,$arrFechas));
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
            $finicio=strtotime($auxFecha2); // hr cita nueva inicio
            if (key_exists($auxFecha2,$horarioAgendado)){
                $auxFecha=$horarioAgendado[$auxFecha2];
                $auxFecha=explode(' ', $auxFecha);
                $auxFecha=explode(':', $auxFecha[1]);
                $hr=intval($auxFecha[0]);;
                $min=intval($auxFecha[1]);
                if ($min==0){
                    $min=50;
                    $hr-=1;
                }else {
                    $min-=10;
                }
     //           unset($horarioAgendado[$auxFecha2]);
            }else {
                $b=false;
                $auxFecha = strtotime ( '+'.$duracion.' minute' , strtotime ( $auxFecha2 ) ) ;
                $nuevafecha = date ( 'Y-m-d H:i:s' , $auxFecha);
                $f3=strtotime($nuevafecha); // cita nueva  hr final
                $ffin=strtotime(($fecha.' '.$hrFin.':00:00'));
                
                foreach ($horarioAgendado as $fecha_inicio=>$fecha_fin){
                    $f1=strtotime($fecha_inicio); // hr agendada inicio
                    $f2=strtotime($fecha_fin); // hr agendada final
                        
                    if (($finicio>=$f1&&$finicio<$f2)||($f3>$f1&&$f3<=$f2)||($finicio<$f1&&$f3>$f2)){ // dentro
       //                     unset($horarioAgendado[$fecha_inicio]);
                        $auxFecha=explode(' ', $fecha_fin);
                        $auxFecha=explode(':', $auxFecha[1]);
                        $hr=intval($auxFecha[0]);;
                        $min=intval($auxFecha[1]);
                        if ($min==0){
                            $min=50;
                            $hr-=1;
                        }else {
                            $min-=10;
                        }
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
    $sData .='passwd=L7fr9P3sPMw6&concat=true&';
    
    $sData .='dest='.str_replace(',','&dest=',$numPaciente).'&';
    $sData .='msg='.urlencode(utf8_encode($sMessage));
    
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


function obtenerListadoPacientes($idSucursal){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $paciente = new ModeloPaciente();
    return json_encode($paciente->listadoPacientes($idSucursal));
    
}
?>