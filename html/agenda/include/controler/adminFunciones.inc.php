<?php
if (isset($_POST['pacientes'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $pacientes = new ModeloPaciente();
    $pacientes->setIdSucursal($_POST['pacientes']);
    echo json_encode(obtenCombo($pacientes->obtenerPacientes(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['sucursales'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $estatus = new ModeloSucursal();
    echo json_encode(obtenCombo($estatus->obtenerSucurales(),'Seleccione una opci&oacute;n'));
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

if (isset($_POST['fechaConvertir'])&&isset($_POST['horaInicial'])&&isset($_POST['duracion'])&&isset($_POST['sucursal'])){
    $dias = array('','lunes','martes','miercoles','jueves','viernes','sabado','domingo');
    
    // obtener rangos fecha
    $fechaCitaInicio=$_POST['fechaConvertir'].' '.$_POST['horaInicial'];
    $fechaCitaFinal= date('Y-m-d H:i:s',strtotime ( '+'.intval($_POST['duracion']).' min' , strtotime ( $fechaCitaInicio) ) );
    $dia=date('N', strtotime($_POST['fechaConvertir']));
    $horaValida = 'false';
    if ($dia==6){
        $horaValida = 'true';
    }else {
        require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
        $sucursal=new ModeloSucursal();
        $sucursal->setIdSucursal($_POST['sucursal']);
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin = $sucursal->getSabadoSalida();
    
    $fechaRangoInicio=$_POST['fechaConvertir'].' '.$hrInicio.':00:00';
    $fechaRangoFinal=$_POST['fechaConvertir'].' '.$hrFin.':00:00';
    
    $tcitaI=strtotime($fechaCitaInicio);
    $tcitaF=strtotime($fechaCitaFinal);
    $trangoI=strtotime($fechaRangoInicio);
    $trangoF=strtotime($fechaRangoFinal);
    
    if ($tcitaI>=$trangoI&&$tcitaF<=$trangoF)
        $horaValida='true';
    
    }
    echo json_encode(array(strtolower($dias[$dia]),$horaValida));
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

if (isset($_POST['idSucursalB'])&&isset($_POST['fechaB'])){
    echo obtenerHorarioByDia($_POST['idSucursalB'],$_POST['fechaB']);
}

if (isset($_POST['sucursalB'])&&isset($_POST['pacienteB'])&&isset($_POST['estatusB'])&&isset($_POST['cabinaB'])&&isset($_POST['fechaInicioB'])&&isset($_POST['horaB'])&&isset($_POST['consultaB'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    if ($_POST['sucursalB']!='')
        $cita->setIdSucursal($_POST['sucursalB']);
        if ($_POST['pacienteB']!='')
            $cita->setIdPaciente($_POST['pacienteB']);
            if ($_POST['estatusB']!='')
                $cita->setEstatus($_POST['estatusB']);
                if ($_POST['cabinaB']!='')
                    $cita->setIdCabina($_POST['cabinaB']);
                    if ($_POST['consultaB']!='')
                    $cita->setIdConsulta($_POST['consultaB']);
                    echo json_encode($cita->buscarCitas($_POST['fechaInicioB'],$_POST['horaB']));
}

if (isset($_POST['estatusCita'])){
    require_once FOLDER_MODEL_EXTEND. "model.estatusCita.inc.php";
    $estatus = new ModeloEstatuscita();
  echo json_encode(obtenCombo($estatus->obtenerEstatus(),'Seleccione una opci&oacute;n'));
}

function obtenCombo($array,$default){
    $combo='<option value="">'.$default.'</option>';
    foreach ($array as $key => $opcion)
        $combo.='<option value="'.$key.'">'.$opcion.'</option>';
    return $combo;
}

if (isset($_POST['idCita'])&&isset($_POST['por'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    $cita->setIdCita($_POST['idCita']);
    $cita->setEstatus("cancelada_".$_POST['por']);
    $cita->Guardar();
    if ($cita->getError()){
        echo '';
    }else 
        echo 'true';
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
            $minInicio=0;
/**/    //return json_encode($arrCabinas);
        foreach ($arrCabinas as $idConsultorio=>$nomConsultorio) {
            ///$auxFechaActual=strtotime(date("Y-m-d H:i:s"));
            $fecha=$fechaInicial;
            $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
            $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00"));
            if ($auxFechaActual>$auxFechaEntrada&&$auxFechaActual<$auxFechaFin){  // hora entre horario de citas
                $fecha=date("Y-m-d H:i:s");
                $hrInicio = intval(date("H"));
                $auxHrInicio=($hrInicio<10?'0':'').$hrInicio;
                $auxMin=intval(date("i"));
                if ($auxMin<10)
                    $minInicio=0;
                    else if ($auxMin<20)
                        $minInicio=10;
                        else if ($auxMin<30)
                            $minInicio=20;
                            else if ($auxMin<40)
                                $minInicio=30;
                                else if ($auxMin<50)
                                    $minInicio=40;
                                    else if ($auxMin<59)
                                        $minInicio=50;
                  $fecha = date(date("Y-m-d", strtotime($fecha)). " $auxHrInicio:$minInicio:00");
            }
            $cita->setIdCabina($idConsultorio);
///            if ($idConsultorio>1)
   //             return $fecha;
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
  //          return json_encode($fecha);
            if ($auxFechaActual>$auxFechaFin){
                array_push($horasDisponibles, "Horario fuera de servcio");
            }else{
                $horaInicio=($hrInicio<10?'0':'').$hrInicio.":".($minInicio<10?'0':'').$minInicio;
                for ($hr=$hrInicio;$hr<$hrFin;$hr++){
                    for ($min=$minInicio;$min<=50;$min+=10){
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
                                $auxMin=$min=intval($auxFecha[1]);
                                
                                if ($auxMin<10)
                                    $min=0;
                                    else if ($auxMin<20)
                                        $min=10;
                                        else if ($auxMin<30)
                                            $min=20;
                                            else if ($auxMin<40)
                                                $min=30;
                                                else if ($auxMin<50)
                                                    $min=40;
                                                    else if ($auxMin<59)
                                                        $min=50;
                                $auxFecha2 = date(date("Y-m-d", strtotime($fecha)). " $hora:$min:00");
                                
                                // comparar fechas
                                foreach ($horarioAgendado as $fecha_inicio=>$fecha_fin){
                                    $f1=strtotime($fecha_inicio); // hr agendada inicio
                                    $f2=strtotime($fecha_fin); // hr agendada final
                                    $fI=strtotime($auxFecha2);
                                    if ($fI>$f1&&$fI<$f2){ // dentro
                                        $auxFecha=explode(' ', $fecha_fin);
                                        if ($horaInicio!=$hora.':'.$minuto) //hora igual
                                            array_push($horasDisponibles, $horaInicio.' - '.$hora.':'.$minuto); // intervalo disponible
                                            
                                            $auxFecha=explode(':', $auxFecha[1]);
                                            $hr=intval($auxFecha[0]);;
                                            $min=intval($auxFecha[1]);
                                            $horaInicio=($hr<10?'0':'').$hr.":".($min<10?'0':'').$min;
                                    }
                                }
                            }
            //               return $auxFecha2;
                        $segundo=true;
                        if (key_exists($auxFecha2,$horarioAgendado)){ // EXISTE CITA
                            $auxFecha=$horarioAgendado[$auxFecha2];
                            $auxFecha=explode(' ', $auxFecha);
                            if ($horaInicio!=$hora.':'.$minuto) //hora igual
                                array_push($horasDisponibles, $horaInicio.' - '.$hora.':'.$minuto); // intervalo disponible
                            
                            $auxFecha=explode(':', $auxFecha[1]);
                            $hr=intval($auxFecha[0]);;
                            $min=intval($auxFecha[1]);
                            $horaInicio=($hr<10?'0':'').$hr.":".($min<10?'0':'').$min;
                        }
                    }
                    $minInicio=0;
                }
                if ($horaInicio!=$hora.':'.$minuto&&intval($hr)<=intval($hrFin)) //hora igual
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
            $segundo=false;
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
    
    $dia=date('N',strtotime ($fecha));
    // sacar hr
    if ($dia==6){
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin=$sucursal->getSabadoSalida();
    }else {
        $hrInicio = $sucursal->getEntreSemanaEntrada();
        $hrFin = $sucursal->getEntreSemanaSalida();
    }
    
    $horarioDisponible=array();
    $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
    $auxFechaActual=strtotime(date("Y-m-d H:i:s"));
    $minInicio=0;
    if ($auxFechaActual>$auxFechaEntrada){
        $hrInicio = intval(date("H"));
        $auxMin=intval(date("i"));
        if ($auxMin<10)
            $minInicio=0;
            else if ($auxMin<20)
                $minInicio=10;
                else if ($auxMin<30)
                    $minInicio=20;
                    else if ($auxMin<40)
                        $minInicio=30;
                        else if ($auxMin<50)
                            $minInicio=40;
                            else if ($auxMin<59)
                                $minInicio=50;
                                
    }
        
    for ($hr=$hrInicio;$hr<$hrFin;$hr++){
        for ($min=$minInicio;$min<=50;$min+=10){
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

function enviaSMS_CitaNueva($numPaciente, $consulta, $dia, $hora, $sucursal, $idConsulta)
{
    $sMessage = "Haz agendado una cita en Silueta Express el dia $dia a la(s) $hora hr(s) en la sucursal $sucursal.
            \nPara cancelar tu cita, responde: CANCELAR C$idConsulta";
    return enviaSMS($numPaciente, $sMessage);
}

function enviaSMS($numPaciente, $sMessage)
{
    $sData = 'cmd=sendsms&';
    $sData .= 'domainId=siluetaexpress&';
    $sData .= 'login=lic.lezliedelariva@gmail.com&';
    $sData .= 'passwd=L7fr9P3sPMw6&concat=true&';
    
    $sData .= 'dest=' . str_replace(',', '&dest=', $numPaciente) . '&';
    $sData .= 'msg=' . urlencode(utf8_encode($sMessage));
    
    $timeOut = 5;
    
    $fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
    if (! $fp) {
        // Error de conexion o tiempo maximo de conexion rebasado
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

function obtenerHorarioByDia($idSucursal,$fecha){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $sucursal=new ModeloSucursal();
    $sucursal->setIdSucursal($idSucursal);
    
    $dia=date('N',strtotime ($fecha));
    // sacar hr
    if ($dia==6){
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin=$sucursal->getSabadoSalida();
    }else {
        $hrInicio = $sucursal->getEntreSemanaEntrada();
        $hrFin = $sucursal->getEntreSemanaSalida();
    }
    
    $horarioDisponible=array();
    
    $horarioDisponible['0']=array();
    array_push($horarioDisponible['0'], array('0'));
    
    for ($hr=$hrInicio;$hr<$hrFin;$hr++){
        for ($min=0;$min<=50;$min+=10){
            $hora=($hr<10?'0':'').$hr;
            $minuto=($min<10?'0':'').$min;
                if (!key_exists($hora, $horarioDisponible))
                            $horarioDisponible[$hr]=array();
                            array_push($horarioDisponible[$hr], $minuto);
                         
        }
    }
    return json_encode($horarioDisponible);
}

?>